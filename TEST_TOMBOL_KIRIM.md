# Test Tombol Kirim Pengiriman

## Langkah-langkah untuk test:

1. **Generate Test Data**
   - Akses: `http://127.0.0.1:8000/gudang/test-data`
   - Ini akan membuat data pengiriman dengan status "Siap Kirim"

2. **Akses Halaman Pengiriman**
   - Akses: `http://127.0.0.1:8000/gudang/pengiriman`
   - Pastikan data muncul dengan status "Siap Kirim"

3. **Test Tombol Kirim**
   - Klik dropdown (3 titik) pada baris pengiriman
   - Pastikan menu dropdown muncul
   - Klik "Kirim" 
   - SweetAlert should appear

4. **Debug Page**
   - Akses: `http://127.0.0.1:8000/gudang/debug-kirim`
   - Test function langsung dari sini

## Troubleshooting:

### Jika tombol tidak bisa diklik:
1. Cek console browser (F12) untuk error JavaScript
2. Pastikan SweetAlert loaded
3. Pastikan jQuery loaded
4. Cek CSRF token

### Jika dropdown tidak muncul:
1. Pastikan Bootstrap JavaScript loaded
2. Cek CSS conflicts

### Jika AJAX error:
1. Cek Laravel log: `storage/logs/laravel.log`
2. Cek network tab di browser
3. Pastikan route ada

## Expected Behavior:
1. Tombol "Kirim" muncul hanya untuk status "Siap Kirim"
2. Klik "Kirim" → SweetAlert konfirmasi
3. Konfirmasi → Loading → Success → Redirect ke penerimaan
4. Status pengiriman berubah menjadi "Dikirim"
5. Data muncul di halaman penerimaan

## Quick Commands:
```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Check routes
php artisan route:list | findstr pengiriman

# Check logs
tail -f storage/logs/laravel.log
```
