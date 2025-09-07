<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\PelangganPasswordResetToken;
use App\Notifications\PelangganResetPasswordNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PelangganForgotPasswordController extends Controller
{
    /**
     * Display the forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('pelanggan.forgot-password');
    }

    /**
     * Send reset password code to email
     */
    public function sendResetCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:pelanggan,email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email tidak ditemukan dalam sistem kami.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->email;
        $pelanggan = Pelanggan::where('email', $email)->first();

        // Generate 6 digit random code
        $token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Delete existing token
        PelangganPasswordResetToken::where('email', $email)->delete();

        // Create new token
        PelangganPasswordResetToken::create([
            'email' => $email,
            'token' => Hash::make($token),
            'created_at' => Carbon::now(),
        ]);

        // Send notification
        $pelanggan->notify(new PelangganResetPasswordNotification($token, $email));

        return back()->with('status', 'Kode verifikasi telah dikirim ke email Anda. Silakan cek inbox atau folder spam.');
    }

    /**
     * Show reset password form with token
     */
    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('pelanggan.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    /**
     * Show verify code form
     */
    public function showVerifyCodeForm()
    {
        return view('pelanggan.verify-code');
    }

    /**
     * Verify the reset code
     */
    public function verifyCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:pelanggan,email',
            'code' => 'required|string|size:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email tidak ditemukan.',
            'code.required' => 'Kode verifikasi wajib diisi.',
            'code.size' => 'Kode verifikasi harus 6 digit.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $resetRecord = PelangganPasswordResetToken::where('email', $request->email)->first();

        if (!$resetRecord) {
            return back()->withErrors(['code' => 'Kode verifikasi tidak valid atau sudah kadaluarsa.'])->withInput();
        }

        // Check if token is expired (60 minutes)
        if (Carbon::parse($resetRecord->created_at)->addMinutes(60)->isPast()) {
            $resetRecord->delete();
            return back()->withErrors(['code' => 'Kode verifikasi sudah kadaluarsa. Silakan minta kode baru.'])->withInput();
        }

        // Verify the code
        if (!Hash::check($request->code, $resetRecord->token)) {
            return back()->withErrors(['code' => 'Kode verifikasi tidak valid.'])->withInput();
        }

        // Generate URL-safe token for password reset form
        $urlToken = Str::random(64);

        // Update the record with new token for reset form
        $resetRecord->update([
            'token' => Hash::make($urlToken),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('pelanggan.password.reset', [
            'token' => $urlToken,
            'email' => $request->email
        ])->with('status', 'Kode verifikasi berhasil. Silakan masukkan password baru Anda.');
    }

    /**
     * Reset the password
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:pelanggan,email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email tidak ditemukan.',
            'token.required' => 'Token tidak valid.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $resetRecord = PelangganPasswordResetToken::where('email', $request->email)->first();

        if (!$resetRecord) {
            return back()->withErrors(['token' => 'Token reset password tidak valid.'])->withInput();
        }

        // Check if token is expired (60 minutes)
        if (Carbon::parse($resetRecord->created_at)->addMinutes(60)->isPast()) {
            $resetRecord->delete();
            return back()->withErrors(['token' => 'Token reset password sudah kadaluarsa.'])->withInput();
        }

        // Verify the token
        if (!Hash::check($request->token, $resetRecord->token)) {
            return back()->withErrors(['token' => 'Token reset password tidak valid.'])->withInput();
        }

        // Update password
        $pelanggan = Pelanggan::where('email', $request->email)->first();
        $pelanggan->update([
            'password' => Hash::make($request->password)
        ]);

        // Delete the reset token
        $resetRecord->delete();

        return redirect()->route('pelanggan.login')->with('status', 'Password berhasil direset. Silakan login dengan password baru Anda.');
    }
}
