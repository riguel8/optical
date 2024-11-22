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
        if (!Schema::hasTable('amount')) {
            Schema::create('amount', function (Blueprint $table) {
                $table->id('AmountID');
                $table->decimal('TotalAmount', 10, 2)->nullable();
                $table->decimal('Deposit', 10, 2)->nullable();
                $table->decimal('Balance', 10, 2)->nullable();
                $table->enum('MOP', ['Cash', 'Card', 'Gcash'])->nullable();
                $table->enum('Payment', ['Paid', 'Partial', 'Unpaid'])->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amount');
    }
};
