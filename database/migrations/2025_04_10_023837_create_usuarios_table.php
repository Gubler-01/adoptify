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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('ap_pat', 50);
            $table->string('ap_mat', 50)->nullable();
            $table->string('username', 50);
            $table->string('password', 255);
            $table->string('email', 100);
            $table->string('telefono', 15)->nullable();
            $table->string('genero', 20)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->unsignedBigInteger('id_rol');
            $table->unsignedBigInteger('id_municipio');
            $table->integer('status');
            $table->foreign('id_rol')->references('id')->on('roles_usuarios');
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
