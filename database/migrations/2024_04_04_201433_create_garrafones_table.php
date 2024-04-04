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
        Schema::create('garrafones', function (Blueprint $table) {
            $table->id('idGarrafon');
            $table->unsignedBigInteger('idTipo');
            $table->string('estado');
            $table->string('color');
            $table->foreign('idTipo')->references('idTipo')->on('tipos_botellones')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garrafones');
    }
};
