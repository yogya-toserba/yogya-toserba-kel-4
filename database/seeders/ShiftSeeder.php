<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Truncate table first
    DB::table('shift')->truncate();
    
    DB::table('shift')->insert([
      [
        'id_shift' => 1,
        'nama_shift' => 'Pagi',
        'jam_mulai' => '08:00:00',
        'jam_selesai' => '16:00:00',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id_shift' => 2,
        'nama_shift' => 'Siang',
        'jam_mulai' => '14:00:00',
        'jam_selesai' => '22:00:00',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id_shift' => 3,
        'nama_shift' => 'Malam',
        'jam_mulai' => '22:00:00',
        'jam_selesai' => '06:00:00',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);

    $this->command->info('✅ Data shift berhasil di-seed ke database');
  }
}
