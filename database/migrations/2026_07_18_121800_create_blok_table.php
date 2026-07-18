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
        Schema::create('blok', function (Blueprint $table) {

            $table->increments('id_blok');

            $table->unsignedInteger('id_perumahan');

            $table->string('nama_blok', 50);

            $table->foreign('id_perumahan')
                  ->references('id_perumahan')
                  ->on('perumahan')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blok');
    }
};