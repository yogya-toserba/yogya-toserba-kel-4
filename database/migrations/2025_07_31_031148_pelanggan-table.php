<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id('id_pelanggan'); // ID Pelanggan
            $table->string('nama_pelanggan'); // Nama pelanggan
            $table->date('tanggal_lahir'); // Tanggal Lahir
            $table->enum('jenis_kelamin', ['L', 'P']); // Jenis Kelamin
            $table->string('email')->unique(); // Email
            $table->string('nomer_telepon'); // Nomer Telepon
            $table->text('alamat'); // Alamat
            $table->string('password'); // Password (bisa pakai bcrypt nanti)
            $table->string('level_membership')->nullable(); // Level Membership (opsional)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelanggan');
    }
}
;