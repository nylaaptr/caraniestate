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
        Schema::create('gambar_properti', function (Blueprint $table) {
            $table->id('id_gambar');
            $table->unsignedBigInteger('id_properti');
            $table->string('path_gambar');
            $table->timestamps();
            $table->foreign('id_properti')
                ->references('id_properti')
                ->on('properti')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_properti');
    }
};
