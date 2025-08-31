<?php

namespace Database\Factories;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
  /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
  protected $model = Karyawan::class;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $divisi = ['Produksi', 'Penjualan', 'Admin', 'Gudang', 'Keuangan', 'HRD', 'IT', 'Marketing', 'Customer Service', 'Security'];

    return [
      'nama' => $this->faker->name(),
      'divisi' => $this->faker->randomElement($divisi),
      'alamat' => $this->faker->address(),
      'email' => $this->faker->unique()->safeEmail(),
      'tanggal_lahir' => $this->faker->dateTimeBetween('-50 years', '-18 years'),
      'nomer_telepon' => '08' . $this->faker->numberBetween(10000000, 99999999),
      'id_shift' => $this->faker->numberBetween(1, 3), // Assuming 3 shifts exist
    ];
  }
}
