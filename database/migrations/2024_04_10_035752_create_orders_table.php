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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('route_id');
            $table->unsignedBigInteger('customer_id');
            $table->date('order_date');
            $table->double('number_liters',5,2);
            $table->enum('state', ['stateless', 'on hold', 'attending to the order', 'on the way', 'order delivered'])->default('stateless');

            $table->foreign('route_id')->references('id')->on('routes')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
