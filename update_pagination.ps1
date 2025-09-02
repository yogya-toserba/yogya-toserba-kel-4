# PowerShell script to update pagination in all category files

# Define the categories with their total item counts and page counts
$categories = @{
    'buku' = @{ 'items' = 240; 'pages' = 20; 'name' = 'Buku' }
    'olahraga' = @{ 'items' = 144; 'pages' = 12; 'name' = 'Olahraga' }
    'otomotif' = @{ 'items' = 96; 'pages' = 8; 'name' = 'Otomotif' }
    'perawatan' = @{ 'items' = 192; 'pages' = 16; 'name' = 'Perawatan' }
    'rumah-tangga' = @{ 'items' = 168; 'pages' = 14; 'name' = 'Rumah Tangga' }
}

$basePath = "c:\laragon\www\yogya-toserba-kel-4\resources\views\dashboard\kategori"

foreach ($category in $categories.Keys) {
    $filePath = "$basePath\$category.blade.php"
    $totalItems = $categories[$category]['items']
    $lastPage = $categories[$category]['pages']
    $categoryName = $categories[$category]['name']
    
    Write-Host "Updating $category.blade.php..." -ForegroundColor Green
    
    # Read the file content
    $content = Get-Content $filePath -Raw
    
    # Define the old pagination pattern
    $oldPattern = @"
    <!-- Pagination -->
    <nav class="pagination-custom" aria-label="Product pagination">
        <ul class="pagination">
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
            <li class="page-item active">
                <span class="page-link">1</span>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" title="Go to page 2">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" title="Go to page 3">3</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" title="Go to page 4">4</a>
            </li>
            <li class="page-item">
                <span class="page-link text-muted">...</span>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" title="Go to page $lastPage">$lastPage</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" title="Next page">Next</a>
            </li>
        </ul>
    </nav>
</div>
"@

    # Define the new pagination pattern
    $newPattern = @"
    <!-- Pagination -->
    <nav class="pagination-custom" aria-label="Product pagination">
        <ul class="pagination" id="pagination-container">
            <li class="page-item disabled" id="prev-page">
                <span class="page-link">Previous</span>
            </li>
            <li class="page-item active">
                <span class="page-link">1</span>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" data-page="2" title="Go to page 2">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" data-page="3" title="Go to page 3">3</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" data-page="4" title="Go to page 4">4</a>
            </li>
            <li class="page-item">
                <span class="page-link text-muted">...</span>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" data-page="$lastPage" title="Go to page $lastPage">$lastPage</a>
            </li>
            <li class="page-item" id="next-page">
                <a class="page-link" href="#" title="Next page">Next</a>
            </li>
        </ul>
    </nav>

    <!-- Loading indicator -->
    <div id="pagination-loading" class="text-center my-4" style="display: none;">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <p class="mt-2 text-muted">Memuat produk...</p>
    </div>
</div>

<!-- Include Pagination JavaScript -->
<script src="{{ asset('js/pagination.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize pagination manager for $categoryName category
    window.${category}Manager = new PaginationManager({
        containerSelector: '#pagination-container',
        loadingSelector: '#pagination-loading',
        itemsPerPage: 12,
        totalItems: $totalItems,
        currentPage: 1,
        maxVisiblePages: 4,
        onPageChange: function(page) {
            console.log('$categoryName - Loading page:', page);
            
            // Update URL without reloading page
            const url = new URL(window.location);
            url.searchParams.set('page', page);
            window.history.pushState({}, '', url);
            
            // Scroll to top of products
            document.querySelector('.product-grid').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
            
            // Update product count display
            const start = ((page - 1) * 12) + 1;
            const end = Math.min(page * 12, $totalItems);
            document.querySelector('.text-muted').textContent = `Menampilkan $`{start}-$`{end} dari $totalItems produk`;
        }
    });
});
</script>
"@

    # Replace the content
    if ($content -match [regex]::Escape($oldPattern)) {
        $newContent = $content -replace [regex]::Escape($oldPattern), $newPattern
        Set-Content $filePath $newContent -Encoding UTF8
        Write-Host "Successfully updated $category.blade.php" -ForegroundColor Yellow
    } else {
        Write-Host "Pattern not found in $category.blade.php - may already be updated" -ForegroundColor Red
    }
}

Write-Host "All files processed!" -ForegroundColor Cyan
