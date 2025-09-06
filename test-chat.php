#!/usr/bin/env php
<?php

// Script untuk test chat functionality
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Gudang;
use App\Models\ChatRoom;
use App\Models\Pemasok;

echo "=== Testing Chat Functionality ===\n";

// 1. Cek apakah ada user gudang
$gudang = Gudang::first();
if (!$gudang) {
  echo "❌ Tidak ada user gudang ditemukan!\n";
  echo "Buat user gudang terlebih dahulu.\n";
  exit(1);
}
echo "✅ Gudang user found: " . $gudang->nama . " (ID: " . $gudang->id_gudang . ")\n";

// 2. Cek apakah ada pemasok
$pemasok = Pemasok::first();
if (!$pemasok) {
  echo "❌ Tidak ada pemasok ditemukan!\n";
  echo "Buat pemasok terlebih dahulu.\n";
  exit(1);
}
echo "✅ Pemasok found: " . $pemasok->nama_perusahaan . " (ID: " . $pemasok->id_pemasok . ")\n";

// 3. Cek apakah ada chat room
$chatRoom = ChatRoom::where('gudang_id', $gudang->id_gudang)
  ->where('pemasok_id', $pemasok->id_pemasok)
  ->first();

if (!$chatRoom) {
  echo "➕ Membuat chat room baru...\n";
  $chatRoom = ChatRoom::create([
    'nama_room' => 'Chat Test - ' . $pemasok->nama_perusahaan,
    'deskripsi' => 'Chat room untuk testing',
    'gudang_id' => $gudang->id_gudang,
    'pemasok_id' => $pemasok->id_pemasok,
    'status' => 'active',
    'last_message_at' => now()
  ]);
}
echo "✅ Chat room found/created: " . $chatRoom->nama_room . " (ID: " . $chatRoom->id . ")\n";

// 4. Test URL untuk chat
$chatUrl = url("/gudang/chat/{$chatRoom->id}");
echo "🔗 Chat URL: " . $chatUrl . "\n";

$messageUrl = url("/gudang/chat/{$chatRoom->id}/message");
echo "📤 Message URL: " . $messageUrl . "\n";

echo "\n=== Test Summary ===\n";
echo "✅ Gudang: " . $gudang->nama . "\n";
echo "✅ Pemasok: " . $pemasok->nama_perusahaan . "\n";
echo "✅ Chat Room: " . $chatRoom->nama_room . "\n";
echo "🌐 Akses chat di: " . $chatUrl . "\n";

echo "\n=== Possible Issues ===\n";
echo "1. Cek apakah sudah login sebagai gudang\n";
echo "2. Cek browser console untuk JavaScript errors\n";
echo "3. Cek storage/logs/laravel.log untuk server errors\n";
echo "4. Pastikan CSRF token ada di halaman\n";

echo "\n=== Debug Commands ===\n";
echo "php artisan serve\n";
echo "tail -f storage/logs/laravel.log\n";
