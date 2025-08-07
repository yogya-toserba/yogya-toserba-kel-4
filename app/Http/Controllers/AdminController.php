<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except(['showLogin', 'login']);
    }

    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route( 'admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function profile()
    {
        return view('admin.profile', [
            'admin' => Auth::guard('admin')->user()
        ]);
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:admins,email,' . $admin->id],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if (!empty($validated['password'])) {
            $admin->password = bcrypt($validated['password']);
        }

        $admin->save();

        return back()->with('status', 'Profile updated successfully');
    }
}