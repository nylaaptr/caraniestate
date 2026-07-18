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
        Schema::create('transaksi', function (Blueprint $table) {

            $table->increments('id_transaksi');

            $table->unsignedInteger('id_properti');
            $table->unsignedInteger('id_user');

            $table->date('tanggal_transaksi');

            $table->decimal('total_harga', 15, 2);

            $table->enum('jenis_transaksi', [
                'lunas',
                'kredit',
                'KPR'
            ]);

            $table->enum('metode_pembayaran', [
                'transfer_bank',
                'virtual_account',
                'qris_ewallet'
            ]);

            $table->enum('bank_pengirim', [
                'bca',
                'mandiri',
                'bni',
                'bri',
                'gopay',
                'ovo',
                'dana',
                'bca_va',
                'mandiri_va',
                'bni_va'
            ])->nullable();

            $table->date('tanggal_transfer')->nullable();

            $table->enum('status_transaksi', [
                'menunggu_pembayaran',
                'menunggu_verifikasi',
                'berhasil',
                'ditolak',
                'perlu_upload_ulang',
                'pending'
            ]);

            $table->string('bukti_transaksi')->nullable();

            $table->timestamps();

            $table->foreign('id_properti')
                ->references('id_properti')
                ->on('properti')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('id_user')
                ->references('id_user')
                ->on('user')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};