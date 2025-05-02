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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained()->onDelete('cascade');
            $table->string('property_name');
            $table->string('property_type');
            $table->string('location');
            $table->text('address');
            $table->text('description');
            $table->integer('guests');
            $table->integer('bathrooms');
            $table->decimal('price_per_day');
            $table->boolean('children_allowed');
            $table->integer('children_no');
            $table->boolean('pets_allowed');
            $table->integer('pets_no');
            $table->string('room_size');
            $table->json('images')->nullable()->default(null);
            $table->string('check_in_time');
            $table->string('check_out_time');

            $table->string('status')->nullable();   //this status will be changed if admin approves.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
