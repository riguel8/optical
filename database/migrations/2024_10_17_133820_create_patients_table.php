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
            $table->id('patientID'); 
            $table->string('complete_name', 100);
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->integer('age')->nullable();
            $table->string('contact_number', 11)->nullable();
            $table->string('address', 255)->nullable();
            $table->enum('lens', ['SINGLE VISION', 'DOUBLE VISION', 'PROGRESSIVE', 'NEAR VISION'])->nullable();
            $table->string('frame', 255)->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->dateTime('date')->nullable()->default(now());
            $table->enum('prescription', ['(OD) Right Eye', '(OS) Left Eye', '(OU) Both Eyes'])->nullable();
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
