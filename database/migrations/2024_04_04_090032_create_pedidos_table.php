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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id('idPedido');
            $table->unsignedBigInteger('idRuta');
            $table->unsignedBigInteger('idCliente');
            $table->date('fechaPedido');
            $table->double('cantidadLitros',5,2);
            $table->string('estado');

            $table->foreign('idRuta')->references('idRuta')->on('rutas')->onDelete('cascade');
            $table->foreign('idCliente')->references('idCliente')->on('clientes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
