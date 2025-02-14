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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->foreignId('account_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->foreignId('transaction_type_id')->references('transaction_type_id')->on('transaction_type_enums')->onDelete('cascade');
            $table->foreignId('transaction_mode_id')->references('transaction_mode_id')->on('transaction_mode_enums')->onDelete('cascade');
            $table->decimal('amount');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
