// routes/web.php
use Illuminate\Support\Facades\Mail;

Route::get('/tes-email', function () {
    Mail::raw('Tes kirim email dari Laravel via Gmail', function ($message) {
        $message->to('azkacayadi155@gmail.com')
                ->subject('WOI BIJI KAPAN LU KE RUMAH GW SINI UDAH JADI BUAT EMAIL GINI MAH PANTEK WOI BURUAN TITIT');
    });

    return "Email berhasil dikirim!";
});
