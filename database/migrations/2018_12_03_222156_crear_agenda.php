<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearAgenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mi_agenda', function (Blueprint $table) {
            $table->increments('id');
            $table->biginteger('documento');
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('direccio', 200);
            $table->string('numero', 150);
            $table->boolean('es_familiar')->default(false);
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
        Schema::dropIfExists('mi_agenda');
    }
}
