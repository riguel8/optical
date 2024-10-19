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

            $table->string('name'); 
            $table->text('description'); 
            $table->string('address'); 
            $table->string('image')->nullable(); 

            $table->string('service_name'); 
            $table->text('service_description'); 
            $table->string('carousel_image')->nullable(); 

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
