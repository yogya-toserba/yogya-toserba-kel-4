# PowerShell script to update pagination in all category files to new format

# Define categories with their specific data
$categories = @{
    'makanan' = @{ items = 180; pages = 15 }
    'kesehatan-kecantikan' = @{ items = 576; pages = 48 }
    'buku' = @{ items = 240; pages = 20 }
    'olahraga' = @{ items = 144; pages = 12 }
    'otomotif' = @{ items = 96; pages = 8 }
    'perawatan' = @{ items = 192; pages = 16 }
    'rumah-tangga' = @{ items = 168; pages = 14 }
}

$basePath = "c:\laragon\www\yogya-toserba-kel-4\resources\views\dashboard\kategori"

foreach ($category in $categories.Keys) {
    $filePath = "$basePath\$category.blade.php"
    $totalItems = $categories[$category]['items']
    $totalPages = $categories[$category]['pages']
    
    Write-Host "Updating $category.blade.php..." -ForegroundColor Green
    
    # Read the file content
    $content = Get-Content $filePath -Raw
    
    # Old script pattern to replace
    $oldPattern = @"
document\.addEventListener\('DOMContentLoaded', function\(\) \{
    \/\/ Initialize pagination manager for .+ category
    window\..+Manager = new PaginationManager\(\{
        containerSelector: '#pagination-container',
        loadingSelector: '#pagination-loading',
        itemsPerPage: 12,
        totalItems: \d+,
        currentPage: 1,
        maxVisiblePages: 4,
        onPageChange: function\(page\) \{[\s\S]*?\}
    \}\);
\}\);
"@

    # New script pattern
    $newPattern = @"
document.addEventListener('DOMContentLoaded', function() {
    // Initialize pagination manager for $category category
    window.${category}Manager = new PaginationManager({
        totalPages: $totalPages,
        itemsPerPage: 12,
        totalItems: $totalItems,
        paginationId: 'pagination-container',
        pageInfoSelector: '.text-muted',
        productGridSelector: '.product-grid'
    });
});
"@

    # Replace using regex
    if ($content -match $oldPattern) {
        $newContent = $content -replace $oldPattern, $newPattern
        Set-Content $filePath $newContent -Encoding UTF8
        Write-Host "Successfully updated $category.blade.php" -ForegroundColor Yellow
    } else {
        Write-Host "Pattern not found or already updated in $category.blade.php" -ForegroundColor Cyan
    }
}

Write-Host "All files processed!" -ForegroundColor Green
