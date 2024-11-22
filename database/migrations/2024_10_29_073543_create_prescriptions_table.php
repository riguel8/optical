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
        if (!Schema::hasTable('prescriptions')) {
            Schema::create('prescriptions', function (Blueprint $table) {
                $table->id('PrescriptionID');
                $table->foreignId('PatientID')->references('PatientID')->on('patients')->onDelete('cascade'); 
                $table->foreignId('DoctorID')->references('id')->on('users')->onDelete('cascade');
                $table->foreignId('AmountID')->references('AmountID')->on('amount')->onDelete('cascade');
                $table->enum('Lens', ['SINGLE VISION', 'DOUBLE VISION', 'PROGRESSIVE', 'NEAR VISION'])->nullable();
                $table->enum('LensType', ['Ordinary', 'Anti-Rad', 'Photochromic'])->nullable();
                $table->string('Frame', 255)->nullable();
                // $table->decimal('Price', 10, 2)->nullable(); 
                $table->enum('Prescription', ['(OD) Right Eye & (OS) Left Eye','(OU) Both Eyes'])->nullable();
                $table->date('PrescriptionDate')->default(now());
                $table->text('PrescriptionDetails')->nullable();
                $table->string('OUgrade', 50)->nullable();
                $table->string('OSgrade', 50)->nullable();
                $table->string('ODgrade', 50)->nullable();
                $table->string('ADD', 50)->nullable();
                $table->string('PD', 50)->nullable();
                $table->enum('PresStatus', ['Completed'])->default('Completed');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
