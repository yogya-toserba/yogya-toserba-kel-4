<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\ChatMessage;
use App\Models\Pemasok;
use App\Models\PemasokUser;
use App\Models\Admin;
use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    private function getAuthenticatedGudang()
    {
        $gudang = Auth::guard('gudang')->user();
        if (!$gudang) {
            abort(403, 'Unauthorized access');
        }
        return $gudang;
    }

    // Menampilkan daftar chat rooms untuk gudang
    public function index()
    {
        try {
            $gudang = $this->getAuthenticatedGudang();

            $chatRooms = ChatRoom::with(['pemasok'])
                ->where('gudang_id', $gudang->id_gudang)
                ->orWhereNull('gudang_id')
                ->orderBy('last_message_at', 'desc')
                ->get();

            return view('gudang.chat.index', compact('chatRooms', 'gudang'));
        } catch (\Exception $e) {
            return redirect()->route('gudang.login')
                ->with('error', 'Silakan login terlebih dahulu. Error: ' . $e->getMessage());
        }
    }

    // Menampilkan chat room tertentu
    public function show($roomId)
    {
        $gudang = $this->getAuthenticatedGudang();

        $chatRoom = ChatRoom::with(['pemasok', 'messages'])
            ->where('id', $roomId)
            ->where(function ($query) use ($gudang) {
                $query->where('gudang_id', $gudang->id_gudang)
                    ->orWhereNull('gudang_id');
            })
            ->firstOrFail();

        // Mark messages as read
        ChatMessage::where('chat_room_id', $roomId)
            ->where('sender_type', '!=', 'gudang')
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return view('gudang.chat.show', compact('chatRoom', 'gudang'));
    }

    // Mengirim pesan
    public function sendMessage(Request $request, $roomId)
    {
        try {
            // Debug logging
            Log::info('Chat sendMessage called', [
                'roomId' => $roomId,
                'request_data' => $request->all(),
                'auth_guard' => Auth::guard('gudang')->check(),
                'user_id' => Auth::guard('gudang')->id()
            ]);

            $request->validate([
                'message' => 'required|string|max:1000',
                'message_type' => 'in:text,product_request',
                'product_data' => 'nullable|array'
            ]);

            $gudang = $this->getAuthenticatedGudang();

            Log::info('Gudang authenticated', ['gudang_id' => $gudang->id_gudang]);

            $chatRoom = ChatRoom::where('id', $roomId)
                ->where(function ($query) use ($gudang) {
                    $query->where('gudang_id', $gudang->id_gudang)
                        ->orWhereNull('gudang_id');
                })
                ->firstOrFail();

            Log::info('Chat room found', ['chat_room_id' => $chatRoom->id]);

            $message = ChatMessage::create([
                'chat_room_id' => $roomId,
                'sender_type' => 'gudang',
                'sender_id' => $gudang->id_gudang,
                'message' => $request->message,
                'message_type' => $request->message_type ?? 'text',
                'product_data' => $request->product_data
            ]);

            Log::info('Message created', ['message_id' => $message->id]);

            // Update last message time
            $chatRoom->update(['last_message_at' => now()]);

            // Load sender data manually based on type
            $senderData = null;
            switch ($message->sender_type) {
                case 'gudang':
                    $senderData = Gudang::find($message->sender_id);
                    break;
                case 'pemasok':
                    $senderData = PemasokUser::find($message->sender_id);
                    break;
                case 'admin':
                    $senderData = Admin::find($message->sender_id);
                    break;
            }

            $response = [
                'success' => true,
                'message' => [
                    'id' => $message->id,
                    'message' => $message->message,
                    'sender_type' => $message->sender_type,
                    'sender_id' => $message->sender_id,
                    'sender' => $senderData,
                    'created_at' => $message->created_at,
                    'message_type' => $message->message_type
                ]
            ];

            Log::info('Sending response', $response);

            return response()->json($response);
        } catch (\Exception $e) {
            Log::error('Chat sendMessage error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Gagal mengirim pesan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Membuat chat room baru dengan pemasok
    public function createRoom(Request $request)
    {
        $request->validate([
            'pemasok_id' => 'required|exists:pemasok,id_pemasok',
            'nama_room' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        $gudang = $this->getAuthenticatedGudang();

        // Cek apakah sudah ada chat room dengan pemasok ini
        $existingRoom = ChatRoom::where('pemasok_id', $request->pemasok_id)
            ->where('gudang_id', $gudang->id_gudang)
            ->first();

        if ($existingRoom) {
            return redirect()->route('gudang.chat.show', $existingRoom->id)
                ->with('info', 'Chat room sudah ada');
        }

        $chatRoom = ChatRoom::create([
            'pemasok_id' => $request->pemasok_id,
            'gudang_id' => $gudang->id_gudang,
            'nama_room' => $request->nama_room,
            'deskripsi' => $request->deskripsi,
            'status' => 'aktif'
        ]);

        return redirect()->route('gudang.chat.show', $chatRoom->id)
            ->with('success', 'Chat room berhasil dibuat');
    }

    // Menampilkan form request produk
    public function requestProduct($roomId)
    {
        $gudang = $this->getAuthenticatedGudang();

        $chatRoom = ChatRoom::with('pemasok')
            ->where('id', $roomId)
            ->where(function ($query) use ($gudang) {
                $query->where('gudang_id', $gudang->id_gudang)
                    ->orWhereNull('gudang_id');
            })
            ->firstOrFail();

        return view('gudang.chat.request-product', compact('chatRoom', 'gudang'));
    }

    // Mengirim request produk
    public function sendProductRequest(Request $request, $roomId)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'spesifikasi' => 'nullable|string',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'harga_maksimal' => 'nullable|numeric|min:0',
            'tanggal_dibutuhkan' => 'nullable|date|after:today',
            'catatan' => 'nullable|string'
        ]);

        $gudang = $this->getAuthenticatedGudang();

        $chatRoom = ChatRoom::where('id', $roomId)
            ->where(function ($query) use ($gudang) {
                $query->where('gudang_id', $gudang->id_gudang)
                    ->orWhereNull('gudang_id');
            })
            ->firstOrFail();

        $productData = [
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'spesifikasi' => $request->spesifikasi,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'harga_maksimal' => $request->harga_maksimal,
            'tanggal_dibutuhkan' => $request->tanggal_dibutuhkan,
            'catatan' => $request->catatan
        ];

        $message = "📦 *REQUEST PRODUK*\n\n";
        $message .= "**Nama Produk:** " . $request->nama_produk . "\n";
        $message .= "**Kategori:** " . $request->kategori . "\n";
        $message .= "**Jumlah:** " . $request->jumlah . " " . $request->satuan . "\n";

        if ($request->spesifikasi) {
            $message .= "**Spesifikasi:** " . $request->spesifikasi . "\n";
        }

        if ($request->harga_maksimal) {
            $message .= "**Harga Maksimal:** Rp " . number_format($request->harga_maksimal, 0, ',', '.') . "\n";
        }

        if ($request->tanggal_dibutuhkan) {
            $message .= "**Tanggal Dibutuhkan:** " . $request->tanggal_dibutuhkan . "\n";
        }

        if ($request->catatan) {
            $message .= "**Catatan:** " . $request->catatan . "\n";
        }

        $chatMessage = ChatMessage::create([
            'chat_room_id' => $roomId,
            'sender_type' => 'gudang',
            'sender_id' => $gudang->id_gudang,
            'message' => $message,
            'message_type' => 'product_request',
            'product_data' => $productData
        ]);

        // Update last message time
        $chatRoom->update(['last_message_at' => now()]);

        return redirect()->route('gudang.chat.show', $roomId)
            ->with('success', 'Request produk berhasil dikirim');
    }

    // Method untuk mengambil pesan baru via AJAX
    public function getMessages(Request $request, $roomId)
    {
        try {
            $gudang = $this->getAuthenticatedGudang();

            $chatRoom = ChatRoom::where('id', $roomId)
                ->where(function ($query) use ($gudang) {
                    $query->where('gudang_id', $gudang->id_gudang)
                        ->orWhereNull('gudang_id');
                })
                ->first();

            if (!$chatRoom) {
                return response()->json([
                    'success' => false,
                    'message' => 'Chat room tidak ditemukan'
                ], 404);
            }

            $afterId = $request->get('after', 0);

            $messages = ChatMessage::where('chat_room_id', $roomId)
                ->where('id', '>', $afterId)
                ->orderBy('created_at', 'asc')
                ->get();

            // Transform messages to include sender data
            $transformedMessages = $messages->map(function ($message) {
                $senderData = null;
                switch ($message->sender_type) {
                    case 'gudang':
                        $senderData = Gudang::find($message->sender_id);
                        break;
                    case 'pemasok':
                        $senderData = PemasokUser::find($message->sender_id);
                        break;
                    case 'admin':
                        $senderData = Admin::find($message->sender_id);
                        break;
                }

                return [
                    'id' => $message->id,
                    'message' => $message->message,
                    'sender_type' => $message->sender_type,
                    'sender_id' => $message->sender_id,
                    'sender' => $senderData,
                    'created_at' => $message->created_at,
                    'message_type' => $message->message_type
                ];
            });

            return response()->json([
                'success' => true,
                'messages' => $transformedMessages
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting messages: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil pesan'
            ], 500);
        }
    }
}
