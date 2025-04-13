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
        Schema::create('vacunas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_animal');
            $table->unsignedBigInteger('id_vacuna');
            $table->dateTime('fecha_aplicacion');
            $table->integer('status');
            $table->foreign('id_animal')->references('id')->on('animales');
            $table->foreign('id_vacuna')->references('id')->on('catalogo_vacunas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacunas');
    }
};
