<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
  public function elektronik()
  {
    $user = Auth::user() ?? Auth::guard('pelanggan')->user();
    return view('dashboard.kategori.elektronik', compact('user'));
  }

  public function fashion()
  {
    $user = Auth::user() ?? Auth::guard('pelanggan')->user();
    return view('dashboard.kategori.fashion', compact('user'));
  }

  public function makanan()
  {
    $user = Auth::user() ?? Auth::guard('pelanggan')->user();
    return view('dashboard.kategori.makanan', compact('user'));
  }

  public function kesehatan()
  {
    $user = Auth::user() ?? Auth::guard('pelanggan')->user();
    return view('dashboard.kategori.kesehatan-kecantikan', compact('user'));
  }

  public function rumahTangga()
  {
    $user = Auth::user() ?? Auth::guard('pelanggan')->user();
    return view('dashboard.kategori.rumah-tangga', compact('user'));
  }

  public function olahraga()
  {
    $user = Auth::user() ?? Auth::guard('pelanggan')->user();
    return view('dashboard.kategori.olahraga', compact('user'));
  }

  public function otomotif()
  {
    $user = Auth::user() ?? Auth::guard('pelanggan')->user();
    return view('dashboard.kategori.otomotif', compact('user'));
  }

  public function buku()
  {
    $user = Auth::user() ?? Auth::guard('pelanggan')->user();
    return view('dashboard.kategori.buku', compact('user'));
  }

  public function perawatan()
  {
    $user = Auth::user() ?? Auth::guard('pelanggan')->user();
    return view('dashboard.kategori.perawatan', compact('user'));
  }
}
