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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('vendors')->onDelete('cascade');
            $table->string('room_number');
            $table->integer('floor_number');
            $table->integer('room_size');
            $table->string('room_type');
            $table->integer('num_beds');
            $table->integer('max_capacity');
            $table->boolean('air_conditioning');
            $table->boolean('wifi');
            $table->boolean('balcony');
            $table->decimal('price_per_night', 8, 2);
            $table->decimal('extra_guest_price', 8, 2)->nullable();
            $table->json('room_images')->nullable();
            $table->date('available_from');
            $table->date('available_to');
            $table->string('location');
            $table->string('property_name');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
