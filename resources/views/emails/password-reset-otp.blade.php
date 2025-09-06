<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Reset Password - MyYOGYA</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 300;
        }
        .content {
            padding: 40px 30px;
        }
        .otp-code {
            background: #f8f9fa;
            border: 2px dashed #667eea;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-number {
            font-size: 36px;
            font-weight: bold;
            color: #667eea;
            letter-spacing: 8px;
            margin: 10px 0;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
        }
        .warning-icon {
            color: #856404;
            margin-right: 10px;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            font-size: 14px;
            color: #6c757d;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            margin: 20px 0;
        }
        .security-tips {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 15px;
            margin: 20px 0;
        }
        .security-tips h4 {
            color: #1976d2;
            margin-top: 0;
        }
        .security-tips ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        .security-tips li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔐 Reset Password</h1>
            <p>MyYOGYA - Toserba Terpercaya</p>
        </div>
        
        <div class="content">
            <h2>Halo, {{ $user->name ?? 'Pelanggan' }}!</h2>
            
            <p>Kami menerima permintaan untuk mereset password akun Anda. Gunakan kode OTP di bawah ini untuk melanjutkan proses reset password:</p>
            
            <div class="otp-code">
                <p style="margin: 0; font-size: 14px; color: #666;">Kode OTP Anda:</p>
                <div class="otp-number">{{ $otp }}</div>
                <p style="margin: 0; font-size: 12px; color: #888;">
                    Kode berlaku selama: {{ $expires_in }}
                </p>
            </div>
            
            <div class="warning">
                <strong>⚠️ Peringatan Keamanan:</strong>
                <ul style="margin: 10px 0; padding-left: 20px;">
                    <li>Kode OTP ini hanya berlaku selama <strong>15 menit</strong></li>
                    <li>Jangan bagikan kode ini kepada siapa pun</li>
                    <li>MyYOGYA tidak akan pernah meminta kode OTP melalui telepon atau pesan</li>
                    <li>Jika Anda tidak meminta reset password, abaikan email ini</li>
                </ul>
            </div>
            
            <div style="text-align: center;">
                <p>Atau klik tombol di bawah untuk langsung ke halaman verifikasi:</p>
                <a href="{{ url('/password/verify') }}" class="btn">Verifikasi Sekarang</a>
            </div>
            
            <div class="security-tips">
                <h4>💡 Tips Keamanan Password:</h4>
                <ul>
                    <li>Gunakan kombinasi huruf besar, kecil, angka, dan simbol</li>
                    <li>Minimal 8 karakter panjang</li>
                    <li>Jangan gunakan informasi pribadi (nama, tanggal lahir, dll)</li>
                    <li>Gunakan password yang berbeda untuk setiap akun</li>
                    <li>Aktifkan two-factor authentication jika tersedia</li>
                </ul>
            </div>
            
            <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
            
            <p style="font-size: 14px; color: #666;">
                <strong>Butuh bantuan?</strong><br>
                Jika Anda mengalami kesulitan, silakan hubungi customer service kami:
            </p>
            <ul style="font-size: 14px; color: #666; margin: 10px 0;">
                <li>📞 Telepon: (021) 1234-5678</li>
                <li>📧 Email: support@myyogya.com</li>
                <li>💬 Live Chat: melalui website atau aplikasi</li>
            </ul>
        </div>
        
        <div class="footer">
            <p><strong>MyYOGYA</strong> - Toserba Terpercaya Sejak 1975</p>
            <p>Email ini dikirim secara otomatis. Mohon tidak membalas email ini.</p>
            <p style="margin-top: 15px;">
                <a href="#" style="color: #667eea; text-decoration: none;">Privacy Policy</a> | 
                <a href="#" style="color: #667eea; text-decoration: none;">Terms of Service</a> | 
                <a href="#" style="color: #667eea; text-decoration: none;">Contact Us</a>
            </p>
            <p style="margin-top: 15px; font-size: 12px;">
                &copy; {{ date('Y') }} MyYOGYA. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
