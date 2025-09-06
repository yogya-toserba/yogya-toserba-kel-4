<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PasswordResetToken;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{
    /**
     * Show forgot password form
     */
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send OTP to email
     */
    public function sendOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:pelanggan,email'
        ], [
            'email.exists' => 'Email tidak ditemukan dalam sistem.'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->email;
        $user = Pelanggan::where('email', $email)->first();

        // Generate OTP directly
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Delete old tokens for this email
        DB::table('pelanggan_password_reset_tokens')->where('email', $email)->delete();

        // Insert new token
        DB::table('pelanggan_password_reset_tokens')->insert([
            'email' => $email,
            'token' => $otp,
            'created_at' => now()
        ]);

        // Send email with OTP
        try {
            Mail::send('emails.password-reset-otp', [
                'user' => $user,
                'otp' => $otp,
                'expires_in' => '15 menit'
            ], function ($message) use ($email) {
                $message->to($email)
                    ->subject('Kode Reset Password - MyYOGYA');
            });

            return redirect()->route('password.verify.form')
                ->with('email', $email)
                ->with('success', 'Kode OTP telah dikirim ke email Anda. Silakan cek email dan masukkan kode yang diterima.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email. Silakan coba lagi.');
        }
    }

    /**
     * Show verify OTP form
     */
    public function showVerifyForm()
    {
        if (!session('email')) {
            return redirect()->route('password.request');
        }

        return view('auth.verify-otp');
    }

    /**
     * Verify OTP
     */
    public function verifyOTP(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|string|size:6'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->email;
        $otp = $request->otp;

        // Verify token directly from database
        $resetToken = DB::table('pelanggan_password_reset_tokens')
            ->where('email', $email)
            ->where('token', $otp)
            ->first();

        if (!$resetToken) {
            return back()->with('error', 'Kode OTP tidak valid atau sudah kedaluwarsa.');
        }

        // Check if token is expired (15 minutes)
        $expiresAt = \Carbon\Carbon::parse($resetToken->created_at)->addMinutes(15);
        if (\Carbon\Carbon::now()->gt($expiresAt)) {
            return back()->with('error', 'Kode OTP sudah kedaluwarsa.');
        }

        // Mark token as used (delete it)
        DB::table('pelanggan_password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('password.reset.form')
            ->with('email', $email)
            ->with('token', $resetToken->token)
            ->with('success', 'Kode OTP berhasil diverifikasi. Silakan masukkan password baru.');
    }

    /**
     * Show reset password form
     */
    public function showResetForm()
    {
        if (!session('email') || !session('token')) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password');
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $email = $request->email;
        $user = Pelanggan::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'Pelanggan tidak ditemukan.');
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Delete all reset tokens for this email
        DB::table('pelanggan_password_reset_tokens')->where('email', $email)->delete();

        return redirect()->route('login')
            ->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
    }

    /**
     * Resend OTP
     */
    public function resendOTP(Request $request)
    {
        $email = $request->email ?? session('email');

        if (!$email) {
            return back()->with('error', 'Email tidak ditemukan.');
        }

        $user = Pelanggan::where('email', $email)->first();
        if (!$user) {
            return back()->with('error', 'Pelanggan tidak ditemukan.');
        }

        // Create new OTP token
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Delete old tokens for this email
        DB::table('pelanggan_password_reset_tokens')->where('email', $email)->delete();

        // Insert new token
        DB::table('pelanggan_password_reset_tokens')->insert([
            'email' => $email,
            'token' => $otp,
            'created_at' => now()
        ]);

        // Send email with new OTP
        try {
            Mail::send('emails.password-reset-otp', [
                'user' => $user,
                'otp' => $otp,
                'expires_in' => '15 menit'
            ], function ($message) use ($email) {
                $message->to($email)
                    ->subject('Kode Reset Password Baru - MyYOGYA');
            });

            return back()->with('success', 'Kode OTP baru telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengirim email. Silakan coba lagi.');
        }
    }
}
