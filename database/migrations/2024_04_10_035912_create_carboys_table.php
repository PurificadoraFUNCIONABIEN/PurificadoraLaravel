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
        Schema::create('carboys', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('carboyType_id');
            $table->enum('state', ['nuevo', 'seminuevo', 'buen estado', 'dañado', 'roto'])->default('nuevo');
            $table->string('color');
            $table->float('cantidad');
            $table->string('img');
            $table->foreign('carboyType_id')->references('id')->on('carboy_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carboys');
    }
};
