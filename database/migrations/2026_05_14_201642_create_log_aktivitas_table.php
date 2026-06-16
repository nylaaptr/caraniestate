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
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();

            // HARUS SAMA: INT (bukan bigInteger)
            $table->integer('id_user')->nullable();

            $table->foreign('id_user')
                ->references('id_user')
                ->on('user')
                ->onDelete('set null');

            $table->string('aktivitas');
            $table->string('icon')->nullable();
            $table->string('tipe')->nullable();
            $table->unsignedBigInteger('ref_id')->nullable();

            $table->timestamps();

            $table->index('id_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};