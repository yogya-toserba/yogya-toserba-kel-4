<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gudang;
use Illuminate\Routing\Controller as BaseController;

class GudangController extends BaseController
{
    public function __construct()
    {
        // Middleware is handled in routes, not in controller
        // $this->middleware('auth:gudang')->except(['showLogin', 'login']);
    }

    public function showLogin()
    {
        return view('gudang.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'id_gudang' => ['required', 'string', 'regex:/^[0-9]{4,8}$/'],
            'password' => ['required'],
        ]);

        if (Auth::guard('gudang')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $gudang = Auth::guard('gudang')->user();

            // Return JSON response for AJAX requests
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => "Selamat datang, {$gudang->nama_gudang}!",
                    'redirect' => route('gudang.dashboard')
                ]);
            }

            return redirect()->intended(route('gudang.dashboard'));
        }

        // Return JSON response for AJAX requests
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'ID Gudang atau password tidak valid. Silakan periksa kembali data Anda.'
            ], 422);
        }

        return back()->withErrors([
            'id_gudang' => 'ID Gudang atau password tidak valid.',
        ])->onlyInput('id_gudang');
    }

    public function dashboard()
    {
        $gudang = Auth::guard('gudang')->user();
        return view('gudang.dashboard', compact('gudang'));
    }

    public function logout(Request $request)
    {
        Auth::guard('gudang')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('gudang.login');
    }
}
