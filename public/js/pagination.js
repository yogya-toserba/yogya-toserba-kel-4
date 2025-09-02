/**
 * Universal Pagination System for Category Pages
 * Handles pagination logic for all product category pages
 */

class PaginationManager {
    constructor(options = {}) {
        this.currentPage = 1;
        this.itemsPerPage = options.itemsPerPage || 12;
        this.totalItems = options.totalItems || 234;
        this.totalPages = options.totalPages || Math.ceil(this.totalItems / this.itemsPerPage);
        this.paginationId = options.paginationId || 'pagination';
        this.pageInfoSelector = options.pageInfoSelector || '.text-muted';
        this.productGridSelector = options.productGridSelector || '.product-grid';
        
        // Store original products as templates
        this.originalProducts = [];
        this.storeOriginalProducts();
        
        this.init();
    }
    
    storeOriginalProducts() {
        const productGrid = document.querySelector(this.productGridSelector);
        if (productGrid) {
            const products = productGrid.querySelectorAll('.product-card');
            this.originalProducts = Array.from(products).map(product => product.cloneNode(true));
        }
    }
    
    init() {
        this.bindEvents();
        this.updatePageInfo();
    }
    
    bindEvents() {
        const pagination = document.getElementById(this.paginationId);
        if (!pagination) return;
        
        // Bind click events to pagination links
        pagination.addEventListener('click', (e) => {
            e.preventDefault();
            const link = e.target.closest('.page-link');
            if (!link) return;
            
            const pageItem = link.closest('.page-item');
            if (pageItem.classList.contains('disabled')) return;
            
            // Handle previous button
            if (pageItem.id === 'prev-page' || pageItem.id === 'prevPage') {
                this.changePage('prev');
                return;
            }
            
            // Handle next button  
            if (pageItem.id === 'next-page' || pageItem.id === 'nextPage') {
                this.changePage('next');
                return;
            }
            
            // Handle numbered pages
            const pageNumber = link.getAttribute('data-page') || link.textContent;
            if (pageNumber && !isNaN(pageNumber)) {
                this.changePage(parseInt(pageNumber));
            }
        });
    }
    
    updatePagination() {
        const pagination = document.getElementById(this.paginationId);
        if (!pagination) return;
        
        const prevButton = document.getElementById('prevPage');
        const nextButton = document.getElementById('nextPage');
        
        // Clear existing page numbers
        const pageItems = pagination.querySelectorAll('.page-item[data-page]');
        pageItems.forEach(item => item.remove());
        
        // Calculate page range to show (show 4 pages at a time)
        let startPage = Math.max(1, this.currentPage - 1);
        let endPage = Math.min(this.totalPages, startPage + 3);
        
        // Adjust start page if we're near the end
        if (endPage - startPage < 3) {
            startPage = Math.max(1, endPage - 3);
        }
        
        // Create page number buttons
        for (let i = startPage; i <= endPage; i++) {
            const pageItem = document.createElement('li');
            pageItem.className = `page-item ${i === this.currentPage ? 'active' : ''}`;
            pageItem.setAttribute('data-page', i);
            
            const pageLink = document.createElement('a');
            pageLink.className = 'page-link';
            pageLink.href = '#';
            pageLink.textContent = i;
            pageLink.onclick = (e) => {
                e.preventDefault();
                this.changePage(i);
            };
            
            pageItem.appendChild(pageLink);
            nextButton.parentNode.insertBefore(pageItem, nextButton);
        }
        
        // Update Previous button state
        if (this.currentPage <= 1) {
            prevButton.classList.add('disabled');
            prevButton.querySelector('a').style.pointerEvents = 'none';
            prevButton.querySelector('a').style.opacity = '0.5';
        } else {
            prevButton.classList.remove('disabled');
            prevButton.querySelector('a').style.pointerEvents = 'auto';
            prevButton.querySelector('a').style.opacity = '1';
        }
        
        // Update Next button state
        if (this.currentPage >= this.totalPages) {
            nextButton.classList.add('disabled');
            nextButton.querySelector('a').style.pointerEvents = 'none';
            nextButton.querySelector('a').style.opacity = '0.5';
        } else {
            nextButton.classList.remove('disabled');
            nextButton.querySelector('a').style.pointerEvents = 'auto';
            nextButton.querySelector('a').style.opacity = '1';
        }
    }
    
