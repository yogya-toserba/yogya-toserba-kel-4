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
      return redirect()->intended(route('dashboard'))->with('success', 'Login berhasil! Selamat datang ' . Auth::guard('pelanggan')->user()->nama_pelanggan);
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
    return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat datang ' . $pelanggan->nama_pelanggan);
  }

  public function logout(Request $request)
  {
    Auth::guard('pelanggan')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
  }
}
