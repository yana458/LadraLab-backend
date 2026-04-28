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

        // Relaciones
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('pet_id')->constrained()->onDelete('cascade');

        // Fechas de la reserva
        $table->date('start_date');
        $table->date('end_date');

        // Estado
        $table->string('status')->default('pending');

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
