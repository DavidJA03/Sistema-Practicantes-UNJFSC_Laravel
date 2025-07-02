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
        Schema::create('practicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estudiante_id');
            $table->integer('grupo_practica_id')->nullable();
            $table->string('tipo_practica')->nullable();
            $table->string('titulo_practica')->nullable();
            $table->string('area')->nullable();
            $table->string('ruta_fut')->nullable();
            $table->string('ruta_carta_aceptacion')->nullable();
            $table->string('ruta_carta_presentacion')->nullable();
            $table->string('ruta_plan_actividades')->nullable();
            $table->string('ruta_constancia_cumplimiento')->nullable();
            $table->string('ruta_registro_actividades')->nullable();
            $table->string('ruta_control_actividades')->nullable();
            $table->string('ruta_informe_final')->nullable();
            $table->timestamps();
            $table->string('estado_proceso')->nullable();
            $table->integer('estado');
            $table->foreign('estudiante_id')->references('id')->on('personas')->onDelete('cascade');
            //añadir el foring key de la tabla grupo practica cuando se cree la tabla 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('practicas');
    }
};
