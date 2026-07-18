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
        Schema::create('chat_messages', function (Blueprint $table) {

            $table->increments('id_messages');

            $table->unsignedInteger('id_sessions');

            $table->enum('sender', [
                'user',
                'bot',
                'admin'
            ]);

            $table->text('message');

            $table->json('properti_data')->nullable();

            $table->dateTime('created_at')->useCurrent();

            $table->foreign('id_sessions')
                ->references('id_sessions')
                ->on('chat_sessions')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};