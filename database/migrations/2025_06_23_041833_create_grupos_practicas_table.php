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
        Schema::create('grupos_practicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_docente');
            $table->unsignedBigInteger('id_semestre');
            $table->unsignedBigInteger('id_escuela');
            $table->String('nombre_grupo', 50);
            $table->timestamp('date_create')->nullable();
            $table->timestamp('date_update')->nullable();
            $table->foreign('id_docente')->references('id')->on('personas')->onDelete('cascade');
            $table->foreign('id_semestre')->references('id')->on('semestres')->onDelete('cascade');
            $table->foreign('id_escuela')->references('id')->on('escuelas')->onDelete('cascade');
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
        Schema::dropIfExists('grupos_practicas');
    }
};
