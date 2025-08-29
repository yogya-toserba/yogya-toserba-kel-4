<?php
require 'vendor/autoload.php';
require 'bootstrap/app.php';

use Illuminate\Support\Facades\DB;

try {
  echo 'Checking gudang table...' . PHP_EOL;

  // Check if gudang table exists
  $tables = DB::select('SHOW TABLES LIKE "gudang"');
  if (empty($tables)) {
    echo 'ERROR: Table gudang does not exist!' . PHP_EOL;

    // Let's create the gudang table
    echo 'Creating gudang table...' . PHP_EOL;

    DB::statement('CREATE TABLE gudang (
            id_gudang VARCHAR(8) PRIMARY KEY,
            nama_gudang VARCHAR(100) NOT NULL,
            password VARCHAR(255) NOT NULL,
            lokasi VARCHAR(255) NOT NULL,
            status BOOLEAN DEFAULT 1,
            remember_token VARCHAR(100) NULL,
            created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )');

    echo 'Table gudang created successfully!' . PHP_EOL;

    // Insert sample data
    echo 'Inserting sample gudang data...' . PHP_EOL;

    DB::table('gudang')->insert([
      [
        'id_gudang' => 'GD001',
        'nama_gudang' => 'Gudang Pusat Jakarta',
        'password' => bcrypt('gudang123'),
        'lokasi' => 'Jakarta Selatan',
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'id_gudang' => 'GD002',
        'nama_gudang' => 'Gudang Bandung',
        'password' => bcrypt('gudang123'),
        'lokasi' => 'Bandung',
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now()
      ],
      [
        'id_gudang' => 'GD003',
        'nama_gudang' => 'Gudang Yogyakarta',
        'password' => bcrypt('gudang123'),
        'lokasi' => 'Yogyakarta',
        'status' => 1,
        'created_at' => now(),
        'updated_at' => now()
      ]
    ]);

    echo 'Sample gudang data inserted successfully!' . PHP_EOL;
  } else {
    echo 'Table gudang exists.' . PHP_EOL;
  }

  // Check table structure
  $columns = DB::select('DESCRIBE gudang');
  echo 'Columns in gudang table:' . PHP_EOL;
  foreach ($columns as $column) {
    echo '  - ' . $column->Field . ' (' . $column->Type . ')' . PHP_EOL;
  }

  // Check if there are any records
  $count = DB::table('gudang')->count();
  echo 'Records in gudang table: ' . $count . PHP_EOL;

  if ($count > 0) {
    $records = DB::table('gudang')->get();
    echo 'Sample records:' . PHP_EOL;
    foreach ($records as $record) {
      echo '  - ID: ' . $record->id_gudang . ', Nama: ' . $record->nama_gudang . ', Lokasi: ' . $record->lokasi . PHP_EOL;
    }
  }
} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
