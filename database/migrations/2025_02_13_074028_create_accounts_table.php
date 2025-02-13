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
        Schema::create('accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id')->primary();
            $table->foreignId('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->foreignId('branch_id')->references('branch_id')->on('branches')->onDelete('cascade');
            $table->foreignId('account_category_id')->references('account_category_id')->on('account_categories')->onDelete('cascade');
            $table->decimal('balance');
            $table->date('date_opened');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
