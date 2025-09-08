<!-- Navbar for Guest Users -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <div class="logo-container">
                <img src="{{ asset('image/logo_yogya.png') }}" alt="MyYOGYA" height="45">
                <div class="brand-info">
                    <span class="brand-text">MyYOGYA</span>
                    <span class="brand-tagline">Belanja Pintar</span>
                </div>
             </div>
        </a>

        <!-- Search Bar -->
        <div class="search-container mx-auto">
            <div class="search-box">
                <div class="search-icon-left">
                    <i class="fas fa-search"></i>
                </div>
                <form action="{{ route('pelanggan.search') }}" method="GET" class="position-relative w-100" id="searchForm">
                    <input type="text" class="form-control search-input" name="q" id="searchInput"
                           placeholder="Cari produk, kategori, atau brand favorit Anda..." 
                           value="{{ request('q') }}"
                           autocomplete="off">
                    <button type="submit" class="search-btn">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    <!-- Search Suggestions Dropdown -->
                    <div class="search-suggestions" id="searchSuggestions">
                        <!-- Suggestions will be populated here via AJAX -->
                    </div>
                </form>
            </div>
            <div class="search-suggestions-tags">
                <span class="suggestion-tag">Elektronik</span>
                <span class="suggestion-tag">Fashion</span>
                <span class="suggestion-tag">Makanan</span>
            </div>
        </div>

        <!-- User Actions for Guest -->
        <div class="navbar-actions d-flex align-items-center">
            <div class="nav-item me-2">
                <a href="{{ route('pelanggan.login') }}" class="btn btn-nav-outline">
                    <i class="fas fa-sign-in-alt me-2"></i>Masuk
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('pelanggan.register') }}" class="btn btn-nav-primary">
                    <i class="fas fa-user-plus me-2"></i>Daftar
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Enhanced Search Styles for Guest Navbar -->
<style>
    .search-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        z-index: 1000;
        max-height: 400px;
        overflow-y: auto;
        display: none;
    }
    
    .search-suggestion-item {
        padding: 12px 20px;
        border-bottom: 1px solid #f1f3f4;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
    }
    
    .search-suggestion-item:hover,
    .search-suggestion-item.active {
        background: rgba(242, 107, 55, 0.1);
        color: var(--yogya-orange);
    }
    
    .search-suggestion-item:last-child {
        border-bottom: none;
    }
    
    .suggestion-icon {
        color: var(--yogya-orange);
        margin-right: 10px;
        width: 20px;
    }
    
    .suggestion-text {
        flex-grow: 1;
    }
    
    .suggestion-category {
        font-size: 0.8rem;
        color: #6c757d;
        margin-left: auto;
    }
</style>

<!-- Search Functionality Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const searchSuggestions = document.getElementById('searchSuggestions');
    let searchTimeout;
    
    if (searchInput && searchSuggestions) {
        searchInput.addEventListener('input', function() {
            const query = this.value.trim();
            
            clearTimeout(searchTimeout);
            
            if (query.length < 2) {
                hideSuggestions();
                return;
            }
            
            searchTimeout = setTimeout(() => {
                fetchSuggestions(query);
            }, 300);
        });
        
        searchInput.addEventListener('focus', function() {
            const query = this.value.trim();
            if (query.length >= 2) {
                fetchSuggestions(query);
            }
        });
        
        searchInput.addEventListener('blur', function() {
            // Delay hiding to allow clicking on suggestions
            setTimeout(() => {
                hideSuggestions();
            }, 200);
        });
        
        function fetchSuggestions(query) {
            fetch(`{{ route('pelanggan.search.suggestions') }}?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    displaySuggestions(data);
                })
                .catch(error => {
                    console.error('Error fetching suggestions:', error);
                    hideSuggestions();
                });
        }
        
        function displaySuggestions(suggestions) {
            if (suggestions.length === 0) {
                hideSuggestions();
                return;
            }
            
            let html = '';
            suggestions.forEach(item => {
                html += `
                    <div class="search-suggestion-item" onclick="selectSuggestion('${item.text.replace(/'/g, "\\'")}')">
                        <i class="${item.icon} suggestion-icon"></i>
                        <span class="suggestion-text">${item.text}</span>
                        <span class="suggestion-category">${item.category}</span>
                    </div>
                `;
            });
            
            searchSuggestions.innerHTML = html;
            showSuggestions();
        }
        
        function showSuggestions() {
            searchSuggestions.style.display = 'block';
        }
        
        function hideSuggestions() {
            searchSuggestions.style.display = 'none';
        }
        
        // Global function to select suggestion
        window.selectSuggestion = function(text) {
            searchInput.value = text;
            hideSuggestions();
            
            // Submit the form
            const form = searchInput.closest('form');
            form.submit();
        };
        
        // Hide suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.search-container')) {
                hideSuggestions();
            }
        });
        
        // Handle keyboard navigation
        searchInput.addEventListener('keydown', function(e) {
            const suggestions = searchSuggestions.querySelectorAll('.search-suggestion-item');
            const activeItem = searchSuggestions.querySelector('.search-suggestion-item.active');
            
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                let next = activeItem ? activeItem.nextElementSibling : suggestions[0];
                if (next) {
                    if (activeItem) activeItem.classList.remove('active');
                    next.classList.add('active');
                }
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                let prev = activeItem ? activeItem.previousElementSibling : suggestions[suggestions.length - 1];
                if (prev) {
                    if (activeItem) activeItem.classList.remove('active');
                    prev.classList.add('active');
                }
            } else if (e.key === 'Enter') {
                if (activeItem) {
                    e.preventDefault();
                    activeItem.click();
                }
            } else if (e.key === 'Escape') {
                hideSuggestions();
                searchInput.blur();
            }
        });
    }
});
</script>
