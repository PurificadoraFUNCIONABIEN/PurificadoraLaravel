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
        Schema::create('permiso_rols', function (Blueprint $table) {
            $table->unsignedBigInteger('idPermiso'); // Esto creará una columna `user_id` para almacenar el ID del usuario
            $table->foreign('idPermiso')->references('idPermiso')->on('permisos')->onDelete('cascade'); // Esto agrega una restricción de clave externa que hace referencia a la columna `user_id` en la tabla `users`


            $table->unsignedBigInteger('idRol'); // Esto creará una columna `user_id` para almacenar el ID del usuario
            $table->foreign('idRol')->references('idRol')->on('rols')->onDelete('cascade'); // Esto agrega una restricción de clave externa que hace referencia a la columna `user_id` en la tabla `users`

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permiso_rols');
    }
};
