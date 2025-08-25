# Clean status (Aug 17, 2025)

Repository dibersihkan dan UI diperbaiki tanpa memecahkan fungsi yang ada.

Perubahan utama:

-   Konsolidasi CSS dashboard menjadi satu file: `public/css/dashboard.css`
-   Unused assets to remove (safe to delete if still present):
    -   public/css/flash-sale.css
    -   public/css/flash-sale-new.css
    -   public/css/flash-sale-enhanced.css
    -   public/css/dashboard_backup.css
    -   public/css/dashboard_new.css
    -   public/css/dashboard_original.css
    -   public/css/premium-modal.css
    -   public/js/dashboard_minimal.js
-   Perbaiki layout admin: palet warna gelap yang nyaman (emerald/slate), hover/active jelas, navbar putih bersih
-   Admin routes: perbaiki penamaan `admin.login`, lindungi route sensitif dengan `auth:admin`, tambahkan `admin.profile.update`
-   Admin views: tambahkan `resources/views/admin/profile.blade.php`, perbarui `admin/dashboard.blade.php`
-   Dashboard view: hapus HTML duplikat/korup dan inline script, tombol salin pakai `data-code` (selaras dengan `public/js/dashboard.js`)
-   Route `/dashboard` kini memakai `DashboardController@index`

Catatan:

-   Jika tampilan masih memuat style lama karena cache, jalankan pembersihan cache view/route.

Perintah opsional (jalankan di terminal proyek):

-   php artisan view:clear
-   php artisan route:clear
