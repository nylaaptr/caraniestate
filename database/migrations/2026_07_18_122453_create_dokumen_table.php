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
        Schema::create('dokumen', function (Blueprint $table) {

            $table->increments('id_dokumen');

            $table->unsignedInteger('id_user');

            $table->unsignedInteger('id_pemesanan')->nullable();

            $table->unsignedInteger('id_transaksi')->nullable();

            $table->enum('jenis_dokumen',[
                'ktp',
                'kk',
                'surat_nikah',
                'npwp',
                'slip_gaji',
                'surat_keterangan_kerja',
                'rekening_koran',
                'spt_pajak',
                'siup',
                'surat_keterangan_usaha',
                'pembukuan_usaha',
                'selfie',
                'foto_lokasi_usaha',
                'foto_tempat_kerja',
                'foto_3x4',
                'surat_kerja',
                'bukti_booking',
                'dokumen_admin',
                'surat_penghasilan_usaha',
                'bukti_pembayaran'
            ]);

            $table->string('nama_file');

            $table->string('path_file');

            $table->string('tipe_file',50);

            $table->bigInteger('ukuran_file');

            $table->enum('status_verifikasi',[
                'pending',
                'diterima',
                'revisi',
                'ditolak'
            ]);

            $table->text('catatan_verifikasi')->nullable();

            $table->timestamp('uploaded_at')->useCurrent();

            $table->timestamp('verified_at')->nullable();

            $table->enum('sumber_dokumen',[
                'pelanggan',
                'admin'
            ])->default('pelanggan');

            $table->foreign('id_user')
                ->references('id_user')
                ->on('user')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('id_pemesanan')
                ->references('id_pemesanan')
                ->on('pemesanan')
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
        Schema::dropIfExists('dokumen');
    }
};