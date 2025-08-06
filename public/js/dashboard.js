// Dashboard JavaScript
document.addEventListener("DOMContentLoaded", function () {
    // Initialize components
    initPromoModal();
    initCountdown();
    initCopyCode();
    initAddToCart();
    initNewsletter();
    initSearch();
});

// Show promo modal on page load
function initPromoModal() {
    const promoModal = new bootstrap.Modal(
        document.getElementById("promoModal")
    );

    // Show modal after 1 second delay
    setTimeout(() => {
        promoModal.show();
    }, 1000);
}

// Countdown timer for flash sale
function initCountdown() {
    const timerElement = document.getElementById("timer");
    if (!timerElement) return;

    // Set countdown to 24 hours from now
    const countdownDate = new Date().getTime() + 24 * 60 * 60 * 1000;

    const countdown = setInterval(() => {
        const now = new Date().getTime();
        const distance = countdownDate - now;

        if (distance < 0) {
            clearInterval(countdown);
            timerElement.innerHTML = "EXPIRED";
            return;
        }

        const hours = Math.floor(
            (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        );
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        timerElement.innerHTML =
            String(hours).padStart(2, "0") +
            ":" +
            String(minutes).padStart(2, "0") +
            ":" +
            String(seconds).padStart(2, "0");
    }, 1000);
}

// Copy voucher code functionality
function initCopyCode() {
    const copyButtons = document.querySelectorAll(".copy-code");

    copyButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const code = this.getAttribute("data-code");

            // Create temporary input element to copy text
            const tempInput = document.createElement("input");
            tempInput.value = code;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            // Show feedback
            const originalIcon = this.innerHTML;
            this.innerHTML = '<i class="fas fa-check"></i>';
            this.classList.add("btn-success");
            this.classList.remove("btn-outline-primary");

            setTimeout(() => {
                this.innerHTML = originalIcon;
                this.classList.remove("btn-success");
                this.classList.add("btn-outline-primary");
            }, 2000);

            // Show toast notification
            showToast("Kode voucher berhasil disalin!", "success");
        });
    });
}

// Add to cart functionality with login check
function initAddToCart() {
    const addToCartButtons = document.querySelectorAll(".btn-add-cart");

    addToCartButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-product-id");
            const originalText = this.innerHTML;

            // Show loading state
            this.innerHTML =
                '<i class="fas fa-spinner fa-spin me-2"></i>Menambahkan...';
            this.disabled = true;

            // Make AJAX request
            fetch("/add-to-cart", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        showToast(data.message, "success");
                        updateCartBadge();
                    } else {
                        if (data.redirect) {
                            // Show login required modal
                            showLoginModal(data.message, data.redirect);
                        } else {
                            showToast(data.message, "error");
                        }
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    showToast("Terjadi kesalahan. Silakan coba lagi.", "error");
                })
                .finally(() => {
                    // Restore button state
                    this.innerHTML = originalText;
                    this.disabled = false;
                });
        });
    });
}

// Newsletter subscription
function initNewsletter() {
    const newsletterForm = document.querySelector(".newsletter-form");

    if (newsletterForm) {
        newsletterForm.addEventListener("submit", function (e) {
            e.preventDefault();

            const emailInput = this.querySelector('input[type="email"]');
            const email = emailInput.value;
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;

            if (!email || !validateEmail(email)) {
                showToast("Silakan masukkan email yang valid.", "error");
                return;
            }

            // Show loading state
            submitBtn.innerHTML =
                '<i class="fas fa-spinner fa-spin me-2"></i>Berlangganan...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                showToast(
                    "Terima kasih! Anda telah berlangganan newsletter kami.",
                    "success"
                );
                emailInput.value = "";
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });
    }
}

// Search functionality
function initSearch() {
    const searchInput = document.querySelector(".search-input");
    const searchBtn = document.querySelector(".search-btn");

    if (searchInput && searchBtn) {
        // Search on button click
        searchBtn.addEventListener("click", function () {
            performSearch(searchInput.value);
        });

        // Search on Enter key press
        searchInput.addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                performSearch(this.value);
            }
        });
    }
}

// Perform search
function performSearch(query) {
    if (!query.trim()) {
        showToast("Silakan masukkan kata kunci pencarian.", "error");
        return;
    }

    // For now, just show a toast. In real app, redirect to search results
    showToast(`Mencari: "${query}"`, "info");
    console.log("Searching for:", query);
}

