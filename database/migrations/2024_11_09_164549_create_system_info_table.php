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

            $table->json('carousel_images')->nullable();
            $table->text('about')->nullable(); 
            $table->text('description')->nullable(); 
            $table->string('address')->nullable(); 
            $table->json('about_images')->nullable();
            $table->json('services')->nullable(); 
            $table->json('ophthalmologists')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('system_info');
    }
};

