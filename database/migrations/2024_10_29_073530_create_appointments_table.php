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
    if (!Schema::hasTable('appointments')) {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('AppointmentID'); 
            $table->foreignId('PatientID')->references('PatientID')->on('patients')->onDelete('cascade');
            $table->foreignId('StaffID')->references('id')->on('users')->onDelete('cascade'); 
            $table->dateTime('DateTime');
            $table->enum('Status', ['Pending', 'Confirmed', 'Completed', 'Canceled'])->default('Pending');
            $table->text('Notes')->nullable();
            $table->timestamps(); 
        });
    }
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
