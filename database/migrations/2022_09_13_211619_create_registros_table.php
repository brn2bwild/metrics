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
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->foreignId('id_evento')
                  ->constrained('eventos')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->foreignId('id_categoria')
                  ->constrained('categorias')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
            $table->json('tiempos')->nullable();
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
        Schema::dropIfExists('registros');
    }
};
