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
       Schema::create('media', function (Blueprint $table) {
    $table->id();

    $table->foreignId('daily_report_id')
          ->constrained()
          ->onDelete('cascade');

    $table->string('file_path');

    $table->enum('file_type', ['image', 'document', 'other'])
          ->default('image');

    $table->dateTime('uploaded_at');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
