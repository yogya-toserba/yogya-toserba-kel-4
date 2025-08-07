// Minimal Dashboard JavaScript
document.addEventListener("DOMContentLoaded", function () {
    // Initialize essential components only
    initPromoModal();
    initCountdown();
    initCopyCode();
});

// Show promo modal on page load
function initPromoModal() {
    const promoModal = document.getElementById("promoModal");
    if (promoModal) {
        const modal = new bootstrap.Modal(promoModal);

        // Show modal after 1 second delay
        setTimeout(() => {
            modal.show();
        }, 1000);
    }
}

// Simple countdown timer
function initCountdown() {
    const hoursElement = document.getElementById("hours");
    const minutesElement = document.getElementById("minutes");
    const secondsElement = document.getElementById("seconds");

    if (!hoursElement) return;

    // Set countdown to 24 hours from now
    const countdownDate = new Date().getTime() + 24 * 60 * 60 * 1000;

    const countdown = setInterval(() => {
        const now = new Date().getTime();
        const distance = countdownDate - now;

        if (distance < 0) {
            clearInterval(countdown);
            hoursElement.innerHTML = "00";
            minutesElement.innerHTML = "00";
            secondsElement.innerHTML = "00";
            return;
        }

        const hours = Math.floor(
            (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        );
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        hoursElement.innerHTML = String(hours).padStart(2, "0");
        minutesElement.innerHTML = String(minutes).padStart(2, "0");
        secondsElement.innerHTML = String(seconds).padStart(2, "0");
    }, 1000);
}

// Simple copy code functionality
function initCopyCode() {
    const copyButtons = document.querySelectorAll(".copy-btn");
    copyButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const code = this.getAttribute("data-code");

            if (navigator.clipboard) {
                navigator.clipboard.writeText(code).then(() => {
                    // Simple visual feedback
                    this.style.color = "#28a745";
                    setTimeout(() => {
                        this.style.color = "";
                    }, 1000);
                });
            }
        });
    });
}
