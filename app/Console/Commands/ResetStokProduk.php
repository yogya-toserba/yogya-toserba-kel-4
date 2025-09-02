<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetStokProduk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:stok-produk {--confirm : Confirm the reset without prompting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset semua data di tabel stok_produk dan reset auto increment';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Konfirmasi dari user kecuali menggunakan --confirm flag
        if (!$this->option('confirm')) {
            if (!$this->confirm('⚠️  Apakah Anda yakin ingin menghapus SEMUA data stok_produk? Aksi ini tidak dapat dibatalkan!')) {
                $this->info('❌ Reset dibatalkan.');
                return Command::FAILURE;
            }
        }

        try {
            // Hitung jumlah data sebelum dihapus
            $count = DB::table('stok_produk')->count();
            
            $this->info('🗑️  Menghapus ' . $count . ' record dari tabel stok_produk...');
            
            // Hapus semua data
            DB::table('stok_produk')->delete();
            
            // Reset auto increment
            DB::statement('ALTER TABLE stok_produk AUTO_INCREMENT = 1');
            
            $this->info('✅ Berhasil menghapus ' . $count . ' record dari tabel stok_produk');
            $this->info('🔄 Auto increment direset ke 1');
            $this->newLine();
            $this->info('🎉 Data fresh dan siap digunakan!');
            
            return Command::SUCCESS;
            
        } catch (\Exception $e) {
            $this->error('❌ Error saat reset data: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
