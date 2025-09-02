$categories = @('buku', 'kesehatan-kecantikan', 'makanan', 'olahraga', 'otomotif', 'perawatan', 'rumah-tangga')

foreach ($category in $categories) {
    $file = "$category.blade.php"
    $fullPath = "c:\laragon\www\yogya-toserba-kel-4\resources\views\dashboard\kategori\$file"
    
    if (Test-Path $fullPath) {
        Write-Host "Processing $file..." -ForegroundColor Yellow
        
        $content = Get-Content $fullPath -Raw
        
        # Remove pagination script includes and initialization
        $content = $content -replace '<!-- Include Pagination JavaScript -->', '<!-- Pagination functionality disabled as requested -->'
        $content = $content -replace '<script src="{{ asset\(''js/pagination\.js''\) }}"></script>', ''
        $content = $content -replace '<script>\s*document\.addEventListener\(''DOMContentLoaded''.*?window\.\w+Manager.*?}\);\s*}\);\s*</script>', ''
        
        Set-Content $fullPath $content -NoNewline
        Write-Host "$file updated successfully" -ForegroundColor Green
    } else {
        Write-Host "$file not found" -ForegroundColor Red
    }
}

Write-Host "All files processed" -ForegroundColor Cyan
