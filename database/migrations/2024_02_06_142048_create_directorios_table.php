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
        Schema::create('directorios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedBigInteger('relacion_id')->nullable(); // Hacer nullable
            $table->foreign('relacion_id')->references('id')->on('relacions')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('cargoadicional_id')->nullable(); // Hacer nullable
            $table->foreign('cargoadicional_id')->references('id')->on('cargoadicionals')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directorios');
    }
};
