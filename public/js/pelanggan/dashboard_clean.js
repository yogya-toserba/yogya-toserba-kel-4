// Dashboard Pelanggan JavaScript - Clean Version
document.addEventListener("DOMContentLoaded", function () {
    // Initialize all components
    initSlider();
    initCountdown();
    initSearch();
    initUserMenu();
    initMobileMenu();
    initProductActions();
    initScrollEffects();

    // Show welcome modal if exists
    const welcomeModal = document.getElementById("welcomeModal");
    if (welcomeModal) {
        setTimeout(() => {
            welcomeModal.style.display = "flex";
        }, 1000);
    }
});

// Ultra Smooth Auto Slider with Real Floating Icons Animation
function initSlider() {
    const slides = document.querySelectorAll(".slide");
    const dots = document.querySelectorAll(".dot");
    let currentSlide = 0;
    let slideInterval;
    let isTransitioning = false;

    // Initialize floating icons animation immediately
    initFloatingIconsAnimation();

    function showSlide(index) {
        if (isTransitioning) return;
        isTransitioning = true;

        console.log(`🎬 Ultra smooth transition to slide ${index + 1}`);

        // Get current and next slide for ultra smooth transition
        const currentSlideEl = slides[currentSlide];
        const nextSlideEl = slides[index];

        // Step 1: Prepare next slide (off-screen)
        nextSlideEl.style.opacity = "0";
        nextSlideEl.style.visibility = "visible";
        nextSlideEl.style.transform = "translateX(100%) scale(0.9)";
        nextSlideEl.style.filter = "blur(8px)";
        nextSlideEl.style.transition = "none";
        nextSlideEl.classList.add("active");

        // Force reflow for smooth animation
        nextSlideEl.offsetHeight;

        // Step 2: Animate current slide out (ultra smooth)
        if (currentSlideEl && currentSlideEl !== nextSlideEl) {
            currentSlideEl.style.transition =
                "all 2.8s cubic-bezier(0.16, 1, 0.3, 1)";
            currentSlideEl.style.transform = "translateX(-100%) scale(0.8)";
            currentSlideEl.style.opacity = "0";
            currentSlideEl.style.filter = "blur(12px)";
        }

        // Step 3: Animate next slide in (water-like flow)
        setTimeout(() => {
            nextSlideEl.style.transition =
                "all 2.8s cubic-bezier(0.16, 1, 0.3, 1)";
            nextSlideEl.style.transform = "translateX(0) scale(1)";
            nextSlideEl.style.opacity = "1";
            nextSlideEl.style.filter = "blur(0px)";
        }, 100);

        // Step 4: Clean up previous slides
        slides.forEach((slide, i) => {
            if (i !== index) {
                setTimeout(() => {
                    slide.classList.remove("active");
                    slide.style.visibility = "hidden";
                }, 1000);
            }
        });

        // Step 5: Update dots with smooth animation
        dots.forEach((dot, i) => {
            dot.classList.remove("active");
            if (i === index) {
                dot.classList.add("active");
                // Dot bounce effect
                dot.style.transform = "scale(1.3)";
                setTimeout(() => {
                    dot.style.transform = "scale(1)";
                }, 300);
            }
        });

        // Step 6: Reset transition lock after animation completes
        setTimeout(() => {
            isTransitioning = false;
        }, 3000);
    }

    // Perfect infinite loop: 1→2→3→1 (no reverse)
    function nextSlide() {
        const prevSlide = currentSlide;
        currentSlide = (currentSlide + 1) % slides.length;
        console.log(
            `🔄 Auto advancing: ${prevSlide + 1} → ${currentSlide + 1}`
        );
        showSlide(currentSlide);
    }

    // Ultra smooth auto-play (slower for elegant feel)
    function startAutoPlay() {
        slideInterval = setInterval(() => {
            if (!isTransitioning) {
                nextSlide();
            }
        }, 6000); // 6 seconds for relaxed viewing
    }

    function stopAutoPlay() {
        clearInterval(slideInterval);
    }

    // Dot navigation with enhanced feedback and debugging
    console.log(`🎯 Setting up ${dots.length} navigation dots`);
    dots.forEach((dot, index) => {
        console.log(`🔘 Configuring dot ${index + 1}`);
        dot.addEventListener("click", (e) => {
            e.preventDefault();
            console.log(
                `✨ Dot ${index + 1} clicked! Current: ${currentSlide + 1}`
            );

            if (isTransitioning) {
                console.log("⏳ Transition in progress, ignoring click");
                return;
            }

            if (currentSlide === index) {
                console.log("📍 Already on this slide");
                return;
            }

            stopAutoPlay();
            currentSlide = index;
            console.log(`🎬 Switching to slide ${currentSlide + 1}`);
            showSlide(currentSlide);

            // Visual feedback for dot click
            dot.style.transform = "scale(1.6)";
            dot.style.backgroundColor = "#ff6b35";
            setTimeout(() => {
                dot.style.transform = "scale(1.4)";
            }, 200);

            // Restart autoplay after user interaction
            setTimeout(() => {
                console.log("🔄 Restarting autoplay");
                startAutoPlay();
            }, 4000);
        });

        // Add hover effects
        dot.addEventListener("mouseenter", () => {
            if (!dot.classList.contains("active")) {
                dot.style.transform = "scale(1.2)";
                dot.style.backgroundColor = "#ff6b35";
            }
        });

        dot.addEventListener("mouseleave", () => {
            if (!dot.classList.contains("active")) {
                dot.style.transform = "scale(1)";
                dot.style.backgroundColor = "";
            }
        });
    });

    // Enhanced hover interactions
    const sliderContainer = document.querySelector(".hero-slider");
    if (sliderContainer) {
        sliderContainer.addEventListener("mouseenter", () => {
            stopAutoPlay();
        });

        sliderContainer.addEventListener("mouseleave", () => {
            startAutoPlay();
        });
    }

    // Initialize first slide and start autoplay
    if (slides.length > 0) {
        showSlide(0);
        startAutoPlay();
    }
}

