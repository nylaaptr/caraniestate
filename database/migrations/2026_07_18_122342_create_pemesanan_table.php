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
        Schema::create('pemesanan', function (Blueprint $table) {

            $table->increments('id_pemesanan');

            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_properti');
            $table->unsignedInteger('id_transaksi')->nullable();

            $table->string('kode_pemesanan',20)->unique();

            $table->enum('metode_pembayaran',[
                'kredit',
                'Lunas'
            ]);

            $table->string('tahap_saat_ini');

            $table->enum('status',[
                'Proses',
                'Selesai',
                'Ditolak'
            ])->default('Proses');

            $table->decimal('total_harga',15,2);

            $table->dateTime('tanggal_pemesanan')->useCurrent();

            $table->string('estimasi_proses')->nullable();

            $table->text('catatan_admin')->nullable();

            $table->timestamp('created_at')->useCurrent();

            $table->timestamp('updated_at')
                  ->useCurrent()
                  ->useCurrentOnUpdate();

            $table->foreign('id_user')
                ->references('id_user')
                ->on('user')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('id_properti')
                ->references('id_properti')
                ->on('properti')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('id_transaksi')
                ->references('id_transaksi')
                ->on('transaksi')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};