    changePage(page) {
        // Pagination disabled - do nothing
        console.log('Pagination has been disabled');
        return;
    }
    
    updatePageInfo() {
        const pageInfo = document.querySelector(this.pageInfoSelector);
        if (pageInfo) {
            const startItem = (this.currentPage - 1) * this.itemsPerPage + 1;
            const endItem = Math.min(this.currentPage * this.itemsPerPage, this.totalItems);
            pageInfo.textContent = `Menampilkan ${startItem}-${endItem} dari ${this.totalItems} produk`;
        }
    }
    
    updatePaginationControls() {
        const pagination = document.getElementById(this.paginationId);
        if (!pagination) return;
        
        // Update previous button
        const prevButton = pagination.querySelector('#prev-page, #prevPage');
        if (prevButton) {
            if (this.currentPage <= 1) {
                prevButton.classList.add('disabled');
            } else {
                prevButton.classList.remove('disabled');
            }
        }
        
        // Update next button
        const nextButton = pagination.querySelector('#next-page, #nextPage');
        if (nextButton) {
            if (this.currentPage >= this.totalPages) {
                nextButton.classList.add('disabled');
            } else {
                nextButton.classList.remove('disabled');
            }
        }
        
        // Update active page
        pagination.querySelectorAll('.page-item').forEach(item => {
            item.classList.remove('active');
            const link = item.querySelector('.page-link');
            if (link) {
                const pageNum = link.getAttribute('data-page') || link.textContent;
                if (parseInt(pageNum) === this.currentPage) {
                    item.classList.add('active');
                }
            }
        });
    }
    
    showLoadingState() {
        const productGrid = document.querySelector(this.productGridSelector);
        if (productGrid) {
            productGrid.style.opacity = '0.5';
            productGrid.style.pointerEvents = 'none';
            
            // Add loading spinner
            const loadingDiv = document.createElement('div');
            loadingDiv.id = 'pagination-loading';
            loadingDiv.className = 'text-center p-4';
            loadingDiv.innerHTML = `
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-muted">Memuat produk...</p>
            `;
            productGrid.parentNode.insertBefore(loadingDiv, productGrid.nextSibling);
        }
    }
    
    hideLoadingState() {
        const productGrid = document.querySelector(this.productGridSelector);
        const loadingDiv = document.getElementById('pagination-loading');
        
        if (productGrid) {
            productGrid.style.opacity = '1';
            productGrid.style.pointerEvents = 'auto';
        }
        
        if (loadingDiv) {
            loadingDiv.remove();
        }
    }
    
    triggerPageChangeEvent() {
        const event = new CustomEvent('pageChanged', {
            detail: {
                currentPage: this.currentPage,
                totalPages: this.totalPages,
                startItem: (this.currentPage - 1) * this.itemsPerPage + 1,
                endItem: Math.min(this.currentPage * this.itemsPerPage, this.totalItems)
            }
        });
        document.dispatchEvent(event);
    }
    
    // Public method to set page externally
    setPage(page) {
        this.changePage(page);
    }
    
    // Public method to get current page
    getCurrentPage() {
        return this.currentPage;
    }
    
    // Public method to update total items (useful for filtering)
    updateTotalItems(newTotal) {
        this.totalItems = newTotal;
        this.totalPages = Math.ceil(this.totalItems / this.itemsPerPage);
        
        // Reset to page 1 if current page is beyond new total
        if (this.currentPage > this.totalPages) {
            this.currentPage = 1;
        }
        
        this.updatePagination();
        this.updatePageInfo();
    }
    
    // Dummy products generation removed - pagination disabled
    
    // Removed dummy products functions
    
