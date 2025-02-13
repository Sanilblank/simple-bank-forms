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
        Schema::create('account_categories', function (Blueprint $table) {
            $table->id('account_category_id');
            $table->foreignId('account_type_id')->references('account_type_id')->on('account_type_enums')->onDelete('cascade');
            $table->string('account_category_value')->unique();
            $table->float('interest_rate');
            $table->float('withdrawal_limit');
            $table->float('minimum_balance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_categories');
    }
};
