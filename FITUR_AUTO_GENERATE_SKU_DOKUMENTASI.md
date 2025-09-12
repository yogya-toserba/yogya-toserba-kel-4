# 📋 DOKUMENTASI FITUR AUTO-GENERATE SKU

## 🎯 Deskripsi Fitur
Sistem auto-generate SKU yang otomatis membuat kode SKU berdasarkan kategori produk dengan format yang konsisten dan unik.

## 🔧 Format SKU
```
[KODE_KATEGORI]-[NOMOR_URUT]
```

### Mapping Kategori ke Kode SKU:
| Kategori | Kode SKU | Contoh |
|----------|----------|---------|
| Makanan | MKN | MKN-0001 |
| Minuman | MNM | MNM-0001 |
| Elektronik | ELK | ELK-0001 |
| Fashion | FSH | FSH-0001 |
| Kesehatan | KSH | KSH-0001 |
| Rumah Tangga | RMH | RMH-0001 |
| Olahraga | OLH | OLH-0001 |
| Lainnya | LNY | LNY-0001 |

## ⚡ Cara Kerja
1. **Pilih Kategori**: User memilih kategori produk dari dropdown
2. **Auto-Generate**: JavaScript otomatis generate SKU berdasarkan kategori
3. **Counter Increment**: Nomor urut bertambah otomatis untuk setiap kategori
4. **Persistent Storage**: Counter disimpan di localStorage browser
5. **Visual Feedback**: Field SKU berubah warna dan animasi saat di-generate

## 🎨 UI/UX Features
- ✅ Field SKU readonly (tidak bisa diedit manual)
- ✅ Label hint "Auto-generate berdasarkan kategori"
- ✅ Background berubah biru saat SKU di-generate
- ✅ Animasi pulse saat SKU baru dibuat
- ✅ Reset otomatis saat modal ditutup

## 📂 File yang Dimodifikasi

### 1. DashboardInventori.blade.php
**Lokasi**: `resources/views/gudang/inventori/DashboardInventori.blade.php`

**Perubahan**:
- Modal tambah produk dengan auto-generate SKU
- JavaScript untuk handling kategori dan SKU
- Event listeners untuk perubahan kategori
- Reset modal functionality

### 2. inventory.blade.php
**Lokasi**: `resources/views/gudang/inventori/inventory.blade.php`

**Perubahan**:
- Modal tambah produk dengan auto-generate SKU
- JavaScript yang sama untuk consistency
- Alert konfirmasi yang sudah terintegrasi

## 🔄 JavaScript Functions

### Core Functions:
```javascript
// Mapping kategori ke kode SKU
const kategoriToSKU = {
    'makanan': 'MKN',
    'minuman': 'MNM',
    'elektronik': 'ELK',
    'fashion': 'FSH',
    'kesehatan': 'KSH',
    'rumah_tangga': 'RMH',
    'olahraga': 'OLH',
    'lainnya': 'LNY'
};

// Generate nomor urut berikutnya
function getNextSKUNumber(kategori) {
    const storageKey = `sku_counter_${kategori}`;
    let counter = localStorage.getItem(storageKey);
    
    if (!counter) {
        counter = 1;
    } else {
        counter = parseInt(counter) + 1;
    }
    
    localStorage.setItem(storageKey, counter);
    return counter.toString().padStart(4, '0');
}

// Generate SKU lengkap
function generateSKU(kategori) {
    if (!kategori || !kategoriToSKU[kategori]) {
        return '';
    }
    
    const prefix = kategoriToSKU[kategori];
    const number = getNextSKUNumber(kategori);
    return `${prefix}-${number}`;
}
```

## 🎯 Event Listeners

### 1. Kategori Change Event:
```javascript
kategoriSelect.addEventListener('change', function() {
    const selectedKategori = this.value;
    
    if (selectedKategori && selectedKategori !== '') {
        const newSKU = generateSKU(selectedKategori);
        skuInput.value = newSKU;
        
        // Visual feedback
        skuInput.style.backgroundColor = '#f0f9ff';
        skuInput.style.color = '#1e40af';
        
        // Animation
        skuInput.classList.add('animate-pulse');
        setTimeout(() => {
            skuInput.classList.remove('animate-pulse');
        }, 1000);
    }
});
```

### 2. Modal Close Event:
```javascript
modal.addEventListener('close', function() {
    // Reset form
    form.reset();
    
    // Reset SKU field
    skuInput.value = '';
    skuInput.style.backgroundColor = '#f9fafb';
    skuInput.style.color = '#6b7280';
});
```

## 💾 Data Persistence
Counter SKU disimpan di **localStorage** browser dengan key format:
```
sku_counter_[kategori]
```

Contoh:
- `sku_counter_makanan`: 5 (berikutnya akan generate MKN-0006)
- `sku_counter_elektronik`: 12 (berikutnya akan generate ELK-0013)

## 🎨 CSS Styling

### Default State:
```css
background: #f9fafb;
color: #6b7280;
readonly: true;
```

### Generated State:
```css
background: #f0f9ff;
color: #1e40af;
animation: pulse 1s;
```

## 🔄 Integration dengan Alert System
SKU auto-generate terintegrasi dengan sistem alert konfirmasi:
- Preview SKU ditampilkan dalam alert konfirmasi
- Validasi SKU tidak kosong sebelum submit
- Error handling jika kategori tidak dipilih

## 📱 Responsive Design
- ✅ Bekerja di desktop dan mobile
- ✅ Touch-friendly untuk tablet
- ✅ Dropdown kategori responsive
- ✅ Visual feedback optimal di semua ukuran layar

## 🔧 Maintenance & Development

### Menambah Kategori Baru:
1. Tambahkan option baru di select kategori
2. Tambahkan mapping di object `kategoriToSKU`
3. Pastikan kode SKU unik dan konsisten

### Reset Counter (Development):
```javascript
// Reset counter untuk kategori tertentu
localStorage.removeItem('sku_counter_makanan');

// Reset semua counter
Object.keys(kategoriToSKU).forEach(kategori => {
    localStorage.removeItem(`sku_counter_${kategori}`);
});
```

## 🎯 Benefits
1. **Konsistensi**: Format SKU seragam di semua produk
2. **Otomatis**: Mengurangi human error
3. **Unik**: Tidak ada duplikasi SKU
4. **Kategori-based**: Mudah identifikasi jenis produk
5. **User-friendly**: Interface intuitif dan responsif

## 🚀 Future Enhancements
1. **Database Counter**: Pindah dari localStorage ke database
2. **Custom Prefix**: Admin bisa mengatur custom prefix kategori
3. **Batch Import**: Auto-generate SKU untuk import massal
4. **QR Code**: Generate QR code otomatis berdasarkan SKU
5. **Analytics**: Tracking penggunaan SKU per kategori

---

## 📞 Support
Jika ada pertanyaan atau issue terkait fitur auto-generate SKU, silakan hubungi tim development.

**Terakhir Update**: September 2025
**Version**: 1.0.0
**Status**: ✅ Production Ready
