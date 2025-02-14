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
        Schema::create('fixed_deposits', function (Blueprint $table) {
            $table->id('fixed_deposit_id');
            $table->foreignId('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->foreignId('account_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->float('deposit_amount');
            $table->float('interest_rate');
            $table->date('maturity_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixed_deposits');
    }
};
