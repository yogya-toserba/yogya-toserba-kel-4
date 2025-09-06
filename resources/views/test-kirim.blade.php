<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Kirim Pengiriman</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        button { margin: 10px; padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #0056b3; }
        #result { margin-top: 20px; padding: 15px; border-radius: 5px; }
        .success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <h1>Test Transfer Data: Pengiriman → Penerimaan</h1>
    
    <div>
        <h3>Step 1: Tambah Data Test</h3>
        <button onclick="addTestData()">Tambah Data Test ke Session</button>
    </div>
    
    <div>
        <h3>Step 2: Test Kirim Pengiriman</h3>
        <button onclick="testKirimPengiriman(0)">Kirim Item Index 0 (Monitor Samsung)</button>
        <button onclick="testKirimPengiriman(1)">Kirim Item Index 1 (Printer Canon)</button>
    </div>
    
    <div>
        <h3>Step 3: Lihat Hasil</h3>
        <a href="/gudang/pengiriman" target="_blank">
            <button style="background: #28a745;">Lihat Halaman Pengiriman</button>
        </a>
        <a href="/gudang/inventori/penerimaan" target="_blank">
            <button style="background: #17a2b8;">Lihat Halaman Penerimaan</button>
        </a>
    </div>
    
    <div id="result"></div>

    <script>
    // Setup CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function addTestData() {
        $('#result').html('<div>Loading...</div>');
        
        $.get('/test-data')
            .done(function(response) {
                console.log('Test data added:', response);
                $('#result').html('<div class="success">✅ ' + response.message + 
                    '<br>Pengiriman: ' + response.pengiriman_count + 
                    '<br>Penerimaan: ' + response.penerimaan_count + '</div>');
            })
            .fail(function(xhr) {
                $('#result').html('<div class="error">❌ Error adding test data: ' + xhr.responseText + '</div>');
            });
    }

    function testKirimPengiriman(index) {
        console.log('Testing kirim pengiriman for index:', index);
        $('#result').html('<div>Mengirim pengiriman index ' + index + '...</div>');
        
        $.ajax({
            url: '/test-kirim-ajax',
            type: 'POST',
            data: {
                index: index
            },
            success: function(response) {
                console.log('Success response:', response);
                
                if (response.success) {
                    $('#result').html('<div class="success">✅ ' + response.message + 
                        '<br><strong>Data yang dipindahkan:</strong>' +
                        '<br>• Produk: ' + response.data.penerimaan_added.nama_produk +
                        '<br>• Tujuan: ' + response.data.penerimaan_added.tujuan +
                        '<br>• Jumlah: ' + response.data.penerimaan_added.jumlah +
                        '<br>• Status: ' + response.data.penerimaan_added.status +
                        '<br>• Total Penerimaan: ' + response.data.total_penerimaan +
                        '</div>');
                    
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success',
                        timer: 3000,
                        showConfirmButton: true,
                        confirmButtonText: 'Lihat Penerimaan'
                    }).then((result) => {
                        if (result.isConfirmed && response.redirect) {
                            window.open(response.redirect, '_blank');
                        }
                    });
                } else {
                    $('#result').html('<div class="error">❌ ' + response.message + '</div>');
                }
            },
            error: function(xhr, status, error) {
                console.log('Error response:', xhr.responseText);
                $('#result').html('<div class="error">❌ Error: ' + xhr.responseText + '</div>');
                
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan: ' + error,
                    icon: 'error'
                });
            }
        });
    }
    </script>
</body>
</html>
