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
        Schema::create('notifikasi', function (Blueprint $table) {

            $table->increments('id_notifikasi');

            $table->unsignedInteger('id_user');

            $table->string('judul')->nullable();

            $table->text('pesan')->nullable();

            $table->enum('tipe', [
                'tagihan',
                'pembayaran',
                'dokumen',
                'info',
                'transaksi',
                'verifikasi',
                'monitoring',
                'pelunasan'
            ])->nullable();

            $table->boolean('status_baca')->default(false);

            $table->enum('status_kirim', [
                'pending',
                'terkirim',
                'gagal'
            ])->nullable();

            $table->enum('channel', [
                'in_app',
                'email',
                'whatsapp'
            ])->nullable();

            $table->integer('referensi_id')->nullable();

            $table->string('referensi_tipe',50)->nullable();

            $table->timestamp('created_at')->useCurrent();

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
        Schema::dropIfExists('notifikasi');
    }
};