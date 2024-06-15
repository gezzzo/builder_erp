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
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('building_style')->nullable();
            $table->integer('project_number')->nullable();
            $table->json('cities')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('type')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('units_number')->nullable();
            $table->string('payment_options')->nullable();
            $table->date('delivery_time')->nullable();
            $table->boolean('is_visible_employee')->default(false);
            $table->text('address_map')->nullable();
            $table->text('address_input')->nullable();
            $table->string('attachment')->nullable();
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->json('services')->nullable();
            $table->string('after_sales')->nullable();
            $table->string('optional_service')->nullable();
            $table->string('project_instrument')->nullable();
            $table->string('project_building_permit')->nullable();
            $table->string('construction_completion_certificate')->nullable();
            $table->string('electricity_connection_certificate')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->foreignUuid('grantee_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
