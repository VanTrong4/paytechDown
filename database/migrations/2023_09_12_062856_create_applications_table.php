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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('prefix')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('customer_id');

            $table->string('company_name')->nullable();
            $table->string('prefect')->nullable();
            $table->string('city')->nullable();
            $table->string('company_size')->nullable();
            $table->string('receivable_capital')->nullable();
            $table->string('business_history')->nullable();
            $table->string('number_of_transactions')->nullable();
            $table->string('has_contract')->nullable();
            $table->string('quick_was_used')->nullable();
            $table->string('billing')->nullable();
            $table->string('percent')->nullable();
            $table->string('fundraising_percent')->nullable();
            $table->string('fundraising_price')->nullable();

            $table->string('address')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('email')->nullable();
            $table->string('company')->nullable();
            $table->string('fullname')->nullable();
            $table->string('amount')->nullable();
            $table->string('format')->nullable();
            $table->string('company_office')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_other')->nullable();
            $table->string('company_phone_my')->nullable();

            $table->string('photo_id_1')->nullable();
            $table->string('photo_id_2')->nullable();
            $table->string('photo_bill')->nullable();
            $table->string('photo_item')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
