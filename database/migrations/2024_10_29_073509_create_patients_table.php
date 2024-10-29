<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id('PatientID'); 
            $table->string('complete_name', 100);
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->integer('age')->nullable();
            $table->string('contact_number', 11)->nullable();
            $table->string('address', 255)->nullable();
            $table->dateTime('date')->nullable()->default(now());
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
