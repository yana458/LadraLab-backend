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
       Schema::create('services', function (Blueprint $table) {
    $table->id();

    $table->string('name', 100);
    $table->text('description')->nullable();

    $table->decimal('base_price', 10, 2)->default(0);

    $table->enum('booking_mode', ['date_range','single_day','time_slot']);

    $table->time('default_start_time')->nullable();
    $table->time('default_end_time')->nullable();

    $table->unsignedInteger('duration_minutes')->nullable();
    $table->unsignedInteger('slot_interval_min')->nullable();

    $table->boolean('is_active')->default(true);

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
