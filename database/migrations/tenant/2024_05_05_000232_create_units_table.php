<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('unit_number')->nullable();
            $table->string('floor')->nullable();
            $table->string('model')->nullable();
            $table->string('status')->nullable();
            $table->float('price')->nullable();
            $table->text('address_map')->nullable();
            $table->text('address_input')->nullable();
            $table->string('building_facade')->nullable();
            $table->string('building_position')->nullable();
            $table->float('area')->nullable();
            $table->float('space_area')->nullable();
            $table->float('total_area')->nullable();
            $table->float('bedroom_main')->nullable();
            $table->float('bedroom')->nullable();
            $table->float('total_bedroom')->nullable();
            $table->float('bathroom')->nullable();
            $table->float('bathroom_inside')->nullable();
            $table->float('bathroom_guest')->nullable();
            $table->float('total_bathroom')->nullable();
            $table->float('living')->nullable();
            $table->float('divan')->nullable();
            $table->float('open_divan')->nullable();
            $table->float('dining_rooms')->nullable();
            $table->float('kitchen')->nullable();
            $table->string('kitchen_type')->nullable();
            $table->float('laundry_rooms')->nullable();
            $table->float('store_room')->nullable();
            $table->float('servant_room')->nullable();
            $table->float('park')->nullable();
            $table->float('balcony')->nullable();
            $table->float('terrace')->nullable();
            $table->float('private_entrance')->nullable();
            $table->float('havac')->nullable();
            $table->json('images')->nullable();
            $table->string('unit_deed')->nullable();
            $table->string('construction_license')->nullable();
            $table->string('sorting_report')->nullable();
            $table->string('architectural_plan')->nullable();
            $table->string('architectural_plan_pdf')->nullable();
            $table->string('chart')->nullable();
            $table->string('structural_plan')->nullable();
            $table->boolean('is_for_rent')->default(false);
            $table->json('features')->nullable();
            $table->json('services')->nullable();
            $table->string('after_sales')->nullable();
            $table->string('operational_services')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->foreignUuid('building_id')->constrained('buildings')->cascadeOnDelete();
            $table->foreignUuid('grantee_id')->nullable()->constrained('grantees')->cascadeOnDelete();
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
        Schema::dropIfExists('units');
    }
};
