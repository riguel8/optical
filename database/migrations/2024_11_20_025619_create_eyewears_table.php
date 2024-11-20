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
        Schema::create('eyewears', function (Blueprint $table) {
            $table->id('EyewearID'); 
            $table->string('Brand', 100);
            $table->string('Model', 100);
            $table->string('FrameType', 50)->nullable();
            $table->string('FrameColor', 50)->nullable();
            $table->string('LensType', 50)->nullable();
            $table->string('LensMaterial', 50)->nullable();
            $table->decimal('Price', 10, 2);
            $table->integer('QuantityAvailable');
            $table->string('image')->nullable(); 
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eyewears');
    }
};
