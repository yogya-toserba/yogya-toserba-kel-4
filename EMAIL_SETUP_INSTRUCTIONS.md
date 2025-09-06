# 📧 Panduan Lengkap Setup Email Gmail untuk Laravel

## 🚨 **MASALAH YANG DITEMUKAN:**
Error: `Email "ISI_DENGAN_EMAIL_GMAIL_ANDA" does not comply with addr-spec of RFC 2822`

**PENYEBAB:** File `.env` masih menggunakan placeholder yang tidak valid sebagai alamat email.

## ✅ **SOLUSI YANG SUDAH DITERAPKAN:**
1. ✅ Memperbaiki `MAIL_FROM_ADDRESS` dari placeholder menjadi email yang valid
2. ✅ Clear configuration cache Laravel

## 🔧 **LANGKAH SETUP APP PASSWORD GMAIL:**

### 1. **Aktifkan 2-Step Verification:**
   - Buka [Google Account Security](https://myaccount.google.com/security)
   - Klik "2-Step Verification"
   - Ikuti langkah setup verifikasi 2 langkah

### 2. **Generate App Password:**
   - Setelah 2-step verification aktif
   - Kembali ke halaman Security
   - Cari "App passwords" atau "Sandi aplikasi"
   - Klik "Generate" atau "Buat"
   - Pilih "Mail" sebagai aplikasi
   - Copy password 16 digit yang dihasilkan (contoh: `abcd efgh ijkl mnop`)

### 3. **Update File .env:**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=azkacayadi155@gmail.com
MAIL_PASSWORD=GANTI_INI_DENGAN_16_DIGIT_APP_PASSWORD  # Paste app password di sini (tanpa spasi)
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=azkacayadi155@gmail.com
MAIL_FROM_NAME="Yogya Toserba"
```

### 4. **Test Email:**
   - Jalankan: `php artisan config:clear`
   - Buka browser: `http://127.0.0.1:8000/tes-email`
   - Check inbox di `fikrihaikal170308@gmail.com`

## 🛠️ **ALTERNATIF JIKA GMAIL BERMASALAH:**

### Gunakan Mailtrap (Testing Email - Gratis):
1. Daftar di [Mailtrap.io](https://mailtrap.io)
2. Buat inbox baru
3. Copy credentials dari dashboard
4. Update `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username  # Dari dashboard Mailtrap
MAIL_PASSWORD=your-mailtrap-password  # Dari dashboard Mailtrap
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yogyatoserba.com"
MAIL_FROM_NAME="Yogya Toserba"
```

## 🐛 **DEBUG MODE (Jika masih error):**
Set ke log mode untuk debugging:
```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS="noreply@yogyatoserba.com"
MAIL_FROM_NAME="Yogya Toserba"
```

Email akan tersimpan di `storage/logs/laravel.log`

## 📋 **CHECKLIST TROUBLESHOOTING:**
- [ ] App Password Gmail 16 digit sudah benar
- [ ] 2-Step Verification Gmail sudah aktif
- [ ] File `.env` tidak ada placeholder `ISI_DENGAN_*`
- [ ] Sudah jalankan `php artisan config:clear`
- [ ] Port 587 tidak diblokir firewall/antivirus
- [ ] Internet connection stabil

## 🎯 **STATUS SAAT INI:**
✅ Email format sudah diperbaiki
✅ Configuration cache sudah di-clear
⏳ **YANG PERLU DILAKUKAN:** Ganti `MAIL_PASSWORD` dengan App Password Gmail yang valid

Setelah mengikuti langkah di atas, test kembali di `/tes-email`
