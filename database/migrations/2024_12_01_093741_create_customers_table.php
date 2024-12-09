<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('password_plain')->nullable();
            $table->string('telepon');
            $table->text('alamat');
            $table->string('kota');
            $table->string('kode_pos', 10);
            $table->string('provinsi');
            $table->enum('tipe_akun', ['individu', 'perusahaan', 'instansi'])->default('individu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
