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
        Schema::create('resources', function (Blueprint $table) {
    $table->id();
    $table->string('name', 80);
    $table->enum('type', ['kennel','yard','room','other'])->default('kennel');
    $table->enum('zone', ['hotel','daycare','support'])->default('hotel');
    $table->enum('size_group', ['toy', 'small','medium','large','all'])->default('all');
    $table->unsignedInteger('capacity')->default(1);
    $table->enum('status', ['active','cleaning','disabled'])->default('active');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
