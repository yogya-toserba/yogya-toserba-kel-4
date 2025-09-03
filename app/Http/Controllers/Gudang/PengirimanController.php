<?php

namespace App\Http\Controllers\Gudang;

use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use App\Models\Produk;
use App\Models\StokGudangPusat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengirimanController extends Controller
{
  public function index(Request $request)
  {
    $query = Pengiriman::query();

    // Filter berdasarkan pencarian
    if ($request->filled('search')) {
      $search = $request->search;
      $query->where(function ($q) use ($search) {
        $q->where('nama_produk', 'like', "%{$search}%")
          ->orWhere('tujuan', 'like', "%{$search}%");
      });
    }

    // Filter berdasarkan status
    if ($request->filled('status')) {
      $query->where('status', $request->status);
    }

    // Filter berdasarkan tanggal
    if ($request->filled('tanggal_dari')) {
      $query->whereDate('tanggal_kirim', '>=', $request->tanggal_dari);
    }

    if ($request->filled('tanggal_sampai')) {
      $query->whereDate('tanggal_kirim', '<=', $request->tanggal_sampai);
    }

    $pengiriman = $query->orderBy('created_at', 'desc')->paginate(10);

    // Data untuk statistik
    $totalPengiriman = Pengiriman::count();
    $pending = Pengiriman::where('status', 'pending')->count();
    $dikirim = Pengiriman::where('status', 'dikirim')->count();
    $selesai = Pengiriman::where('status', 'selesai')->count();

    // Data untuk dropdown
    $statusOptions = Pengiriman::getStatusOptions();
    $produkList = Produk::pluck('nama')->unique()->sort()->values();

    return view('gudang.pengiriman.index', compact(
      'pengiriman',
      'totalPengiriman',
      'pending',
      'dikirim',
      'selesai',
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
    $request->validate([
      'id_produk' => 'required|integer|exists:stok_gudang_pusat,id_produk',
      'tujuan' => 'required|string|max:255',
      'jumlah' => 'required|integer|min:1',
      'tanggal_kirim' => 'required|date',
      'status' => 'required|in:pending,dikirim,selesai'
    ]);

    // transaksikan perubahan: insert pengiriman + kurangi stok
    DB::beginTransaction();
    try {
      $stok = StokGudangPusat::findOrFail($request->id_produk);

      if ($stok->jumlah < $request->jumlah) {
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

      Pengiriman::create($data);

      // kurangi stok
      $stok->decrement('jumlah', $request->jumlah);

      DB::commit();

      return redirect()->route('gudang.pengiriman.index')
        ->with('success', 'Data pengiriman berhasil ditambahkan!');
    } catch (\Exception $e) {
      DB::rollBack();
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
      'status' => 'required|in:pending,dikirim,selesai'
    ]);

    try {
      $pengiriman = Pengiriman::findOrFail($id);
      $pengiriman->update(['status' => $request->status]);

      return response()->json([
        'success' => true,
        'message' => 'Status pengiriman berhasil diupdate!'
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ], 500);
    }
  }
}
