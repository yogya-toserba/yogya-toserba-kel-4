# PowerShell script to update category headers consistently

$categories = @(
    @{
        file = "kesehatan-kecantikan"
        title = "💄 Kesehatan & Kecantikan"
        description = "Produk kesehatan dan kecantikan untuk perawatan diri terbaik"
        breadcrumb = "Kesehatan & Kecantikan"
    },
    @{
        file = "perawatan"
        title = "🧴 Perawatan & Kecantikan"
        description = "Koleksi produk perawatan tubuh dan kecantikan premium"
        breadcrumb = "Perawatan & Kecantikan"
    },
    @{
        file = "rumah-tangga"
        title = "🏠 Rumah Tangga"
        description = "Perlengkapan rumah tangga untuk kehidupan yang lebih nyaman"
        breadcrumb = "Rumah Tangga"
    },
    @{
        file = "olahraga"
        title = "⚽ Olahraga"
        description = "Peralatan olahraga berkualitas untuk gaya hidup sehat"
        breadcrumb = "Olahraga"
    },
    @{
        file = "otomotif"
        title = "🚗 Otomotif"
        description = "Aksesoris dan perlengkapan otomotif terlengkap"
        breadcrumb = "Otomotif"
    },
    @{
        file = "buku"
        title = "📚 Buku & Alat Tulis"
        description = "Buku berkualitas dan alat tulis untuk mendukung pembelajaran"
        breadcrumb = "Buku & Alat Tulis"
    }
)

$categoryDropdown = @"
            <!-- Category Navigation Button -->
            <div class="dropdown">
                <button class="btn btn-category-nav dropdown-toggle d-flex align-items-center" type="button" id="categoryDropdownHeader" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-th-large me-2"></i>
                    Semua Kategori
                </button>
                <ul class="dropdown-menu dropdown-menu-wide dropdown-menu-end" aria-labelledby="categoryDropdownHeader">
                    <li><a class="dropdown-item" href="{{ route('kategori.elektronik') }}">
                        <i class="fas fa-laptop me-2 text-primary"></i>Elektronik
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.fashion') }}">
                        <i class="fas fa-tshirt me-2 text-danger"></i>Fashion
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.makanan') }}">
                        <i class="fas fa-hamburger me-2 text-warning"></i>Makanan & Minuman
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.perawatan') }}">
                        <i class="fas fa-spa me-2 text-info"></i>Perawatan & Kecantikan
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.rumah-tangga') }}">
                        <i class="fas fa-home me-2 text-success"></i>Rumah Tangga
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.olahraga') }}">
                        <i class="fas fa-dumbbell me-2 text-dark"></i>Olahraga
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.otomotif') }}">
                        <i class="fas fa-car me-2 text-secondary"></i>Otomotif
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.buku') }}">
                        <i class="fas fa-book me-2 text-muted"></i>Buku & Alat Tulis
                    </a></li>
                    <li><a class="dropdown-item" href="{{ route('kategori.kesehatan-kecantikan') }}">
                        <i class="fas fa-heart me-2 text-danger"></i>Kesehatan & Kecantikan
                    </a></li>
                </ul>
            </div>
"@

foreach ($category in $categories) {
    $filePath = "resources\views\dashboard\kategori\$($category.file).blade.php"
    
    if (Test-Path $filePath) {
        Write-Host "Updating $($category.file).blade.php..." -ForegroundColor Green
        
        $content = Get-Content $filePath -Raw
        
        # Create new header structure
        $newHeader = @"
<!-- Category Header -->
<div class="category-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <nav class="breadcrumb-custom">
                <a href="{{ route('dashboard') }}">Beranda</a>
                <span class="mx-2">/</span>
                <span>$($category.breadcrumb)</span>
            </nav>
            
$categoryDropdown
        </div>
        
        <h1 class="display-5 fw-bold mb-3">$($category.title)</h1>
        <p class="lead mb-0">$($category.description)</p>
    </div>
</div>
"@

        # Replace old header with new one using regex
        $pattern = '(?s)<!-- Category Header -->.*?</div>\s*</div>'
        
        if ($content -match $pattern) {
            $content = $content -replace $pattern, $newHeader
            Set-Content $filePath $content -Encoding UTF8
            Write-Host "✓ Updated $($category.file).blade.php successfully" -ForegroundColor Cyan
        } else {
            Write-Host "⚠ Could not find header pattern in $($category.file).blade.php" -ForegroundColor Yellow
        }
    } else {
        Write-Host "⚠ File not found: $filePath" -ForegroundColor Red
    }
}

Write-Host "`n✨ Category header updates completed!" -ForegroundColor Green
