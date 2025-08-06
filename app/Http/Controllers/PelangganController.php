<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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

    if (Auth::attempt($credentials)) {
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
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    Auth::login($user);

    return response()->json([
      'status' => 'success',
      'message' => 'Registrasi berhasil!',
      'redirect' => '/'
    ]);
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
  }
}
