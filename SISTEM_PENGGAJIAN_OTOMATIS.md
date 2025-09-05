# 🎯 Sistem Penggajian Otomatis - Yogya Toserba

## 📋 Overview

Sistem penggajian otomatis yang menghitung gaji karyawan berdasarkan **shift**, **absensi**, dan **jabatan** dengan berbagai jenis karyawan.

## 👥 Jenis Karyawan & Konfigurasi Gaji

### 💼 Kasir

-   **Tanggung Jawab**: Menerima pembayaran, melayani transaksi
-   **Gaji Pokok**: Rp 3.300.000/bulan
-   **Tunjangan Jabatan**: Rp 300.000/bulan
-   **Bonus Kehadiran**: Rp 25.000/hari
-   **Bonus Shift Malam**: Rp 15.000/shift
-   **Denda Terlambat**: Rp 2.000/menit

### 🛒 Pramuniaga (Store Crew)

-   **Tanggung Jawab**: Menata barang di rak, memberi informasi produk, cek stok
-   **Gaji Pokok**: Rp 2.860.000/bulan
-   **Tunjangan Jabatan**: Rp 250.000/bulan
-   **Bonus Kehadiran**: Rp 20.000/hari
-   **Bonus Shift Malam**: Rp 12.000/shift
-   **Denda Terlambat**: Rp 1.500/menit

### 📞 Customer Service

-   **Tanggung Jawab**: Melayani komplain, informasi promo/member
-   **Gaji Pokok**: Rp 3.080.000/bulan
-   **Tunjangan Jabatan**: Rp 275.000/bulan
-   **Bonus Kehadiran**: Rp 22.000/hari
-   **Bonus Shift Malam**: Rp 13.000/shift
-   **Denda Terlambat**: Rp 1.800/menit

### 📦 Bagian Gudang/Receiving

-   **Tanggung Jawab**: Terima barang dari supplier, cek kualitas & kuantitas
-   **Gaji Pokok**: Rp 3.190.000/bulan
-   **Tunjangan Jabatan**: Rp 280.000/bulan
-   **Bonus Kehadiran**: Rp 23.000/hari
-   **Bonus Shift Malam**: Rp 14.000/shift
-   **Denda Terlambat**: Rp 1.700/menit

## 🔧 Fitur Sistem

### ⚡ Perhitungan Otomatis

-   **Gaji Pokok**: Berdasarkan hari kehadiran
-   **Tunjangan**: Fixed per jabatan
-   **Bonus Kehadiran**: Per hari hadir
-   **Bonus Shift Malam**: Otomatis untuk shift 22:00-06:00
-   **Lembur**: Rp 18.000-20.000/jam (tergantung jabatan)
-   **Potongan**: BPJS (1%), Pajak PPh21, keterlambatan, absen

### 📊 Analitik & Laporan

-   Dashboard per jabatan
-   Trend kehadiran bulanan
-   Perbandingan gaji antar posisi
-   Export data Excel/PDF

### 🎛️ Konfigurasi Fleksibel

-   Setting gaji per jabatan
-   Konfigurasi shift dan tunjangan
-   Aturan bonus dan potongan

## 📁 Struktur File

### 🎯 Controllers

-   `GajiOtomatisController.php` - Main controller untuk sistem baru
-   `PenggajianOtomatisService.php` - Business logic

### 🗃️ Models

-   `Shift.php` - Model shift dengan tunjangan
-   `Absensi.php` - Model absensi dengan tracking waktu
-   `JadwalKerja.php` - Model jadwal kerja
-   `Gaji.php` - Model gaji (existing, enhanced)
-   `Jabatan.php` - Model jabatan dengan konfigurasi

### 🌐 Routes

```php
// Admin Routes untuk Gaji Otomatis
Route::prefix('admin/gaji-otomatis')->name('admin.gaji-otomatis.')->group(function () {
    Route::get('/', [GajiOtomatisController::class, 'index'])->name('index');
    Route::post('/generate', [GajiOtomatisController::class, 'generateOtomatis'])->name('generate');
    Route::get('/preview', [GajiOtomatisController::class, 'previewGaji'])->name('preview');
    Route::get('/detail/{id}', [GajiOtomatisController::class, 'detail'])->name('detail');
    Route::get('/analytics', [GajiOtomatisController::class, 'analytics'])->name('analytics');
});
```

### 🎨 Views

