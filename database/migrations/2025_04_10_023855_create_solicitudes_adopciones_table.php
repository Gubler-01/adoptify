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
        Schema::create('solicitudes_adopciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_animal');
            $table->unsignedBigInteger('id_adoptante');
            $table->dateTime('fecha_solicitud');
            $table->string('estado', 20);
            $table->integer('status');
            $table->foreign('id_animal')->references('id')->on('animales');
            $table->foreign('id_adoptante')->references('id')->on('usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_adopciones');
    }
};
