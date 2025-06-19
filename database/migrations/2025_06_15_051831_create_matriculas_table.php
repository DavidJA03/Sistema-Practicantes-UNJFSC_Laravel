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
        Schema::create('matriculas', function (Blueprint $table) {
        $table->id();
        $table->string('estado_record')->nullable();
        $table->string('estado_ficha')->nullable();
        $table->string('ruta_ficha')->nullable();
        $table->string('ruta_record')->nullable();
        $table->unsignedBigInteger('persona_id');
        $table->foreign('persona_id')->references('id')->on('personas')->onDelete('cascade');
        $table->boolean('estado')->default(true);
        $table->timestamps(); // <-- Esto agrega created_at y updated_at automáticamente
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriculas');
    }
};
