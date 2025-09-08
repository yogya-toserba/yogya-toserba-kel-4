
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
  public function showLogin()
  {
    return view('pelanggan.login');
  }

  public function showRegister()
  {
    return view('pelanggan.register');
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    $credentials = $request->only('email', 'password');

    // Try to authenticate using pelanggan guard
    if (Auth::guard('pelanggan')->attempt($credentials)) {
      $request->session()->regenerate();

      // Redirect langsung ke dashboard dengan pesan sukses
      return redirect()->intended(route('pelanggan.dashboard'))->with('success', 'Login berhasil! Selamat datang ' . Auth::guard('pelanggan')->user()->nama_pelanggan);
    }

    // Jika login gagal, kembali ke form login dengan error
    return back()->withErrors([
      'email' => 'Email atau password salah!'
    ])->onlyInput('email');
  }

  public function register(Request $request)
  {
    $request->validate([
      'nama_pelanggan' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:pelanggan',
      'password' => 'required|string|min:8|confirmed',
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|in:L,P',
      'nomer_telepon' => 'required|string|max:20',
      'alamat' => 'required|string',
    ]);

    $pelanggan = Pelanggan::create([
      'nama_pelanggan' => $request->nama_pelanggan,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'tanggal_lahir' => $request->tanggal_lahir,
      'jenis_kelamin' => $request->jenis_kelamin,
      'nomer_telepon' => $request->nomer_telepon,
      'alamat' => $request->alamat,
      'level_membership' => 'Bronze', // default membership
    ]);

    Auth::guard('pelanggan')->login($pelanggan);

    // Redirect langsung ke dashboard dengan pesan sukses setelah registrasi
    return redirect()->route('pelanggan.dashboard')->with('success', 'Registrasi berhasil! Selamat datang ' . $pelanggan->nama_pelanggan);
  }

  public function logout(Request $request)
  {
    Auth::guard('pelanggan')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/')->with('success', 'Anda telah berhasil logout!');
  }

  // Search function for pelanggan
  public function search(Request $request)
  {
    $query = $request->input('q');
    if (!$query) {
      return view('pelanggan.search-results', ['results' => [], 'query' => '']);
    }

    // Example: search products by name
    $results = \DB::table('stok_produk')
      ->where('nama_barang', 'like', "%{$query}%")
      ->limit(10)
      ->get();

    return view('pelanggan.search-results', [
      'results' => $results,
      'query' => $query
    ]);
  }

  public function dashboard()
  {
    // Data for customer dashboard
    $promoSlides = [
        [
            'title' => 'Flash Sale Spektakuler!',
            'description' => 'Diskon hingga 70% untuk produk pilihan',
            'button_text' => 'Belanja Sekarang'
        ],
        [
            'title' => 'Gratis Ongkir Se-Indonesia',
            'description' => 'Minimum pembelian Rp 100.000',
            'button_text' => 'Mulai Belanja'
        ],
        [
            'title' => 'Member Baru? Dapat Voucher!',
            'description' => 'Dapatkan voucher 50% untuk pembelian pertama',
            'button_text' => 'Daftar Sekarang'
        ]
    ];

    $categories = [
        ['name' => 'Elektronik', 'icon' => 'fas fa-laptop', 'color' => '#3498db', 'url' => route('kategori.elektronik'), 'count' => '150'],
        ['name' => 'Fashion', 'icon' => 'fas fa-tshirt', 'color' => '#e74c3c', 'url' => route('kategori.fashion'), 'count' => '320'],
        ['name' => 'Rumah Tangga', 'icon' => 'fas fa-home', 'color' => '#2ecc71', 'url' => route('kategori.rumah-tangga'), 'count' => '95'],
        ['name' => 'Olahraga', 'icon' => 'fas fa-dumbbell', 'color' => '#f39c12', 'url' => route('kategori.olahraga'), 'count' => '75'],
        ['name' => 'Kecantikan', 'icon' => 'fas fa-heart', 'color' => '#e91e63', 'url' => route('kategori.kesehatan-kecantikan'), 'count' => '180'],
        ['name' => 'Makanan', 'icon' => 'fas fa-utensils', 'color' => '#ff9800', 'url' => route('kategori.makanan'), 'count' => '250'],
        ['name' => 'Buku', 'icon' => 'fas fa-book', 'color' => '#9c27b0', 'url' => route('kategori.buku'), 'count' => '65'],
        ['name' => 'Perawatan', 'icon' => 'fas fa-spa', 'color' => '#607d8b', 'url' => route('kategori.perawatan'), 'count' => '120']
    ];

    $popularProducts = [
        [
            'id' => 1,
            'name' => 'Smartphone Flagship Terbaru',
            'price' => 8999000,
            'original_price' => 12999000,
            'rating' => 4.8,
            'sold' => 2350
        ],
        [
            'id' => 2,
            'name' => 'Laptop Gaming Pro',
            'price' => 15999000,
            'original_price' => 21999000,
            'rating' => 4.9,
            'sold' => 1150
        ],
        [
            'id' => 3,
            'name' => 'Wireless Earbuds Premium',
            'price' => 899000,
            'original_price' => 1299000,
            'rating' => 4.7,
            'sold' => 5420
        ],
        [
            'id' => 4,
            'name' => 'Smart Watch Series X',
            'price' => 2499000,
            'original_price' => 3499000,
            'rating' => 4.6,
            'sold' => 3200
        ]
    ];

    return view('pelanggan.dashboard', compact('promoSlides', 'categories', 'popularProducts'));
  }

  public function profile()
  {
    $pelanggan = Auth::guard('pelanggan')->user();
    return view('pelanggan.profile', compact('pelanggan'));
  }

  public function updateProfile(Request $request)
  {
    $pelanggan = Auth::guard('pelanggan')->user();
    
    $request->validate([
      'nama_pelanggan' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:pelanggan,email,' . $pelanggan->id_pelanggan . ',id_pelanggan',
      'nomer_telepon' => 'required|string|max:20',
      'alamat' => 'required|string',
      'tanggal_lahir' => 'required|date',
      'jenis_kelamin' => 'required|in:L,P',
    ]);

    $pelanggan->update([
      'nama_pelanggan' => $request->nama_pelanggan,
      'email' => $request->email,
      'nomer_telepon' => $request->nomer_telepon,
      'alamat' => $request->alamat,
      'tanggal_lahir' => $request->tanggal_lahir,
      'jenis_kelamin' => $request->jenis_kelamin,
    ]);

    return redirect()->route('pelanggan.profile')->with('success', 'Profile berhasil diperbarui!');
  }

  public function updatePassword(Request $request)
  {
    $request->validate([
      'current_password' => 'required',
      'password' => 'required|string|min:8|confirmed',
    ]);

    $pelanggan = Auth::guard('pelanggan')->user();

    if (!Hash::check($request->current_password, $pelanggan->password)) {
      return back()->withErrors(['current_password' => 'Password saat ini tidak benar']);
    }

    $pelanggan->update([
      'password' => Hash::make($request->password),
    ]);

    return redirect()->route('pelanggan.profile')->with('success', 'Password berhasil diperbarui!');
  }
}
