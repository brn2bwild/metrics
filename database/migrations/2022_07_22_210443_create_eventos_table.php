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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->dateTime('fecha_hora');
            $table->string('ciudad');
            $table->string('estado');
            $table->string('direccion')->nullable();
            $table->string('comentarios')->nullable();
            $table->json('redes_sociales')->nullable();
            $table->string('url_pagina')->nullable();
            $table->string('url_imagen')->nullable();
            $table->string('url_evento');
            $table->foreignId('id_usuario')
                  ->nullable()
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
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
        Schema::dropIfExists('eventos');
    }
};