    generateProductData(category, page, itemIndex, globalIndex) {
        const productTemplates = this.getProductTemplates(category);
        const templateIndex = (globalIndex - 1) % productTemplates.length;
        const template = productTemplates[templateIndex];
        
        // Add page and item variation
        const basePrice = template.basePrice;
        const priceVariation = (page * 10000) + (itemIndex * 5000);
        const finalPrice = basePrice + priceVariation;
        
        const discountChance = Math.random();
        let discount = null;
        let originalPrice = null;
        
        if (discountChance > 0.6) { // 40% chance of discount
            const discountPercent = Math.floor(Math.random() * 30) + 10; // 10-40% discount
            originalPrice = Math.floor(finalPrice * (1 + discountPercent / 100));
            discount = `${discountPercent}%`;
        }
        
        return {
            name: `${template.name} - Edisi Hal.${page} #${itemIndex}`,
            price: `Rp ${finalPrice.toLocaleString('id-ID')}`,
            originalPrice: originalPrice ? `Rp ${originalPrice.toLocaleString('id-ID')}` : null,
            discount: discount,
            rating: template.rating + (Math.random() * 0.4 - 0.2), // Slight rating variation
            reviews: template.reviews + Math.floor(Math.random() * 50),
            image: template.image,
            page: page,
            itemIndex: itemIndex
        };
    }
    
