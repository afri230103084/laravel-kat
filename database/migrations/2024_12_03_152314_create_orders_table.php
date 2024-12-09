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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('kode_transaksi')->unique();
            $table->enum('status', ['baru', 'menunggu', 'dibuat', 'diantar', 'selesai', 'batal', 'transaksi_selesai'])->default('baru');
            $table->enum('jenis_pengambilan', ['diantar', 'diambil']);
            $table->enum('metode_pembayaran', ['cash', 'transfer']);
            $table->enum('status_pembayaran', ['dp', 'lunas'])->default('dp');
            $table->string('bukti_pembayaran')->nullable();
            $table->decimal('total_harga', 15, 2);
            $table->decimal('jumlah_dibayar', 15, 2)->nullable();
            $table->text('alamat');
            $table->date('tanggal_acara');
            $table->time('waktu_acara');
            $table->text('catatan')->nullable();
            $table->string('midtrans_transaction_id')->nullable();
            $table->string('midtrans_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
