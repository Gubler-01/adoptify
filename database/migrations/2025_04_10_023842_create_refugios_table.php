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
        Schema::create('refugios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('calle', 100)->nullable();
            $table->string('numero_exterior', 10)->nullable();
            $table->string('numero_interior', 10)->nullable();
            $table->string('codigo_postal', 10)->nullable();
            $table->string('colonia', 100)->nullable();
            $table->unsignedBigInteger('id_municipio');
            $table->unsignedBigInteger('id_usuario');
            $table->integer('status');
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->foreign('id_usuario')->references('id')->on('usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refugios');
    }
};