    getProductTemplates(category) {
        const templates = {
            fashion: [
                { name: 'Kemeja Katun Premium', basePrice: 150000, rating: 4.5, reviews: 45, image: 'fashion1.jpg' },
                { name: 'Dress Elegant Modern', basePrice: 280000, rating: 4.7, reviews: 32, image: 'fashion2.jpg' },
                { name: 'Jaket Denim Stylish', basePrice: 320000, rating: 4.6, reviews: 28, image: 'fashion3.jpg' },
                { name: 'Celana Jeans Slim Fit', basePrice: 200000, rating: 4.4, reviews: 67, image: 'fashion4.jpg' },
                { name: 'Blouse Chiffon Cantik', basePrice: 180000, rating: 4.8, reviews: 89, image: 'fashion5.jpg' },
                { name: 'Rok Plisket Elegan', basePrice: 160000, rating: 4.3, reviews: 23, image: 'fashion6.jpg' },
                { name: 'Sweater Rajut Hangat', basePrice: 220000, rating: 4.6, reviews: 54, image: 'fashion7.jpg' },
                { name: 'Kaos Polo Classic', basePrice: 95000, rating: 4.2, reviews: 156, image: 'fashion8.jpg' },
                { name: 'Blazer Formal Office', basePrice: 450000, rating: 4.8, reviews: 34, image: 'fashion9.jpg' },
                { name: 'Scarf Silk Premium', basePrice: 125000, rating: 4.5, reviews: 78, image: 'fashion10.jpg' },
                { name: 'Cardigan Knit Cozy', basePrice: 185000, rating: 4.4, reviews: 92, image: 'fashion11.jpg' },
                { name: 'Tank Top Summer', basePrice: 75000, rating: 4.3, reviews: 167, image: 'fashion12.jpg' }
            ],
            elektronik: [
                { name: 'Smartphone Android Flagship', basePrice: 8500000, rating: 4.8, reviews: 432, image: 'phone1.jpg' },
                { name: 'Laptop Gaming RTX 4060', basePrice: 15000000, rating: 4.7, reviews: 89, image: 'laptop1.jpg' },
                { name: 'Smart TV OLED 55 Inch', basePrice: 12000000, rating: 4.6, reviews: 156, image: 'tv1.jpg' },
                { name: 'Earbuds ANC Premium', basePrice: 1200000, rating: 4.7, reviews: 445, image: 'earbuds1.jpg' },
                { name: 'Tablet Pro 12.9 Inch', basePrice: 6800000, rating: 4.5, reviews: 78, image: 'tablet1.jpg' },
                { name: 'Smartwatch Ultra GPS', basePrice: 2500000, rating: 4.6, reviews: 167, image: 'watch1.jpg' },
                { name: 'Gaming Mouse Wireless', basePrice: 850000, rating: 4.4, reviews: 234, image: 'mouse1.jpg' },
                { name: 'Mechanical Keyboard RGB', basePrice: 1200000, rating: 4.8, reviews: 123, image: 'keyboard1.jpg' },
                { name: 'Monitor Gaming 27 Inch', basePrice: 3500000, rating: 4.5, reviews: 98, image: 'monitor1.jpg' },
                { name: 'Webcam 4K Streaming', basePrice: 650000, rating: 4.3, reviews: 187, image: 'webcam1.jpg' },
                { name: 'Speaker Bluetooth Premium', basePrice: 900000, rating: 4.6, reviews: 256, image: 'speaker1.jpg' },
                { name: 'Power Bank 20000mAh', basePrice: 450000, rating: 4.4, reviews: 389, image: 'powerbank1.jpg' }
            ],
            makanan: [
                { name: 'Kopi Arabica Single Origin', basePrice: 125000, rating: 4.8, reviews: 892, image: 'coffee1.jpg' },
                { name: 'Mie Instan Rasa Rendang', basePrice: 4500, rating: 4.2, reviews: 1234, image: 'mie1.jpg' },
                { name: 'Biskuit Chocolate Chip', basePrice: 18000, rating: 4.5, reviews: 567, image: 'biskuit1.jpg' },
                { name: 'Teh Hijau Premium Organik', basePrice: 65000, rating: 4.6, reviews: 234, image: 'teh1.jpg' },
                { name: 'Keripik Pisang Original', basePrice: 15000, rating: 4.3, reviews: 789, image: 'keripik1.jpg' },
                { name: 'Cokelat Swiss Dark 70%', basePrice: 45000, rating: 4.7, reviews: 345, image: 'cokelat1.jpg' },
                { name: 'Honey Pure Natural', basePrice: 85000, rating: 4.6, reviews: 456, image: 'honey1.jpg' },
                { name: 'Olive Oil Extra Virgin', basePrice: 120000, rating: 4.8, reviews: 123, image: 'oil1.jpg' },
                { name: 'Pasta Spaghetti Premium', basePrice: 25000, rating: 4.4, reviews: 234, image: 'pasta1.jpg' },
                { name: 'Granola Mix Fruits', basePrice: 55000, rating: 4.5, reviews: 167, image: 'granola1.jpg' },
                { name: 'Almond Roasted Salt', basePrice: 95000, rating: 4.7, reviews: 89, image: 'almond1.jpg' },
                { name: 'Green Tea Matcha Powder', basePrice: 150000, rating: 4.8, reviews: 67, image: 'matcha1.jpg' }
            ],
            kesehatan: [
                { name: 'Vitamin D3 High Potency', basePrice: 180000, rating: 4.7, reviews: 567, image: 'vitamin1.jpg' },
                { name: 'Face Mask Collagen Gold', basePrice: 45000, rating: 4.5, reviews: 234, image: 'masker1.jpg' },
                { name: 'Shampoo Keratin Repair', basePrice: 85000, rating: 4.6, reviews: 789, image: 'shampoo1.jpg' },
                { name: 'Serum Vitamin C Brightening', basePrice: 220000, rating: 4.8, reviews: 123, image: 'serum1.jpg' },
                { name: 'Body Wash Antibacterial', basePrice: 35000, rating: 4.3, reviews: 567, image: 'sabun1.jpg' },
                { name: 'Moisturizer Hyaluronic Acid', basePrice: 125000, rating: 4.7, reviews: 345, image: 'pelembab1.jpg' },
                { name: 'Sunscreen SPF 50+ PA+++', basePrice: 95000, rating: 4.6, reviews: 456, image: 'sunscreen1.jpg' },
                { name: 'Lip Balm Natural Organic', basePrice: 25000, rating: 4.4, reviews: 289, image: 'lipbalm1.jpg' },
                { name: 'Hair Oil Argan Premium', basePrice: 75000, rating: 4.5, reviews: 178, image: 'hairoil1.jpg' },
                { name: 'Face Toner Rose Water', basePrice: 65000, rating: 4.7, reviews: 234, image: 'toner1.jpg' },
                { name: 'Omega 3 Fish Oil', basePrice: 150000, rating: 4.8, reviews: 123, image: 'omega1.jpg' },
                { name: 'Probiotics Immune Support', basePrice: 200000, rating: 4.6, reviews: 89, image: 'probiotics1.jpg' }
            ],
            buku: [
                { name: 'Novel Bestseller Romance', basePrice: 95000, rating: 4.6, reviews: 567, image: 'novel1.jpg' },
                { name: 'Self Help Productivity', basePrice: 110000, rating: 4.7, reviews: 234, image: 'selfhelp1.jpg' },
                { name: 'Manga Attack on Titan Vol.34', basePrice: 55000, rating: 4.8, reviews: 890, image: 'manga1.jpg' },
                { name: 'Encyclopedia Science Kids', basePrice: 180000, rating: 4.5, reviews: 123, image: 'ensiklopedia1.jpg' },
                { name: 'Cookbook Asian Cuisine', basePrice: 85000, rating: 4.4, reviews: 345, image: 'cookbook1.jpg' },
                { name: 'English Dictionary Advanced', basePrice: 150000, rating: 4.3, reviews: 234, image: 'dictionary1.jpg' },
                { name: 'Programming Python Mastery', basePrice: 250000, rating: 4.8, reviews: 156, image: 'programming1.jpg' },
                { name: 'Art Design Fundamentals', basePrice: 195000, rating: 4.6, reviews: 89, image: 'art1.jpg' },
                { name: 'Financial Investment Guide', basePrice: 135000, rating: 4.7, reviews: 267, image: 'finance1.jpg' },
                { name: 'Health Nutrition Complete', basePrice: 120000, rating: 4.5, reviews: 178, image: 'health1.jpg' },
                { name: 'Travel Guide Southeast Asia', basePrice: 165000, rating: 4.6, reviews: 145, image: 'travel1.jpg' },
                { name: 'Photography Digital Techniques', basePrice: 175000, rating: 4.8, reviews: 98, image: 'photo1.jpg' }
            ],
            olahraga: [
                { name: 'Sepatu Running Nike Air', basePrice: 1200000, rating: 4.7, reviews: 456, image: 'shoes1.jpg' },
                { name: 'Raket Badminton Yonex', basePrice: 850000, rating: 4.8, reviews: 234, image: 'raket1.jpg' },
                { name: 'Bola Sepak FIFA Quality', basePrice: 350000, rating: 4.5, reviews: 567, image: 'ball1.jpg' },
                { name: 'Yoga Mat Anti Slip Premium', basePrice: 180000, rating: 4.6, reviews: 789, image: 'yogamat1.jpg' },
                { name: 'Dumbell Set 20kg', basePrice: 450000, rating: 4.4, reviews: 123, image: 'dumbell1.jpg' },
                { name: 'Jersey Futsal Dry Fit', basePrice: 125000, rating: 4.3, reviews: 345, image: 'jersey1.jpg' },
                { name: 'Tas Gym Waterproof', basePrice: 220000, rating: 4.6, reviews: 178, image: 'gymbackpack1.jpg' },
                { name: 'Resistance Band Set', basePrice: 95000, rating: 4.5, reviews: 267, image: 'resistanceband1.jpg' },
                { name: 'Protein Whey Isolate', basePrice: 650000, rating: 4.8, reviews: 89, image: 'protein1.jpg' },
                { name: 'Smart Fitness Tracker', basePrice: 850000, rating: 4.7, reviews: 156, image: 'tracker1.jpg' },
                { name: 'Boxing Gloves Leather', basePrice: 320000, rating: 4.6, reviews: 98, image: 'gloves1.jpg' },
                { name: 'Treadmill Home Compact', basePrice: 8500000, rating: 4.5, reviews: 45, image: 'treadmill1.jpg' }
            ],
            otomotif: [
                { name: 'Ban Mobil Bridgestone 185/65R15', basePrice: 850000, rating: 4.6, reviews: 234, image: 'tire1.jpg' },
                { name: 'Oli Mesin Castrol 5W-30', basePrice: 125000, rating: 4.8, reviews: 567, image: 'oil1.jpg' },
                { name: 'Battery Aki GS Astra 65Ah', basePrice: 650000, rating: 4.5, reviews: 123, image: 'battery1.jpg' },
                { name: 'Velg Racing Ring 16', basePrice: 2500000, rating: 4.7, reviews: 89, image: 'velg1.jpg' },
                { name: 'Car Shampoo Premium', basePrice: 45000, rating: 4.4, reviews: 345, image: 'shampoo1.jpg' },
                { name: 'Wiper Blade Bosch 22 Inch', basePrice: 120000, rating: 4.6, reviews: 178, image: 'wiper1.jpg' },
                { name: 'Dashcam Full HD 1080p', basePrice: 850000, rating: 4.7, reviews: 156, image: 'dashcam1.jpg' },
                { name: 'Car Air Freshener Organic', basePrice: 25000, rating: 4.3, reviews: 456, image: 'freshener1.jpg' },
                { name: 'Toolkit Set Lengkap 50pcs', basePrice: 350000, rating: 4.8, reviews: 67, image: 'toolkit1.jpg' },
                { name: 'Cover Mobil Waterproof', basePrice: 180000, rating: 4.5, reviews: 234, image: 'cover1.jpg' },
                { name: 'GPS Navigator Touch Screen', basePrice: 1200000, rating: 4.6, reviews: 98, image: 'gps1.jpg' },
                { name: 'Car Charger USB Fast Charging', basePrice: 85000, rating: 4.4, reviews: 289, image: 'charger1.jpg' }
            ],
            perawatan: [
                { name: 'Vacuum Cleaner Cordless', basePrice: 1800000, rating: 4.7, reviews: 234, image: 'vacuum1.jpg' },
                { name: 'Steam Iron Philips', basePrice: 450000, rating: 4.6, reviews: 567, image: 'iron1.jpg' },
                { name: 'Air Purifier HEPA Filter', basePrice: 2200000, rating: 4.8, reviews: 89, image: 'purifier1.jpg' },
                { name: 'Washing Machine 8kg Top Load', basePrice: 3500000, rating: 4.5, reviews: 123, image: 'washer1.jpg' },
                { name: 'Microwave Oven 25L', basePrice: 1200000, rating: 4.4, reviews: 178, image: 'microwave1.jpg' },
                { name: 'Blender Smoothie 1.5L', basePrice: 350000, rating: 4.6, reviews: 345, image: 'blender1.jpg' },
                { name: 'Hair Dryer Professional', basePrice: 280000, rating: 4.7, reviews: 156, image: 'hairdryer1.jpg' },
                { name: 'Rice Cooker Digital 1.8L', basePrice: 650000, rating: 4.8, reviews: 267, image: 'ricecooker1.jpg' },
                { name: 'Electric Kettle Stainless', basePrice: 180000, rating: 4.5, reviews: 234, image: 'kettle1.jpg' },
                { name: 'Food Processor Multi Function', basePrice: 850000, rating: 4.6, reviews: 98, image: 'processor1.jpg' },
                { name: 'Air Fryer Oil Free 4L', basePrice: 950000, rating: 4.7, reviews: 189, image: 'airfryer1.jpg' },
                { name: 'Juice Extractor Slow Press', basePrice: 1150000, rating: 4.8, reviews: 67, image: 'juicer1.jpg' }
            ],
            rumah: [
                { name: 'Sofa L-Shape Modern Minimalis', basePrice: 4500000, rating: 4.6, reviews: 89, image: 'sofa1.jpg' },
                { name: 'Meja Makan Kayu Jati 6 Kursi', basePrice: 3200000, rating: 4.7, reviews: 56, image: 'table1.jpg' },
                { name: 'Lemari Pakaian 3 Pintu', basePrice: 2800000, rating: 4.5, reviews: 123, image: 'wardrobe1.jpg' },
                { name: 'Kasur Spring Bed Queen Size', basePrice: 3500000, rating: 4.8, reviews: 167, image: 'bed1.jpg' },
                { name: 'Karpet Ruang Tamu 200x300cm', basePrice: 850000, rating: 4.4, reviews: 234, image: 'carpet1.jpg' },
                { name: 'Lampu Gantung Crystal Modern', basePrice: 650000, rating: 4.6, reviews: 145, image: 'lamp1.jpg' },
                { name: 'Rak Buku Minimalis 5 Tingkat', basePrice: 450000, rating: 4.5, reviews: 178, image: 'bookshelf1.jpg' },
                { name: 'Cermin Hias Dinding Bulat', basePrice: 280000, rating: 4.3, reviews: 98, image: 'mirror1.jpg' },
                { name: 'Gorden Blackout Anti UV', basePrice: 320000, rating: 4.7, reviews: 234, image: 'curtain1.jpg' },
                { name: 'Vas Bunga Keramik Antik', basePrice: 125000, rating: 4.4, reviews: 156, image: 'vase1.jpg' },
                { name: 'Bantal Sofa Set 4pcs', basePrice: 180000, rating: 4.6, reviews: 267, image: 'pillow1.jpg' },
                { name: 'Jam Dinding Vintage Classic', basePrice: 95000, rating: 4.5, reviews: 189, image: 'clock1.jpg' }
            ]
        };
        
        return templates[category] || templates.fashion;
    }
    