// CRITICAL: Initialize Floating Icons Animation
function initFloatingIconsAnimation() {
    console.log("🎯 Initializing floating icons animation...");

    const floatingContainers = document.querySelectorAll(".floating-icons");

    floatingContainers.forEach((container) => {
        const icons = container.querySelectorAll("i");

        icons.forEach((icon, index) => {
            // Force visible and animated state
            icon.style.opacity = "1";
            icon.style.visibility = "visible";
            icon.style.pointerEvents = "none";
            icon.style.zIndex = "15";

            // Apply dynamic animation with different timing
            const baseDelay = index * 0.5;
            const animationDuration = 6 + index * 0.5; // 6s, 6.5s, 7s, 7.5s, 8s, 8.5s

            icon.style.animation = `floatAround ${animationDuration}s ease-in-out infinite ${baseDelay}s, sparkle ${
                2 + index * 0.3
            }s ease-in-out infinite ${baseDelay}s`;

            // Add extra movement for better visibility
            icon.style.transform = `translate3d(0, 0, 0) scale(1)`;
            icon.style.willChange = "transform, opacity";

            console.log(
                `✨ Icon ${
                    index + 1
                } animated with ${animationDuration}s duration`
            );
        });
    });

    console.log("🎉 Floating icons animation initialized!");
}