// Show login required modal
function showLoginModal(message, redirectUrl) {
    const modalHtml = `
        <div class="modal fade" id="loginRequiredModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Login Diperlukan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-lock fa-3x text-primary mb-3"></i>
                        <p>${message}</p>
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="${redirectUrl}" class="btn btn-primary">Login Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    `;

    // Remove existing modal if any
    const existingModal = document.getElementById("loginRequiredModal");
    if (existingModal) {
        existingModal.remove();
    }

    // Add modal to body
    document.body.insertAdjacentHTML("beforeend", modalHtml);

    // Show modal
    const modal = new bootstrap.Modal(
        document.getElementById("loginRequiredModal")
    );
    modal.show();

    // Clean up on hide
    document
        .getElementById("loginRequiredModal")
        .addEventListener("hidden.bs.modal", function () {
            this.remove();
        });
}

// Update cart badge count
function updateCartBadge() {
    const cartBadge = document.querySelector(".cart-badge");
    if (cartBadge) {
        let currentCount = parseInt(cartBadge.textContent) || 0;
        cartBadge.textContent = currentCount + 1;

        // Add animation
        cartBadge.style.transform = "scale(1.3)";
        setTimeout(() => {
            cartBadge.style.transform = "scale(1)";
        }, 200);
    }
}

// Show toast notification
function showToast(message, type = "info") {
    // Remove existing toast if any
    const existingToast = document.querySelector(".custom-toast");
    if (existingToast) {
        existingToast.remove();
    }

    const toastTypes = {
        success: { icon: "fas fa-check-circle", color: "#28a745" },
        error: { icon: "fas fa-exclamation-circle", color: "#dc3545" },
        info: { icon: "fas fa-info-circle", color: "#17a2b8" },
        warning: { icon: "fas fa-exclamation-triangle", color: "#ffc107" },
    };

    const toastConfig = toastTypes[type] || toastTypes.info;

    const toastHtml = `
        <div class="custom-toast" style="
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border-left: 4px solid ${toastConfig.color};
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            z-index: 9999;
            max-width: 350px;
            animation: slideInRight 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        ">
            <i class="${toastConfig.icon}" style="color: ${toastConfig.color}; font-size: 1.2em;"></i>
            <span style="flex: 1; color: #2c3e50; font-weight: 500;">${message}</span>
            <button onclick="this.parentElement.remove()" style="
                background: none;
                border: none;
                color: #999;
                cursor: pointer;
                font-size: 1.2em;
                padding: 0;
                margin-left: 10px;
            ">×</button>
        </div>
    `;

    // Add CSS animation if not exists
    if (!document.querySelector("#toast-animations")) {
        const style = document.createElement("style");
        style.id = "toast-animations";
        style.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    }

    document.body.insertAdjacentHTML("beforeend", toastHtml);

    // Auto remove after 5 seconds
    setTimeout(() => {
        const toast = document.querySelector(".custom-toast");
        if (toast) {
            toast.style.animation = "slideOutRight 0.3s ease";
            setTimeout(() => {
                toast.remove();
            }, 300);
        }
    }, 5000);
}

// Email validation helper
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Smooth scroll to sections
function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({
            behavior: "smooth",
            block: "start",
        });
    }
}

// Initialize tooltips and popovers if Bootstrap is available
if (typeof bootstrap !== "undefined") {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Initialize popovers
    const popoverTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="popover"]')
    );
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });
}

// Category card click handlers
document.addEventListener("click", function (e) {
    if (e.target.closest(".category-card")) {
        const categoryName = e.target
            .closest(".category-card")
            .querySelector(".category-name").textContent;
        showToast(`Navigasi ke kategori: ${categoryName}`, "info");
    }
});

// Product wishlist toggle
document.addEventListener("click", function (e) {
    if (e.target.closest(".product-actions .fa-heart")) {
        const heartIcon = e.target.closest(".fa-heart");
        if (heartIcon.classList.contains("far")) {
            heartIcon.classList.remove("far");
            heartIcon.classList.add("fas");
            heartIcon.style.color = "#e74c3c";
            showToast("Produk ditambahkan ke wishlist", "success");
        } else {
            heartIcon.classList.remove("fas");
            heartIcon.classList.add("far");
            heartIcon.style.color = "";
            showToast("Produk dihapus dari wishlist", "info");
        }
    }
});

// Voucher claim handlers
document.addEventListener("click", function (e) {
    if (e.target.closest(".btn-warning")) {
        const button = e.target.closest(".btn-warning");
        if (button.textContent.includes("Claim")) {
            const originalText = button.textContent;
            button.textContent = "Claiming...";
            button.disabled = true;

            setTimeout(() => {
                button.textContent = "Claimed!";
                button.classList.remove("btn-warning");
                button.classList.add("btn-success");
                showToast("Voucher berhasil diklaim!", "success");
            }, 1500);
        }
    }
});

// Lazy loading for images
if ("IntersectionObserver" in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const img = entry.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute("data-src");
                    imageObserver.unobserve(img);
                }
            }
        });
    });

    document.querySelectorAll("img[data-src]").forEach((img) => {
        imageObserver.observe(img);
    });
}
