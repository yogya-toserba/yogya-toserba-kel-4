<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use App\Models\Produk;
use App\Models\StokGudangPusat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PengirimanController extends Controller
{
  public function index(Request $request)
  {
    // Ambil data pengiriman dari session (data dari permintaan yang dikirim)
    $sessionPengiriman = session('all_pengiriman', []);
    
    // Apply filters
    $filteredPengiriman = collect($sessionPengiriman);
    
    // Filter by status
    if ($request->filled('status')) {
      $filteredPengiriman = $filteredPengiriman->where('status', $request->status);
    }
    
    // Filter by date range
    if ($request->filled('tanggal_dari')) {
      $filteredPengiriman = $filteredPengiriman->filter(function($item) use ($request) {
        $itemDate = $item['tanggal_kirim'] ?? date('Y-m-d');
        return $itemDate >= $request->tanggal_dari;
      });
    }
    
    if ($request->filled('tanggal_sampai')) {
      $filteredPengiriman = $filteredPengiriman->filter(function($item) use ($request) {
        $itemDate = $item['tanggal_kirim'] ?? date('Y-m-d');
        return $itemDate <= $request->tanggal_sampai;
      });
    }
    
    // Convert back to array for pagination
    $filteredArray = $filteredPengiriman->values()->toArray();
    
    // Buat pagination
    $perPage = 10;
    $currentPage = $request->get('page', 1);
    $total = count($filteredArray);
    $offset = ($currentPage - 1) * $perPage;
    $currentItems = array_slice($filteredArray, $offset, $perPage);
    
    $pengiriman = new \Illuminate\Pagination\LengthAwarePaginator(
      $currentItems, // items
      $total, // total
      $perPage, // per page
      $currentPage, // current page
      [
        'path' => $request->url(),
        'pageName' => 'page',
        'fragment' => null,
        'query' => $request->query()
      ]
    );

    // Statistik hanya dari session data
    $sessionCount = count($sessionPengiriman);
    $sessionPending = collect($sessionPengiriman)->where('status', 'Menunggu')->count();
    $sessionSiapKirim = collect($sessionPengiriman)->where('status', 'Siap Kirim')->count();
    $sessionDikirim = collect($sessionPengiriman)->where('status', 'Dalam Perjalanan')->count();
    $sessionSelesai = collect($sessionPengiriman)->where('status', 'Selesai')->count();

    // Variabel yang dibutuhkan view (sesuaikan dengan nama yang digunakan di blade)
    $totalPengiriman = $sessionCount;
    $pending = $sessionPending;
    $dikirim = $sessionDikirim;
    $selesai = collect($sessionPengiriman)->where('status', 'Diterima')->count();

    // Data untuk dropdown (gunakan data session untuk produk yang tersedia)
    $statusOptions = [
      'Menunggu' => 'Menunggu',
      'Siap Kirim' => 'Siap Kirim', 
      'Dalam Perjalanan' => 'Dalam Perjalanan',
      'Dikirim' => 'Dikirim',
      'Diterima' => 'Diterima'
    ];
    
    // Ambil produk dari session pengiriman untuk dropdown
    $produkList = collect($sessionPengiriman)->pluck('nama_produk')->unique()->map(function($nama) {
      return (object) ['nama_produk' => $nama];
    });

    return view('gudang.pengiriman.index', compact(
      'pengiriman',
      'sessionPengiriman',
      'totalPengiriman',
      'pending',
      'dikirim',
      'selesai',
      'sessionCount',
      'sessionPending',
      'sessionSiapKirim',
      'sessionDikirim',
      'statusOptions',
      'produkList'
    ));
  }

  public function create()
  {
    // Ambil dari stok gudang pusat: id_produk => nama_produk
    $produkList = StokGudangPusat::select('id_produk', 'nama_produk', 'jumlah')->orderBy('nama_produk')->get();
    return view('gudang.pengiriman.create', compact('produkList'));
  }

  public function store(Request $request)
  {
    Log::info('=== PENGIRIMAN STORE START ===');
    Log::info('Request data: ', $request->all());

    $request->validate([
      'id_produk' => 'required|integer|exists:stok_gudang_pusat,id_produk',
      'tujuan' => 'required|string|max:255',
      'jumlah' => 'required|integer|min:1',
      'tanggal_kirim' => 'required|date',
      'status' => 'required|in:pending,dikirim,selesai'
    ]);

    Log::info('Validation passed');

    // transaksikan perubahan: insert pengiriman + kurangi stok
    DB::beginTransaction();
    try {
      $stok = StokGudangPusat::findOrFail($request->id_produk);
      Log::info('Stok found: ', $stok->toArray());

      if ($stok->jumlah < $request->jumlah) {
        Log::warning('Insufficient stock', [
          'available' => $stok->jumlah,
          'requested' => $request->jumlah
        ]);
        
        // Return JSON response for AJAX
        if ($request->expectsJson()) {
          return response()->json([
            'success' => false,
            'message' => 'Stok tidak mencukupi. Tersedia: ' . $stok->jumlah
          ], 400);
        }
        return redirect()->back()->withInput()->with('error', 'Stok tidak mencukupi. Tersedia: ' . $stok->jumlah);
      }

      $data = [
        'id_produk' => $stok->id_produk,
        'nama_produk' => $stok->nama_produk,
        'tujuan' => $request->tujuan,
        'jumlah' => $request->jumlah,
        'tanggal_kirim' => $request->tanggal_kirim,
        'status' => $request->status,
      ];

      Log::info('Data to insert: ', $data);

      $pengiriman = Pengiriman::create($data);
      Log::info('Pengiriman created: ', $pengiriman->toArray());

      // kurangi stok
      $stok->decrement('jumlah', $request->jumlah);
      Log::info('Stock decremented');

      DB::commit();
      Log::info('Transaction committed');

      // Return JSON response for AJAX
      if ($request->expectsJson()) {
        Log::info('Returning JSON success response');
        return response()->json([
          'success' => true,
          'message' => 'Data pengiriman berhasil ditambahkan!'
        ]);
      }

      Log::info('Redirecting to index');
      return redirect()->route('gudang.pengiriman.index')
        ->with('success', 'Data pengiriman berhasil ditambahkan!');
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('Error in store: ' . $e->getMessage());
      Log::error('Stack trace: ' . $e->getTraceAsString());
      
      // Return JSON response for AJAX
      if ($request->expectsJson()) {
        return response()->json([
          'success' => false,
          'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
      }

      return redirect()->back()
        ->withInput()
        ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
  }

  public function show($id)
  {
    $pengiriman = Pengiriman::findOrFail($id);
    return view('gudang.pengiriman.show', compact('pengiriman'));
  }

  public function edit($id)
  {
    $pengiriman = Pengiriman::findOrFail($id);
    $produkList = StokGudangPusat::select('id_produk', 'nama_produk', 'jumlah')->orderBy('nama_produk')->get();
    return view('gudang.pengiriman.edit', compact('pengiriman', 'produkList'));
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'id_produk' => 'required|integer|exists:stok_gudang_pusat,id_produk',
      'tujuan' => 'required|string|max:255',
      'jumlah' => 'required|integer|min:1',
      'tanggal_kirim' => 'required|date',
      'status' => 'required|in:pending,dikirim,selesai'
    ]);

    DB::beginTransaction();
    try {
      $pengiriman = Pengiriman::findOrFail($id);

      // jika id_produk berubah atau jumlah berubah, kita harus menyesuaikan stok
      $oldStokId = $pengiriman->id_produk;
      $oldJumlah = $pengiriman->jumlah;

      $newStok = StokGudangPusat::findOrFail($request->id_produk);

      // rollback stok pada produk lama
      if ($oldStokId && $oldStokId != $newStok->id_produk) {
        $oldStok = StokGudangPusat::find($oldStokId);
        if ($oldStok) {
          $oldStok->increment('jumlah', $oldJumlah);
        }
      }

      // cek stok untuk pengurangan
      if ($newStok->jumlah < $request->jumlah) {
        DB::rollBack();
        return redirect()->back()->withInput()->with('error', 'Stok tidak mencukupi. Tersedia: ' . $newStok->jumlah);
      }

      $pengiriman->update([
        'id_produk' => $newStok->id_produk,
        'nama_produk' => $newStok->nama_produk,
        'tujuan' => $request->tujuan,
        'jumlah' => $request->jumlah,
        'tanggal_kirim' => $request->tanggal_kirim,
        'status' => $request->status,
      ]);

      // kurangi stok baru sesuai jumlah baru
      $newStok->decrement('jumlah', $request->jumlah);

      DB::commit();

      return redirect()->route('gudang.pengiriman.index')
        ->with('success', 'Data pengiriman berhasil diupdate!');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()
        ->withInput()
        ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
  }

  public function destroy($id)
  {
    try {
      $pengiriman = Pengiriman::findOrFail($id);
      $pengiriman->delete();

      return redirect()->route('gudang.pengiriman.index')
        ->with('success', 'Data pengiriman berhasil dihapus!');
    } catch (\Exception $e) {
      return redirect()->back()
        ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
  }

  public function updateStatus(Request $request, $id)
  {
    $request->validate([
      'status' => 'required|in:pending,dikirim,selesai,ditolak'
    ]);

    try {
      $pengiriman = Pengiriman::findOrFail($id);
      
      $updateData = ['status' => $request->status];
      
      // Add timestamp and reason based on status
      if ($request->status === 'dikirim') {
        $updateData['tanggal_diterima'] = now();
      } elseif ($request->status === 'ditolak') {
        $updateData['tanggal_ditolak'] = now();
        if ($request->filled('reason')) {
          $updateData['keterangan'] = $request->reason;
        }
      }
      
      $pengiriman->update($updateData);

      Log::info('Pengiriman status updated', [
        'id' => $id,
        'status' => $request->status,
        'reason' => $request->reason ?? null
      ]);

      return response()->json([
        'success' => true,
        'message' => 'Status pengiriman berhasil diupdate!'
      ]);
    } catch (\Exception $e) {
      Log::error('Error updating pengiriman status: ' . $e->getMessage());
      return response()->json([
        'success' => false,
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ], 500);
    }
  }

  public function updateSessionStatus(Request $request)
  {
    $request->validate([
      'id_pengiriman' => 'required|string',
      'status' => 'required|string',
      'index' => 'required|integer'
    ]);

    try {
      // Get session data
      $sessionPengiriman = session('all_pengiriman', []);
      $index = $request->index;

      // Update status if index exists
      if (isset($sessionPengiriman[$index]) && $sessionPengiriman[$index]['id_pengiriman'] === $request->id_pengiriman) {
        $sessionPengiriman[$index]['status'] = $request->status;
        
        // Save back to session
        session(['all_pengiriman' => $sessionPengiriman]);
        
        return response()->json([
          'success' => true,
          'message' => 'Status pengiriman berhasil diupdate!'
        ]);
      } else {
        throw new \Exception('Data pengiriman tidak ditemukan dalam session');
      }
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
      ]);
    }
  }

  public function kirimPengiriman(Request $request)
  {
    try {
      $index = $request->input('index');
      $sessionPengiriman = session('all_pengiriman', []);
      
      if (isset($sessionPengiriman[$index])) {
        // Ambil data yang akan dikirim
        $item = $sessionPengiriman[$index];
        
        // Update status pengiriman menjadi "Dikirim"
        $sessionPengiriman[$index]['status'] = 'Dikirim';
        $sessionPengiriman[$index]['tanggal_kirim_aktual'] = now()->format('Y-m-d H:i:s');
        
        // Transfer data ke session penerimaan dengan status "Dalam Perjalanan"
        $sessionPenerimaan = session('all_penerimaan', []);
        $penerimaanItem = [
          'id' => $item['id'] ?? count($sessionPenerimaan) + 1,
          'nama_produk' => $item['nama_produk'],
          'tujuan' => $item['tujuan'],
          'jumlah' => $item['jumlah'],
          'status' => 'Dalam Perjalanan',
          'tanggal_kirim' => $item['tanggal_kirim'] ?? date('Y-m-d'),
          'tanggal_kirim_aktual' => now()->format('Y-m-d H:i:s'),
          'created_at' => now()->format('Y-m-d H:i:s')
        ];
        
        $sessionPenerimaan[] = $penerimaanItem;
        
        // Save kedua session
        session(['all_pengiriman' => $sessionPengiriman]);
        session(['all_penerimaan' => $sessionPenerimaan]);
        
        return response()->json([
          'success' => true,
          'message' => 'Pengiriman berhasil dikirim dan masuk ke sistem penerimaan!',
          'redirect' => route('gudang.inventori.penerimaan.index')
        ]);
      } else {
        throw new \Exception('Data pengiriman tidak ditemukan dalam session');
      }
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ], 500);
    }
  }
}
