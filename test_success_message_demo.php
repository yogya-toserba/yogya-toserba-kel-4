<?php
/**
 * Demo file for testing the success message functionality
 * This shows how to trigger the success message when items are sent
 */

// Example 1: How to trigger success message from any controller method
// Add this to any controller method where you want to show success message

// For sending items successfully:
session()->flash('barang_terkirim', 'Pengiriman berhasil dikirim ke cabang tujuan! 5 produk telah masuk ke sistem inventori.');

// For items received successfully:
session()->flash('barang_terkirim', 'Penerimaan berhasil! 10 produk baru telah masuk ke gudang cabang Jakarta Pusat.');

// For items transferred successfully:
session()->flash('barang_terkirim', 'Transfer stok berhasil! 15 produk telah dipindahkan ke gudang Bandung.');

// Example 2: Alternative way using success message with specific text
session()->flash('success', 'Pengiriman berhasil dikirim! Barang sedang dalam perjalanan ke cabang tujuan.');

// Example 3: How to use in controller return statement
// return redirect()->route('gudang.inventori')->with('barang_terkirim', 'Pengiriman berhasil dikirim!');

/**
 * The message will automatically:
 * 1. Display with green success styling
 * 2. Show truck icon for shipping context
 * 3. Auto-hide after 5 seconds
 * 4. Include close button for manual dismissal
 * 5. Use fade-in animation
 */

// To test this:
// 1. Go to pengiriman page
// 2. Send any item
// 3. You'll be redirected to inventory page with success message
// 4. Or manually add session flash in any controller and redirect to inventory page

echo "Demo file created - see comments for usage examples\n";
?>
