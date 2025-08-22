document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('addProductModal');
    const addBtn = document.querySelector('.inventory-actions .btn:last-child');
    const closeBtn = document.querySelector('.close');
    const cancelBtn = document.querySelector('.btn-cancel');
    const form = document.getElementById('productForm');

    // Buka modal
    addBtn.onclick = () => {
        modal.style.display = "block";
        document.body.classList.add('modal-open');
    };

    // Tutup modal
    function closeModal() {
        modal.style.display = "none";
        document.body.classList.remove('modal-open');
        form.reset();
        document.getElementById('image-preview').innerHTML = '';
    }

    closeBtn.onclick = closeModal;
    cancelBtn.onclick = closeModal;
    window.onclick = e => { if (e.target === modal) closeModal(); };

    // Preview gambar
    window.previewImage = function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('image-preview').innerHTML =
                `<img src="${reader.result}" alt="Preview" style="max-width:100px;">`;
        };
        reader.readAsDataURL(event.target.files[0]);
    };

    // Submit form
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('/gudang/inventory', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message || 'Berhasil disimpan');
            closeModal();
            location.reload();
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan saat menyimpan data');
        });
    });
});

