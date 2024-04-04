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
        Schema::create('carros_rutas', function (Blueprint $table) {
            $table->id('idCarrrosRutas');
            $table->unsignedBigInteger('idRuta');
            $table->unsignedBigInteger('idCarro');
            $table->foreign('idRuta')->references('idRuta')->on('rutas')->onDelete('cascade');
            $table->foreign('idCarro')->references('idCarro')->on('carros')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carros_rutas');
    }
};
