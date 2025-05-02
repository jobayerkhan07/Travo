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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id'); // Which vendor added the car

            $table->string('owner_name');
            $table->string('owner_phone');
            $table->string('owner_email');

            $table->string('car_model');
            $table->integer('capacity');
            $table->string('car_color')->nullable();
            $table->string('plate_number');
            $table->boolean('air_conditioning');

            $table->json('images')->nullable();

            $table->decimal('price_per_day', 8, 2);
            $table->decimal('price_per_week', 8, 2);

            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->timestamps();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
