<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Pelanggan;
use App\Notifications\PelangganResetPasswordNotification;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email {email : Email address to send test to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email configuration by sending a test reset password email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        $this->info("Testing email configuration...");
        $this->info("Sending test email to: {$email}");

        try {
            // Create a temporary pelanggan object for testing
            $testPelanggan = new Pelanggan([
                'nama_pelanggan' => 'Test User',
                'email' => $email
            ]);

            // Generate test token
            $testToken = '123456';

            // Send notification
            $testPelanggan->notify(new PelangganResetPasswordNotification($testToken, $email));

            $this->info("✅ Email sent successfully!");
            $this->info("Test code: {$testToken}");

            if (config('mail.default') === 'log') {
                $this->warn("⚠️  Email driver is set to 'log'");
                $this->warn("Check storage/logs/laravel.log for email content");
            }
        } catch (\Exception $e) {
            $this->error("❌ Failed to send email!");
            $this->error("Error: " . $e->getMessage());

            $this->info("\n📧 Current mail configuration:");
            $this->table(['Setting', 'Value'], [
                ['MAIL_MAILER', config('mail.default')],
                ['MAIL_HOST', config('mail.mailers.smtp.host')],
                ['MAIL_PORT', config('mail.mailers.smtp.port')],
                ['MAIL_USERNAME', config('mail.mailers.smtp.username') ?: 'Not set'],
                ['MAIL_FROM_ADDRESS', config('mail.from.address')],
            ]);

            $this->info("\n💡 Troubleshooting tips:");
            $this->info("1. Make sure MAIL_* variables are set in .env");
            $this->info("2. Run 'php artisan config:clear' after changing .env");
            $this->info("3. For Gmail: use App Password, not regular password");
            $this->info("4. Check firewall/antivirus settings");
        }
    }
}
