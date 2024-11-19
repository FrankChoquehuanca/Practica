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
        Schema::create('papeletas', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('gerencia');
            $table->time('salida');
            $table->time('retorno');
            $table->enum('motivos', ['comision', 'permiso', 'salud', 'citacion'])->default('comision')->nullable();
            $table->text('lugares');
            $table->string('observaciones');
            $table->date('fecha');
            $table->string('jefeinmediato');
            $table->unsignedBigInteger('monitoreo_id');
            $table->foreign('monitoreo_id')->references('id')->on('monitoreos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('papeletas');
    }
};
