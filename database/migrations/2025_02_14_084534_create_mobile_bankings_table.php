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
        Schema::create('mobile_bankings', function (Blueprint $table) {
            $table->id('mobile_banking_id');
            $table->foreignId('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->string('registered_number');
            $table->enum('status', ['Active', 'Inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_bankings');
    }
};
