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
        Schema::create('cheques', function (Blueprint $table) {
            $table->id('cheque_id');
            $table->foreignId('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->foreignId('account_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->date('date_issued');
            $table->enum('status', ['Active', 'Finished', 'Cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cheques');
    }
};