// Countdown Timer
function initCountdown() {
    const hoursEl = document.getElementById("hours");
    const minutesEl = document.getElementById("minutes");
    const secondsEl = document.getElementById("seconds");

    function updateCountdown() {
        // Set target time (for demo, just counting down from current time + 12 hours)
        const now = new Date().getTime();
        const target = now + 12 * 60 * 60 * 1000 + 34 * 60 * 1000 + 56 * 1000;
        const difference = target - new Date().getTime();

        if (difference > 0) {
            const hours = Math.floor(
                (difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
            );
            const minutes = Math.floor(
                (difference % (1000 * 60 * 60)) / (1000 * 60)
            );
            const seconds = Math.floor((difference % (1000 * 60)) / 1000);

            if (hoursEl)
                hoursEl.textContent = hours.toString().padStart(2, "0");
            if (minutesEl)
                minutesEl.textContent = minutes.toString().padStart(2, "0");
            if (secondsEl)
                secondsEl.textContent = seconds.toString().padStart(2, "0");
        }
    }

    // Update every second
    setInterval(updateCountdown, 1000);
    updateCountdown(); // Initial call
}

// Search Functionality
function initSearch() {
    const searchInput = document.querySelector(".search-input");
    const searchSuggestions = document.querySelector(".search-suggestions");
    const suggestionItems = document.querySelectorAll(".suggestion-item");

    if (searchInput && searchSuggestions) {
        searchInput.addEventListener("focus", () => {
            searchSuggestions.style.display = "block";
        });

        searchInput.addEventListener("blur", () => {
            // Delay hiding to allow clicking on suggestions
            setTimeout(() => {
                searchSuggestions.style.display = "none";
            }, 200);
        });

        searchInput.addEventListener("input", (e) => {
            const query = e.target.value.toLowerCase();
            suggestionItems.forEach((item) => {
                const text = item.textContent.toLowerCase();
                if (text.includes(query)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        });

        // Click on suggestion
        suggestionItems.forEach((item) => {
            item.addEventListener("click", () => {
                searchInput.value = item.textContent;
                searchSuggestions.style.display = "none";
                // Trigger search
                performSearch(item.textContent);
            });
        });
    }
}

// User Menu Dropdown
function initUserMenu() {
    // Handle old user dropdown if exists
    const userInfo = document.querySelector(".user-info");
    const dropdownMenu = document.querySelector(".dropdown-menu");

    if (userInfo && dropdownMenu) {
        userInfo.addEventListener("click", (e) => {
            e.stopPropagation();
            dropdownMenu.style.display =
                dropdownMenu.style.display === "block" ? "none" : "block";
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", () => {
            dropdownMenu.style.display = "none";
        });

        dropdownMenu.addEventListener("click", (e) => {
            e.stopPropagation();
        });
    }

    // Handle new profile dropdown
    const profileDropdown = document.querySelector(".user-profile-dropdown");
    const profileTrigger = document.querySelector(".profile-trigger");
    const profileMenu = document.querySelector(".profile-dropdown-menu");

    if (profileDropdown && profileTrigger && profileMenu) {
        profileTrigger.addEventListener("click", (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle("active");
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", (e) => {
            if (!profileDropdown.contains(e.target)) {
                profileDropdown.classList.remove("active");
            }
        });

        // Prevent dropdown from closing when clicking inside
        profileMenu.addEventListener("click", (e) => {
            e.stopPropagation();
        });

        // Close dropdown when clicking on dropdown items (except logout)
        const dropdownItems = profileMenu.querySelectorAll(
            ".dropdown-item:not(.logout-item)"
        );
        dropdownItems.forEach((item) => {
            item.addEventListener("click", () => {
                profileDropdown.classList.remove("active");
            });
        });
    }

    // Add notification click handlers
    const notificationIcon = document.querySelector(".notifications-icon");
    if (notificationIcon) {
        notificationIcon.addEventListener("click", () => {
            // Handle notification click
            console.log("Notifications clicked");
            // You can add notification dropdown logic here
        });
    }

    // Add cart click handlers
    const cartIcon = document.querySelector(".cart-icon");
    if (cartIcon) {
        cartIcon.addEventListener("click", () => {
            // Handle cart click
            console.log("Cart clicked");
            // You can add cart dropdown or redirect logic here
        });
    }
}

// Mobile Menu
function initMobileMenu() {
    const mobileToggle = document.querySelector(".mobile-menu-toggle");
    const quickNav = document.querySelector(".quick-nav");

    if (mobileToggle && quickNav) {
        mobileToggle.addEventListener("click", () => {
            quickNav.classList.toggle("mobile-open");
            mobileToggle.classList.toggle("active");
        });
    }
}

// Product Actions
function initProductActions() {
    // Wishlist buttons
    const wishlistBtns = document.querySelectorAll(".wishlist-btn");
    wishlistBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            e.stopPropagation();
            btn.classList.toggle("active");
            const icon = btn.querySelector("i");
            if (btn.classList.contains("active")) {
                icon.classList.remove("far");
                icon.classList.add("fas");
                showNotification("Ditambahkan ke wishlist!", "success");
            } else {
                icon.classList.remove("fas");
                icon.classList.add("far");
                showNotification("Dihapus dari wishlist!", "info");
            }
        });
    });

    // Quick view buttons
    const quickViewBtns = document.querySelectorAll(".quick-view-btn");
    quickViewBtns.forEach((btn) => {
        btn.addEventListener("click", (e) => {
            e.stopPropagation();
            const productCard = btn.closest(".product-card");
            const productId = productCard.dataset.productId;
            openQuickView(productId);
        });
    });

    // Newsletter form
    const subscribeForm = document.querySelector(".subscribe-form");
    if (subscribeForm) {
        subscribeForm.addEventListener("submit", (e) => {
            e.preventDefault();
            const email = subscribeForm.querySelector(
                'input[type="email"]'
            ).value;
            if (email) {
                showNotification(
                    "Terima kasih! Anda berhasil berlangganan newsletter.",
                    "success"
                );
                subscribeForm.reset();
            }
        });
    }
}

