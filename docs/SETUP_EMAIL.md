# Setup Email untuk Fitur Lupa Password

## Konfigurasi Email Gratis menggunakan Gmail

Untuk menggunakan fitur lupa password, Anda perlu mengkonfigurasi email settings. Berikut cara menggunakan Gmail secara gratis:

### 1. Persiapan Gmail Account

1. Buat atau gunakan akun Gmail yang sudah ada
2. Aktifkan 2-Step Verification di Google Account
3. Generate App Password untuk Laravel:
    - Buka [Google Account Settings](https://myaccount.google.com/)
    - Pilih "Security" → "2-Step Verification"
    - Pilih "App passwords"
    - Generate password untuk "Mail"

### 2. Update File .env

Ganti konfigurasi email di file `.env` dengan:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password-here
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="Yogya Toserba"
```

**Catatan**: Gunakan App Password yang di-generate Google, bukan password Gmail biasa.

### 3. Alternative: Menggunakan Mailtrap (Development)

Untuk testing di development, gunakan [Mailtrap](https://mailtrap.io/):

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yogyatoserba.com"
MAIL_FROM_NAME="Yogya Toserba"
```

### 4. Clear Cache

Setelah mengubah konfigurasi, jalankan:

```bash
php artisan config:clear
php artisan cache:clear
```

## Cara Kerja Fitur Lupa Password

### Flow Process:

1. **Request Reset**: Pelanggan memasukkan email di halaman "Lupa Password"
2. **Send Code**: Sistem generate kode 6 digit dan kirim ke email
3. **Verify Code**: Pelanggan input kode verifikasi
4. **Reset Password**: Setelah verifikasi berhasil, pelanggan bisa set password baru

### Routes yang Tersedia:

-   `GET /pelanggan/forgot-password` - Form lupa password
-   `POST /pelanggan/forgot-password` - Kirim kode verifikasi
-   `GET /pelanggan/verify-code` - Form verifikasi kode
-   `POST /pelanggan/verify-code` - Proses verifikasi kode
-   `GET /pelanggan/reset-password/{token}` - Form reset password
-   `POST /pelanggan/reset-password` - Update password baru

### Security Features:

-   ✅ Kode verifikasi expire dalam 60 menit
-   ✅ Token di-hash di database
-   ✅ Password strength indicator
-   ✅ Validasi email exists di sistem
-   ✅ Rate limiting untuk prevent spam

## Testing

### 1. Test dengan Log Driver (Default)

Jika tidak ingin setup email real, sistem akan log email ke `storage/logs/laravel.log`

### 2. Test dengan Email Real

1. Setup Gmail atau Mailtrap
2. Akses `/pelanggan/forgot-password`
3. Input email pelanggan yang valid
4. Cek inbox untuk kode verifikasi
5. Complete flow reset password

## Troubleshooting

### Error "Connection refused"

-   Pastikan MAIL_HOST dan MAIL_PORT benar
-   Cek firewall/antivirus tidak block koneksi

### Error "Authentication failed"

-   Untuk Gmail: pastikan menggunakan App Password, bukan password akun
-   Pastikan 2-Step Verification aktif di Google Account

### Kode tidak diterima

-   Cek folder spam/junk
-   Pastikan email pelanggan terdaftar di sistem
-   Cek log file di `storage/logs/laravel.log`

## Model & Database

### Tabel: `pelanggan_password_reset_tokens`

```sql
- email (string, primary key)
- token (string, hashed)
- created_at (timestamp)
```

### Model: `PelangganPasswordResetToken`

-   Handle token storage dan validation
-   Auto expire 60 menit

## Keamanan

-   Token di-hash menggunakan bcrypt
-   Email validation ketat
-   Rate limiting untuk prevent abuse
-   Token sekali pakai (deleted after reset)
-   Password strength validation

---

**Note**: Untuk production, disarankan menggunakan service email dedicated seperti SendGrid, Mailgun, atau AWS SES untuk reliabilitas yang lebih baik.
