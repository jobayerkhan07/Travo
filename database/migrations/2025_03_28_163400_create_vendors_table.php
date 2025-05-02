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
        schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string("firstname", length: 100);
            $table->string("lastname", length: 100);
            $table->string("email", length: 100)->unique();
            $table->string("phone", length: 11);
            $table->string("password", length: 255);
            $table->string('service', length: 100);
            $table->string('status', length: 100)->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::dropIfExists('vendors');
    }
};
