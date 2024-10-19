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
        Schema::create('system_info', function (Blueprint $table) {
            $table->id();

            // Fields for About
            $table->string('name'); // Name field
            $table->text('description'); // Description field
            $table->string('address'); // Address field
            $table->string('image1')->nullable(); // Image 1
            $table->string('image2')->nullable(); // Image 2
            $table->string('image3')->nullable(); // Image 3
            $table->string('image4')->nullable(); // Image 4

            // Fields for Services
            $table->string('service_name'); // Service name
            $table->text('service_description'); // Service description

            // Fields for Home (Carousel)
            $table->string('carousel_image1')->nullable(); // Carousel Image 1
            $table->string('carousel_image2')->nullable(); // Carousel Image 2

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_info');
    }
};
