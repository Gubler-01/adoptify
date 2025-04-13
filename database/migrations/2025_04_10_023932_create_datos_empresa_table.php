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
        Schema::create('datos_empresa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usu_up');
            $table->string('calle', 100)->nullable();
            $table->string('numero_exterior', 10)->nullable();
            $table->string('numero_interior', 10)->nullable();
            $table->string('codigo_postal', 10)->nullable();
            $table->string('colonia', 100)->nullable();
            $table->text('mision')->nullable();
            $table->text('valores')->nullable();
            $table->string('telefono', 15)->nullable();
            $table->string('correo', 100)->nullable();
            $table->decimal('latitud', 10, 8)->nullable();
            $table->decimal('longitud', 11, 8)->nullable();
            $table->integer('status');
            $table->string('facebook', 100)->nullable();
            $table->string('x', 100)->nullable();
            $table->string('instagram', 100)->nullable();
            $table->foreign('id_usu_up')->references('id')->on('usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_empresa');
    }
};
