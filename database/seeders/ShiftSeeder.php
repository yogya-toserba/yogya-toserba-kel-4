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
    // Delete existing data
    DB::table('shift')->delete();

    DB::table('shift')->insert([
      [
        'id_shift' => 1,
        'nama_shift' => 'Pagi (Morning)',
        'jam_mulai' => '07:00:00',
        'jam_selesai' => '15:00:00',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id_shift' => 2,
        'nama_shift' => 'Siang (Afternoon)',
        'jam_mulai' => '15:00:00',
        'jam_selesai' => '23:00:00',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id_shift' => 3,
        'nama_shift' => 'Malam (Night)',
        'jam_mulai' => '23:00:00',
        'jam_selesai' => '07:00:00',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id_shift' => 4,
        'nama_shift' => 'Pagi Sabtu-Minggu',
        'jam_mulai' => '08:00:00',
        'jam_selesai' => '16:00:00',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id_shift' => 5,
        'nama_shift' => 'Siang Sabtu-Minggu',
        'jam_mulai' => '16:00:00',
        'jam_selesai' => '00:00:00',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id_shift' => 6,
        'nama_shift' => 'Full Time (08:00-17:00)',
        'jam_mulai' => '08:00:00',
        'jam_selesai' => '17:00:00',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id_shift' => 7,
        'nama_shift' => 'Part Time Pagi',
        'jam_mulai' => '08:00:00',
        'jam_selesai' => '13:00:00',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id_shift' => 8,
        'nama_shift' => 'Part Time Sore',
        'jam_mulai' => '13:00:00',
        'jam_selesai' => '18:00:00',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id_shift' => 9,
        'nama_shift' => 'Security 24 Jam',
        'jam_mulai' => '00:00:00',
        'jam_selesai' => '23:59:59',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'id_shift' => 10,
        'nama_shift' => 'Fleksibel/Remote',
        'jam_mulai' => '09:00:00',
        'jam_selesai' => '17:00:00',
        'created_at' => now(),
        'updated_at' => now(),
      ]
    ]);

    $this->command->info('✅ Data shift berhasil di-seed ke database');
  }
}