    updateProductCard(template, productData, itemIndex) {
        // Update product title
        const productTitle = template.querySelector('.product-title');
        if (productTitle) {
            productTitle.textContent = productData.name;
        }
        
        // Update product price
        const productPrice = template.querySelector('.current-price');
        if (productPrice) {
            productPrice.textContent = productData.price;
        }
        
        // Update original price and discount
        const originalPrice = template.querySelector('.original-price');
        const discountBadge = template.querySelector('.discount-badge');
        
        if (productData.originalPrice && originalPrice) {
            originalPrice.textContent = productData.originalPrice;
            originalPrice.style.display = 'inline';
        } else if (originalPrice) {
            originalPrice.style.display = 'none';
        }
        
        if (productData.discount && discountBadge) {
            discountBadge.textContent = `-${productData.discount}`;
            discountBadge.style.display = 'block';
        } else if (discountBadge) {
            discountBadge.style.display = 'none';
        }
        
        // Update rating
        const ratingStars = template.querySelectorAll('.stars i');
        const rating = Math.round(productData.rating);
        ratingStars.forEach((star, index) => {
            if (index < rating) {
                star.className = 'fas fa-star';
            } else {
                star.className = 'fas fa-star text-muted';
            }
        });
        
        // Update review count
        const reviewCount = template.querySelector('.review-count');
        if (reviewCount) {
            reviewCount.textContent = `(${productData.reviews})`;
        }
        
        // Add clear page indicator
        const pageIndicator = document.createElement('div');
        pageIndicator.className = 'page-indicator';
        pageIndicator.style.cssText = `
            position: absolute;
            top: 8px;
            left: 8px;
            background: linear-gradient(135deg, var(--elegant-primary) 0%, var(--elegant-secondary) 100%);
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: bold;
            z-index: 10;
            box-shadow: 0 2px 8px rgba(242, 107, 55, 0.3);
            border: 2px solid white;
        `;
        pageIndicator.textContent = `Halaman ${productData.page}`;
        
        const productImageContainer = template.querySelector('.product-image');
        if (productImageContainer) {
            productImageContainer.style.position = 'relative';
            
            // Remove old page indicator if exists
            const oldIndicator = productImageContainer.querySelector('.page-indicator');
            if (oldIndicator) {
                oldIndicator.remove();
            }
            
            productImageContainer.appendChild(pageIndicator);
        }
        
        // Add item number badge
        const itemBadge = document.createElement('div');
        itemBadge.className = 'item-badge';
        itemBadge.style.cssText = `
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: bold;
            z-index: 10;
        `;
        itemBadge.textContent = `#${itemIndex}`;
        
        if (productImageContainer) {
            productImageContainer.appendChild(itemBadge);
        }
    }
}

// Global pagination functions for backward compatibility
let paginationManager;

function changePage(page) {
    if (paginationManager) {
        paginationManager.changePage(page);
    }
}

// Initialize pagination when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Check if we're on a category page with pagination
    const paginationElement = document.getElementById('pagination');
    if (paginationElement) {
        // Initialize pagination manager
        paginationManager = new PaginationManager({
            totalPages: 20,
            itemsPerPage: 12,
            totalItems: 234
        });
        
        // Listen for page change events
        document.addEventListener('pageChanged', function(event) {
            console.log('Page changed to:', event.detail.currentPage);
            // Here you can add additional logic when page changes
        });
    }
});

// Export for use in modules if needed
if (typeof module !== 'undefined' && module.exports) {
    module.exports = PaginationManager;
}
