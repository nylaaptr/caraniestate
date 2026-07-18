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
        Schema::create('properti', function (Blueprint $table) {

            $table->increments('id_properti');

            $table->unsignedInteger('id_perumahan');
            $table->unsignedInteger('id_blok');

            $table->string('nama_properti');

            $table->enum('jenis_properti', [
                'rumah',
                'ruko'
            ]);

            $table->enum('kategori_properti', [
                'subsidi',
                'komersial'
            ]);

            $table->enum('tipe_properti', [
                '30/60',
                '36/72',
                '45/84',
                '60/135',
                'Ruko'
            ]);

            $table->decimal('harga_properti', 15, 2);

            $table->bigInteger('bookingFee');

            $table->decimal('luas_bangunan', 6, 2);

            $table->decimal('luas_tanah', 6, 2);

            $table->unsignedInteger('stok_unit');

            $table->enum('status_unit', [
                'tersedia',
                'dipesan',
                'terjual'
            ]);

            $table->timestamps();

            $table->foreign('id_perumahan')
                  ->references('id_perumahan')
                  ->on('perumahan')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->foreign('id_blok')
                  ->references('id_blok')
                  ->on('blok')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properti');
    }
};