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
        Schema::create('reservations', function (Blueprint $table) {
    $table->id();

    // CLIENTE (usuario que reserva)
    $table->foreignId('client_user_id')
          ->constrained('users')
          ->onDelete('restrict');
    // MASCOTA
    $table->foreignId('pet_id')
          ->constrained('pets')
          ->onDelete('restrict');
    // SERVICIO 
    $table->foreignId('service_id')
      ->constrained('services')
      ->onDelete('restrict');
    // RECURSO (opcional)
    $table->foreignId('resource_id')
          ->nullable()
          ->constrained('resources')
          ->onDelete('set null');
    // FECHAS
    $table->dateTime('start_at');
    $table->dateTime('end_at');
    // ESTADO
    $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])
          ->default('pending');
    // NOTAS
    $table->text('notes')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
