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
                $table->bigIncrements('PrescriptionID')->unsigned();
                $table->unsignedBigInteger('PatientID')->nullable();
                $table->unsignedBigInteger('DoctorID')->nullable();
                $table->date('PrescriptionDate')->nullable();
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
