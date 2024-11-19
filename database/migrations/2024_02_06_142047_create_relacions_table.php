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
        Schema::create('relacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gerencia_id');
            $table->foreign('gerencia_id')->references('id')->on('gerencias')->onDelete('cascade');
            $table->unsignedBigInteger('subgerencia_id')->nullable(); // Hacer nullable
            $table->foreign('subgerencia_id')->references('id')->on('subgerencias')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('departamento_id')->nullable(); // Hacer nullable
            $table->foreign('departamento_id')->references('id')->on('departamentos')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('unidad_id')->nullable(); // Hacer nullable
            $table->foreign('unidad_id')->references('id')->on('unidads')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('area_id')->nullable(); // Hacer nullable
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relacions');
    }
};
