<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('Primary key');
            $table->string('name')->comment('Client name');
            $table->string('email')->unique()->comment('Client email');
            $table->string('phone')->nullable()->comment('Client phone');
            $table->string('salesman')->nullable()->comment('Salesman name');
            $table->string('interest')->nullable()->comment('Client interest');
            $table->string('payment_method')->nullable()->comment('Client payment method');
            $table->string('contact_method')->nullable()->comment('Client contact method');
            $table->integer('budget')->nullable()->comment('Client budget');
            $table->string('city')->nullable()->comment('Client city');
            $table->string('neighbourhood')->nullable()->comment('Client neighbourhood');
            $table->text('notes')->nullable()->comment('Client notes');
            $table->string('national_id')->nullable()->comment('Client national id');
            $table->string('national_address')->nullable()->comment('Client national address');
            $table->string('iban_certification')->nullable()->comment('Client iban certification');
            $table->string('legal_agent')->nullable()->comment('Client legal agent');
            $table->boolean('is_lead')->default(false)->comment('Client is lead');
            $table->boolean('is_tax_exempted')->default(false)->comment('Client is tax exempted');
            $table->boolean('is_deleted')->default(false)->comment('Client is deleted');
            $table->boolean('is_active')->default(true)->comment('Client is active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
