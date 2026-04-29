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
        Schema::create('pets', function (Blueprint $table) {
    $table->id();

    // dueño
    $table->foreignId('owner_user_id')
          ->constrained('users')
          ->onDelete('cascade');

    $table->string('name', 80);
    $table->string('species', 50)->default('dog');
    $table->string('breed', 80)->nullable();
    $table->enum('size', ['toy','small','medium','large'])->nullable();
    $table->date('birth_date')->nullable();
    $table->text('care_notes')->nullable();
    $table->string('photo_path')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
