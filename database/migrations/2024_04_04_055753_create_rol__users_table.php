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
        Schema::create('rol_users', function (Blueprint $table) {
            $table->unsignedBigInteger('idRol'); // Esto creará una columna `user_id` para almacenar el ID del usuario
            $table->foreign('idRol')->references('idRol')->on('rol')->onDelete('cascade'); // Esto agrega una restricción de clave externa que hace referencia a la columna `user_id` en la tabla `users`


            $table->unsignedBigInteger('idUsuario'); // Esto creará una columna `user_id` para almacenar el ID del usuario
            $table->foreign('idUsuario')->references('idUsuario')->on('users')->onDelete('cascade'); // Esto agrega una restricción de clave externa que hace referencia a la columna `user_id` en la tabla `users`

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rol__users');
    }
};
