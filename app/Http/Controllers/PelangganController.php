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

      return response()->json([
        'status' => 'success',
        'message' => 'Login berhasil!',
        'redirect' => '/'
      ]);
    }

    return response()->json([
      'status' => 'error',
      'message' => 'Email atau password salah!'
    ], 401);
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

    return response()->json([
      'status' => 'success',
      'message' => 'Registrasi berhasil!',
      'redirect' => '/'
    ]);
  }

  public function logout(Request $request)
  {
    Auth::guard('pelanggan')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
  }
}
