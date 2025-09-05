<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\ChatMessage;
use App\Models\PemasokUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    // Dashboard supplier
    public function dashboard()
    {
        $supplier = Auth::guard('pemasok')->user();

        $chatRooms = ChatRoom::with(['lastMessage', 'admin', 'gudang'])
            ->where('pemasok_id', $supplier->pemasok_id)
            ->orderBy('last_message_at', 'desc')
            ->get();

        $unreadCount = ChatMessage::whereIn('chat_room_id', $chatRooms->pluck('id'))
            ->where('sender_type', '!=', 'pemasok')
            ->where('is_read', false)
            ->count();

        return view('supplier.dashboard', compact('supplier', 'chatRooms', 'unreadCount'));
    }

    // Menampilkan chat room untuk supplier
    public function chatShow($roomId)
    {
        $supplier = Auth::guard('pemasok')->user();

        $chatRoom = ChatRoom::with(['messages', 'admin', 'gudang'])
            ->where('id', $roomId)
            ->where('pemasok_id', $supplier->pemasok_id)
            ->firstOrFail();

        // Mark messages as read
        ChatMessage::where('chat_room_id', $roomId)
            ->where('sender_type', '!=', 'pemasok')
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);

        return view('supplier.chat', compact('chatRoom', 'supplier'));
    }

    // Mengirim pesan dari supplier
    public function sendMessage(Request $request, $roomId)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $supplier = Auth::guard('pemasok')->user();

        $chatRoom = ChatRoom::where('id', $roomId)
            ->where('pemasok_id', $supplier->pemasok_id)
            ->firstOrFail();

        $message = ChatMessage::create([
            'chat_room_id' => $roomId,
            'sender_type' => 'pemasok',
            'sender_id' => $supplier->id,
            'message' => $request->message,
            'message_type' => 'text'
        ]);

        // Update last message time
        $chatRoom->update(['last_message_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    // Profil supplier
    public function profile()
    {
        $supplier = Auth::guard('pemasok')->user();
        return view('supplier.profile', compact('supplier'));
    }

    // Update profil supplier
    public function updateProfile(Request $request)
    {
        $supplier = Auth::guard('pemasok')->user();

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:20',
            'email' => 'required|email|unique:pemasok_users,email,' . $supplier->id,
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        // Update data dasar
        PemasokUser::where('id', $supplier->id)->update([
            'nama_lengkap' => $request->nama_lengkap,
            'telepon' => $request->telepon,
            'email' => $request->email
        ]);

        // Update password jika diisi
        if ($request->filled('password')) {
            if (
                !$request->filled('current_password') ||
                !Hash::check($request->current_password, $supplier->password)
            ) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
            }

            PemasokUser::where('id', $supplier->id)->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return back()->with('success', 'Profil berhasil diupdate');
    }

    // Login supplier
    public function login()
    {
        return view('supplier.login');
    }

    // Proses login supplier
    public function authenticate(Request $request)
    {
        $request->validate([
            'login' => 'required|string', // bisa username atau email
            'password' => 'required|string'
        ]);

        $credentials = [];
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials[$loginField] = $request->login;
        $credentials['password'] = $request->password;
        $credentials['status'] = 'aktif';

        if (Auth::guard('pemasok')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // Update last login
            PemasokUser::where('id', Auth::guard('pemasok')->user()->id)->update(['last_login' => now()]);

            return redirect()->intended(route('supplier.dashboard'));
        }

        return back()->withErrors([
            'login' => 'Username/email atau password salah',
        ])->onlyInput('login');
    }

    // Logout supplier
    public function logout(Request $request)
    {
        Auth::guard('pemasok')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('supplier.login');
    }
}
