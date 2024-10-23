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
                $table->foreignId('PatientID')->references('patientID')->on('patients')->onDelete('cascade');
                $table->foreignId('DoctorID')->nullable();
                $table->enum('Lens', ['SINGLE VISION', 'DOUBLE VISION', 'PROGRESSIVE', 'NEAR VISION'])->nullable();
                $table->string('Frame', 255)->nullable();
                $table->decimal('Price', 10, 2)->nullable();
                $table->enum('Prescription', ['(OD) Right Eye', '(OS) Left Eye', '(OU) Both Eyes'])->nullable();
                $table->date('PrescriptionDate')->default(now());
                $table->text('PrescriptionDetails')->nullable();
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