-   `admin/gaji-otomatis/index.blade.php` - Halaman utama
-   `admin/gaji-otomatis/detail.blade.php` - Detail perhitungan
-   `admin/gaji-otomatis/analytics.blade.php` - Dashboard analitik

## 🚀 Cara Penggunaan

### 1. 📅 Generate Gaji Bulanan

```php
// Akses: /admin/gaji-otomatis
1. Pilih bulan dan tahun
2. Klik "Preview" untuk melihat perhitungan
3. Klik "Generate Gaji Otomatis"
4. Sistem akan menghitung semua gaji karyawan
```

### 2. 🔍 Analisis Data

```php
// Akses: /admin/gaji-otomatis/analytics
- Grafik gaji per bulan
- Statistik per jabatan
- Trend kehadiran
- Perbandingan performa
```

### 3. ⚙️ Konfigurasi

```php
// Update gaji jabatan melalui:
- Admin panel jabatan
- Database seeder
- Direct model update
```

## 💾 Database Schema

### 📊 Tabel Shift (Enhanced)

```sql
ALTER TABLE shift ADD COLUMN tunjangan_shift DECIMAL(10,2) DEFAULT 0;
ALTER TABLE shift ADD COLUMN deskripsi TEXT;
ALTER TABLE shift ADD COLUMN is_shift_malam BOOLEAN DEFAULT FALSE;
```

### ⏰ Tabel Absensi (Enhanced)

```sql
ALTER TABLE absensi ADD COLUMN jam_masuk TIME NULL;
ALTER TABLE absensi ADD COLUMN jam_keluar TIME NULL;
ALTER TABLE absensi ADD COLUMN terlambat_menit INT DEFAULT 0;
ALTER TABLE absensi ADD COLUMN pulang_awal_menit INT DEFAULT 0;
ALTER TABLE absensi ADD COLUMN durasi_kerja_jam DECIMAL(5,2) DEFAULT 0;
```

## 🎯 Contoh Perhitungan

### 📋 Kasir - Andi (22 hari kerja, 20 hari hadir)

```php
Gaji Pokok       : Rp 3.300.000 / 22 * 20 = Rp 3.000.000
Tunjangan        : Rp 300.000
Bonus Kehadiran  : Rp 25.000 * 20 = Rp 500.000
Bonus Shift Malam: Rp 15.000 * 5 = Rp 75.000 (5 shift malam)
Lembur           : Rp 20.000 * 10 = Rp 200.000 (10 jam)

Sub Total        : Rp 4.075.000

Potongan BPJS    : Rp 33.000 (1% dari gaji pokok + tunjangan)
Potongan Pajak   : Rp 15.000 (PPh21)
Denda Terlambat  : Rp 20.000 (10 menit * 2000 * 10 hari)

Total Potongan   : Rp 68.000

GAJI BERSIH      : Rp 4.007.000
```

## 🎨 Screenshot & Preview

### 📱 Dashboard Utama

-   Filter periode bulan/tahun
-   Statistik cards (total karyawan, gaji dibayar, rata-rata)
-   Tabel data gaji dengan status
-   Actions (view detail, print slip)

### 📈 Analytics Page

-   Chart gaji per bulan
-   Pie chart per jabatan
-   Trend kehadiran
-   Export options

## ⚠️ Notes & Considerations

### 🔒 Security

-   Middleware auth:admin required
-   Role-based access control
-   Data validation on all inputs

### 🚀 Performance

-   Pagination untuk data besar
-   Indexed database queries
-   Caching untuk reports

### 🔄 Maintenance

-   Monthly data cleanup
-   Backup gaji data
-   Audit trail untuk perubahan

## 🎯 Future Enhancements

### 📋 Planned Features

-   📱 Mobile app untuk absensi
-   🤖 AI untuk prediksi gaji
-   📊 Advanced reporting
-   🔗 Integration dengan payroll bank
-   📧 Email slip gaji otomatis

### 🛠️ Technical Improvements

-   Queue jobs untuk bulk processing
-   Real-time notifications
-   API endpoints untuk integrasi
-   Advanced caching strategies

---

## 🎉 Conclusion

Sistem penggajian otomatis ini memberikan:

-   ✅ **Akurasi tinggi** dalam perhitungan
-   ⚡ **Efisiensi waktu** pemrosesan
-   📊 **Transparansi** dalam penggajian
-   🔄 **Fleksibilitas** konfigurasi
-   📈 **Analitik mendalam** untuk pengambilan keputusan

**Ready to use!** 🚀 Sistem sudah terintegrasi dengan database existing dan siap untuk production.