// Scroll Effects
function initScrollEffects() {
    // Smooth scroll for navigation
    const navLinks = document.querySelectorAll('.nav-item[href^="#"]');
    navLinks.forEach((link) => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const targetId = link.getAttribute("href").substring(1);
            const targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -100px 0px",
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("animate-in");
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const animateElements = document.querySelectorAll(
        ".category-card, .product-card, .promo-card"
    );
    animateElements.forEach((el) => observer.observe(el));
}

// Product Functions
function addToCart(productId) {
    showLoading();

    // Simulate API call
    setTimeout(() => {
        fetch("/add-to-cart", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN":
                    document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute("content") || "",
            },
            body: JSON.stringify({ product_id: productId }),
        })
            .then((response) => response.json())
            .then((data) => {
                hideLoading();
                if (data.status === "success") {
                    showNotification(data.message, "success");
                    updateCartCount();
                } else if (data.status === "error") {
                    if (data.redirect) {
                        showLoginModal(data.message);
                    } else {
                        showNotification(data.message, "error");
                    }
                }
            })
            .catch((error) => {
                hideLoading();
                showNotification(
                    "Terjadi kesalahan. Silakan coba lagi.",
                    "error"
                );
            });
    }, 1000);
}

function buyNow(productId) {
    // Check if user is logged in
    const isLoggedIn = document.querySelector(".user-dropdown") !== null;

    if (!isLoggedIn) {
        showLoginModal(
            "Silakan login terlebih dahulu untuk melakukan pembelian."
        );
        return;
    }

    showLoading();

    // Simulate redirect to checkout
    setTimeout(() => {
        hideLoading();
        window.location.href = `/checkout?product=${productId}&type=buy-now`;
    }, 1500);
}

function openQuickView(productId) {
    // Implementation for quick view modal
    showNotification("Quick view akan segera tersedia!", "info");
}

// Voucher Modal Functions
function closeWelcomeModal() {
    const modal = document.getElementById("welcomeModal");
    if (modal) {
        modal.style.display = "none";
    }
}

function copyVoucherCode(code) {
    navigator.clipboard
        .writeText(code)
        .then(() => {
            showNotification("Kode voucher berhasil disalin!", "success");
        })
        .catch(() => {
            // Fallback for older browsers
            const textArea = document.createElement("textarea");
            textArea.value = code;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("copy");
            document.body.removeChild(textArea);
            showNotification("Kode voucher berhasil disalin!", "success");
        });
}

function startShopping() {
    closeWelcomeModal();
    document.getElementById("categories").scrollIntoView({
        behavior: "smooth",
    });
}

// Utility Functions
function showLoading() {
    const loadingOverlay = document.getElementById("loadingOverlay");
    if (loadingOverlay) {
        loadingOverlay.style.display = "flex";
    }
}

function hideLoading() {
    const loadingOverlay = document.getElementById("loadingOverlay");
    if (loadingOverlay) {
        loadingOverlay.style.display = "none";
    }
}

