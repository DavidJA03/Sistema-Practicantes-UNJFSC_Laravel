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
        Schema::create('grupo_estudiante', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_supervisor');
            $table->unsignedBigInteger('id_estudiante');
            $table->unsignedBigInteger('id_grupo_practica');
            $table->foreign('id_supervisor')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('id_estudiante')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('id_grupo_practica')->references('id')->on('grupos_practicas')->onDelete('cascade');
            $table->timestamp('date_create')->nullable();
            $table->timestamp('date_update')->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo_estudiantes');
    }
};
