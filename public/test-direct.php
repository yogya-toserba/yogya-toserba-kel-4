<?php

echo "<h2>Test Endpoint Kirim Pengiriman</h2>";

// Start session
session_start();

// Set test data
$_SESSION['all_pengiriman'] = [
    [
        'id' => 1,
        'id_pengiriman' => 'SHIP-001',
        'nama_produk' => 'Monitor Samsung',
        'tujuan' => 'Cabang Bandung',
        'jumlah' => 3,
        'tanggal_kirim' => date('Y-m-d'),
        'status' => 'Siap Kirim',
        'created_at' => date('Y-m-d H:i:s')
    ]
];

echo "<p>Session data set!</p>";
echo "<p>Data: " . json_encode($_SESSION['all_pengiriman']) . "</p>";

// Test AJAX call
echo '
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<button onclick="testKirim()" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 5px;">
    Test Kirim AJAX
</button>

<script>
function testKirim() {
    console.log("Testing AJAX call...");
    
    $.ajax({
        url: "/gudang/pengiriman/kirim",
        type: "POST",
        data: {
            _token: "' . csrf_token() . '",
            index: 0
        },
        success: function(response) {
            console.log("Success:", response);
            alert("Success: " + JSON.stringify(response));
        },
        error: function(xhr, status, error) {
            console.error("Error:", xhr, status, error);
            alert("Error: " + xhr.responseText);
        }
    });
}
</script>
';

?>
