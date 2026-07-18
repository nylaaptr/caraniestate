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
        Schema::create('chat_sessions', function (Blueprint $table) {

            $table->increments('id_sessions');

            $table->unsignedInteger('id_user')->nullable();

            $table->enum('status_chat', [
                'aktif',
                'selesai',
                'pending'
            ]);

            $table->timestamp('started_at')->nullable();

            $table->timestamp('ended_at')->useCurrent();

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
        Schema::dropIfExists('chat_sessions');
    }
};