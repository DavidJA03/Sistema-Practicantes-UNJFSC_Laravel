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
        Schema::create('type_users', function (Blueprint $table) {
            
            $table->id();
            $table->string('name', 50);
            $table->timestamp('date_create');
            $table->dateTime('date_update')->nullable();
            $table->boolean('estado')->default(true);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_users');
    }
};
