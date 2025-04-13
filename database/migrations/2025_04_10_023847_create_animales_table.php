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
        Schema::create('animales', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->integer('edad')->nullable();
            $table->string('raza', 50)->nullable();
            $table->unsignedBigInteger('id_tipo_animal');
            $table->unsignedBigInteger('id_refugio');
            $table->integer('status');
            $table->foreign('id_tipo_animal')->references('id')->on('tipos_animales');
            $table->foreign('id_refugio')->references('id')->on('refugios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animales');
    }
};
