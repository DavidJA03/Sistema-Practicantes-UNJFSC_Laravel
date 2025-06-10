<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();                         // id auto incremental
            $table->string('name');              // nombre del usuario
            $table->string('email')->unique();   // correo electrónico, único
            $table->timestamp('email_verified_at')->nullable(); // para verificación de email
            $table->string('password');          // contraseña (hash)
            $table->rememberToken();             // token para "recordarme"
            $table->timestamps();                // created_at y updated_at

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
