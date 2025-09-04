<?php
session_start();

echo "<h2>Session Debug</h2>";
echo "<h3>All Permintaan:</h3>";
if (isset($_SESSION['all_permintaan'])) {
    echo "<pre>" . print_r($_SESSION['all_permintaan'], true) . "</pre>";
} else {
    echo "No all_permintaan data in session";
}

echo "<h3>All Pengiriman:</h3>";
if (isset($_SESSION['all_pengiriman'])) {
    echo "<pre>" . print_r($_SESSION['all_pengiriman'], true) . "</pre>";
} else {
    echo "No all_pengiriman data in session";
}

echo "<h3>Full Session:</h3>";
echo "<pre>" . print_r($_SESSION, true) . "</pre>";
?>