function showNotification(message, type = "info") {
    // Create notification element
    const notification = document.createElement("div");
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${getNotificationIcon(type)}"></i>
            <span>${message}</span>
            <button class="notification-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;

    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 2rem;
        right: 2rem;
        background: ${getNotificationColor(type)};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        z-index: 10000;
        animation: slideInRight 0.3s ease-out;
        max-width: 400px;
        word-wrap: break-word;
    `;

    // Add to DOM
    document.body.appendChild(notification);

    // Close button functionality
    const closeBtn = notification.querySelector(".notification-close");
    closeBtn.addEventListener("click", () => {
        notification.remove();
    });

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.style.animation =
                "slideOutRight 0.3s ease-in forwards";
            setTimeout(() => notification.remove(), 300);
        }
    }, 5000);
}

function getNotificationIcon(type) {
    const icons = {
        success: "check-circle",
        error: "exclamation-circle",
        warning: "exclamation-triangle",
        info: "info-circle",
    };
    return icons[type] || "info-circle";
}

function getNotificationColor(type) {
    const colors = {
        success: "#27ae60",
        error: "#e74c3c",
        warning: "#f39c12",
        info: "#3498db",
    };
    return colors[type] || "#3498db";
}

function showLoginModal(message = "Silakan login untuk melanjutkan.") {
    const modal = document.createElement("div");
    modal.className = "modal-overlay";
    modal.innerHTML = `
        <div class="login-modal">
            <div class="modal-content">
                <button class="modal-close" onclick="this.closest('.modal-overlay').remove()">
                    <i class="fas fa-times"></i>
                </button>
                <div class="modal-icon">
                    <i class="fas fa-user-lock"></i>
                </div>
                <h2>Login Diperlukan</h2>
                <p>${message}</p>
                <div class="modal-actions">
                    <a href="/pelanggan/login" class="btn-login-modal">
                        <i class="fas fa-sign-in-alt"></i>
                        Login Sekarang
                    </a>
                    <a href="/pelanggan/register" class="btn-register-modal">
                        <i class="fas fa-user-plus"></i>
                        Daftar Akun
                    </a>
                </div>
                <p class="modal-note">Dengan memiliki akun, Anda dapat menikmati berbagai promo eksklusif dan kemudahan berbelanja.</p>
            </div>
        </div>
    `;

    // Add styles
    const style = document.createElement("style");
    style.textContent = `
        .login-modal {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            max-width: 400px;
            width: 90%;
            text-align: center;
            position: relative;
        }
        .modal-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #f26b37, #ff8c5a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 2rem;
        }
        .login-modal h2 {
            margin-bottom: 1rem;
            color: #2c3e50;
        }
        .login-modal p {
            color: #7f8c8d;
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        .modal-actions {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .btn-login-modal, .btn-register-modal {
            flex: 1;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        .btn-login-modal {
            background: linear-gradient(135deg, #f26b37, #ff8c5a);
            color: white;
        }
        .btn-register-modal {
            background: transparent;
            color: #f26b37;
            border: 2px solid #f26b37;
        }
        .btn-login-modal:hover, .btn-register-modal:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .modal-note {
            font-size: 0.8rem;
            opacity: 0.7;
        }
    `;

    document.head.appendChild(style);
    document.body.appendChild(modal);
}

function updateCartCount() {
    const cartCount = document.querySelector(".cart-count");
    if (cartCount) {
        let currentCount = parseInt(cartCount.textContent) || 0;
        cartCount.textContent = currentCount + 1;

        // Add animation
        cartCount.style.animation = "pulse 0.5s ease-in-out";
        setTimeout(() => {
            cartCount.style.animation = "";
        }, 500);
    }
}

function performSearch(query) {
    showLoading();

    // Simulate search
    setTimeout(() => {
        hideLoading();
        showNotification(`Mencari "${query}"...`, "info");
        // Here you would typically redirect to search results page
        // window.location.href = `/search?q=${encodeURIComponent(query)}`;
    }, 1000);
}

// Add notification animations to document
const notificationStyles = document.createElement("style");
notificationStyles.textContent = `
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideOutRight {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100%);
        }
    }
    
    .notification-content {
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }
    
    .notification-close {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        opacity: 0.7;
        transition: opacity 0.3s ease;
        margin-left: auto;
    }
    
    .notification-close:hover {
        opacity: 1;
    }
    
    .animate-in {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;

document.head.appendChild(notificationStyles);
