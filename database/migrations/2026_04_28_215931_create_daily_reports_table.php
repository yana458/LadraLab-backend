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
       Schema::create('daily_reports', function (Blueprint $table) {
    $table->id();

    $table->foreignId('reservation_id')
          ->constrained()
          ->onDelete('cascade');

    $table->date('report_date');

    $table->enum('status', ['draft', 'published'])->default('draft');

    $table->dateTime('published_at')->nullable();

    // CHECKLIST
    $table->boolean('food_done')->default(false);
    $table->boolean('walk_done')->default(false);
    $table->boolean('rest_done')->default(false);
    $table->boolean('hygiene_done')->default(false);
    $table->boolean('medication_done')->default(false);
    $table->boolean('play_done')->default(false);

    $table->text('summary')->nullable();
    $table->text('observations')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_reports');
    }
};
