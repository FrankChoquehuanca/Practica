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
        Schema::create('monitoreos', function (Blueprint $table) {
            $table->id();
            $table->time('horaingreso');
            $table->time('horasalida');
            $table->time('horacsalida');
            $table->time('horacingreso');
            $table->date('fecha');
            $table->unsignedBigInteger('asignacion_id');
            $table->foreign('asignacion_id')->references('id')->on('asignacions')->onDelete('cascade');
            // $table->unsignedBigInteger('archivo_id');
            // $table->foreign('archivo_id')->references('id')->on('archivos')->onDelete('cascade');
            $table->unsignedBigInteger('turno_id');
            $table->foreign('turno_id')->references('id')->on('turnos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoreos');
    }
};
