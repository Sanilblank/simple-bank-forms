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
        Schema::create('loans', function (Blueprint $table) {
            $table->id('loan_id');
            $table->foreignId('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->foreignId('loan_type_id')->references('loan_type_id')->on('loan_type_enums')->onDelete('cascade');
            $table->float('amount');
            $table->float('interest_rate');
            $table->integer('duration');
            $table->enum('approval_status', ['Approved', 'Pending', 'Rejected']);
            $table->string('repayment_schedule');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
