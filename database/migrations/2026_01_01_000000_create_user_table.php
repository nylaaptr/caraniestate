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
        Schema::create('user', function (Blueprint $table) {

            $table->increments('id_user');

            $table->string('nama_user');
            $table->string('no_hp', 15);

            $table->string('email_user')->unique();

            $table->string('password_user', 100);

            $table->enum('role_user', [
                'admin',
                'customer'
            ]);

            $table->string('profile_photo')->nullable();

            $table->timestamps();

            $table->string('google_id')->nullable();
            $table->text('google_avatar')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};