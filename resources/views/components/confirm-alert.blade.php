<!-- Alert Konfirmasi Universal -->
<div id="confirmAlert" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-mx-4 transform transition-all duration-300 scale-95 opacity-0" id="confirmModal">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                    <i id="confirmIcon" class="fas fa-question-circle text-orange-500 text-lg"></i>
                </div>
                <h3 id="confirmTitle" class="text-lg font-semibold text-gray-800">Konfirmasi Aksi</h3>
            </div>
        </div>
        
        <!-- Body -->
        <div class="px-6 py-4">
            <p id="confirmMessage" class="text-gray-600 mb-4">Apakah Anda yakin ingin melanjutkan aksi ini?</p>
            <div class="bg-orange-50 border-l-4 border-orange-400 p-3 rounded">
                <div class="flex">
                    <i class="fas fa-info-circle text-orange-500 mr-2 mt-0.5"></i>
                    <p class="text-sm text-orange-700" id="confirmDetails">Pastikan data yang Anda masukkan sudah benar sebelum melanjutkan.</p>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex justify-end space-x-3">
            <button type="button" 
                    class="px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200" 
                    onclick="hideConfirmAlert()">
                <i class="fas fa-times mr-1"></i>
                <span id="cancelText">Batalkan</span>
            </button>
            <button type="button" 
                    class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors duration-200" 
                    id="confirmButton">
                <i id="confirmButtonIcon" class="fas fa-check mr-1"></i>
                <span id="confirmButtonText">Lanjutkan</span>
            </button>
        </div>
    </div>
</div>

<!-- Alert konfirmasi dengan DaisyUI style -->
<div id="daisyConfirmAlert" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div role="alert" class="alert alert-warning max-w-md transform transition-all duration-300 scale-95 opacity-0" id="daisyModal">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-current h-6 w-6 shrink-0">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"></path>
        </svg>
        <div>
            <h3 class="font-bold" id="daisyTitle">Konfirmasi Aksi</h3>
            <div class="text-xs" id="daisyMessage">Apakah Anda yakin ingin melanjutkan?</div>
        </div>
        <div class="flex space-x-2">
            <button class="btn btn-sm btn-ghost" onclick="hideDaisyConfirmAlert()">
                <span id="daisyCancelText">Batalkan</span>
            </button>
            <button class="btn btn-sm btn-primary" id="daisyConfirmButton">
                <span id="daisyConfirmText">Ya, Lanjutkan</span>
            </button>
        </div>
    </div>
</div>

<script>
// ============= ALERT KONFIRMASI UNIVERSAL =============
let confirmCallback = null;

function showConfirmAlert(options = {}) {
    const {
        title = 'Konfirmasi Aksi',
        message = 'Apakah Anda yakin ingin melanjutkan aksi ini?',
        details = 'Pastikan data yang Anda masukkan sudah benar sebelum melanjutkan.',
        confirmText = 'Lanjutkan',
        cancelText = 'Batalkan',
        icon = 'fas fa-question-circle',
        iconColor = 'text-orange-500',
        confirmColor = 'bg-orange-500 hover:bg-orange-600',
        onConfirm = null
    } = options;

    // Set content
    document.getElementById('confirmTitle').textContent = title;
    document.getElementById('confirmMessage').textContent = message;
    document.getElementById('confirmDetails').textContent = details;
    document.getElementById('confirmButtonText').textContent = confirmText;
    document.getElementById('cancelText').textContent = cancelText;
    
    // Set icon
    const iconElement = document.getElementById('confirmIcon');
    iconElement.className = `${icon} ${iconColor} text-lg`;
    
    // Set button colors
    const confirmButton = document.getElementById('confirmButton');
    confirmButton.className = `px-4 py-2 ${confirmColor} text-white rounded-lg transition-colors duration-200`;
    
    // Store callback
    confirmCallback = onConfirm;
    
    // Show modal
    const alertElement = document.getElementById('confirmAlert');
    const modalElement = document.getElementById('confirmModal');
    
    alertElement.classList.remove('hidden');
    
    // Animate in
    setTimeout(() => {
        modalElement.classList.remove('scale-95', 'opacity-0');
        modalElement.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function hideConfirmAlert() {
    const alertElement = document.getElementById('confirmAlert');
    const modalElement = document.getElementById('confirmModal');
    
    // Animate out
    modalElement.classList.remove('scale-100', 'opacity-100');
    modalElement.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        alertElement.classList.add('hidden');
        confirmCallback = null;
    }, 300);
}

function showDaisyConfirmAlert(options = {}) {
    const {
        title = 'Konfirmasi Aksi',
        message = 'Apakah Anda yakin ingin melanjutkan?',
        confirmText = 'Ya, Lanjutkan',
        cancelText = 'Batalkan',
        onConfirm = null
    } = options;

    // Set content
    document.getElementById('daisyTitle').textContent = title;
    document.getElementById('daisyMessage').textContent = message;
    document.getElementById('daisyConfirmText').textContent = confirmText;
    document.getElementById('daisyCancelText').textContent = cancelText;
    
    // Store callback
    confirmCallback = onConfirm;
    
    // Show modal
    const alertElement = document.getElementById('daisyConfirmAlert');
    const modalElement = document.getElementById('daisyModal');
    
    alertElement.classList.remove('hidden');
    
    // Animate in
    setTimeout(() => {
        modalElement.classList.remove('scale-95', 'opacity-0');
        modalElement.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function hideDaisyConfirmAlert() {
    const alertElement = document.getElementById('daisyConfirmAlert');
    const modalElement = document.getElementById('daisyModal');
    
    // Animate out
    modalElement.classList.remove('scale-100', 'opacity-100');
    modalElement.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        alertElement.classList.add('hidden');
        confirmCallback = null;
    }, 300);
}

// Event listeners untuk tombol konfirmasi
document.addEventListener('DOMContentLoaded', function() {
    // Pastikan element sudah ada sebelum menambahkan event listener
    const confirmButton = document.getElementById('confirmButton');
    const daisyConfirmButton = document.getElementById('daisyConfirmButton');
    
    if (confirmButton) {
        confirmButton.addEventListener('click', function() {
            if (confirmCallback) {
                confirmCallback();
            }
            hideConfirmAlert();
        });
    }
    
    if (daisyConfirmButton) {
        daisyConfirmButton.addEventListener('click', function() {
            if (confirmCallback) {
                confirmCallback();
            }
            hideDaisyConfirmAlert();
        });
    }
    
    // Close modal when clicking backdrop
    const confirmAlert = document.getElementById('confirmAlert');
    const daisyConfirmAlert = document.getElementById('daisyConfirmAlert');
    
    if (confirmAlert) {
        confirmAlert.addEventListener('click', function(e) {
            if (e.target === this) {
                hideConfirmAlert();
            }
        });
    }
    
    if (daisyConfirmAlert) {
        daisyConfirmAlert.addEventListener('click', function(e) {
            if (e.target === this) {
                hideDaisyConfirmAlert();
            }
        });
    }
    
    // ESC key to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideConfirmAlert();
            hideDaisyConfirmAlert();
        }
    });
});
</script>
