<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateGajiOtomatis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gaji:generate {periode?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate gaji otomatis untuk semua karyawan berdasarkan kehadiran dan jabatan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $periode = $this->argument('periode') ?? now()->format('Y-m-01');

        $this->info("Memulai generate gaji otomatis untuk periode: {$periode}");

        try {
            $gajiGenerated = \App\Models\Gaji::generateGajiOtomatisSemua($periode);

            $count = count($gajiGenerated);

            if ($count > 0) {
                $this->info("✅ Berhasil generate {$count} gaji karyawan!");

                $this->table(
                    ['Karyawan', 'Jabatan', 'Total Gaji', 'Status'],
                    collect($gajiGenerated)->map(function ($gaji) {
                        return [
                            $gaji->karyawan->nama,
                            $gaji->karyawan->jabatan->nama_jabatan,
                            $gaji->formatted_total_gaji,
                            $gaji->status
                        ];
                    })->toArray()
                );
            } else {
                $this->warn("⚠️ Tidak ada gaji yang di-generate. Kemungkinan gaji untuk periode ini sudah ada.");
            }
        } catch (\Exception $e) {
            $this->error("❌ Error: " . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
