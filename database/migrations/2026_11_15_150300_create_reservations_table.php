<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('food_package_id')
                  ->constrained('food_packages')
                  ->cascadeOnDelete();

            $table->unsignedInteger('quantity');
            $table->decimal('total_price', 10, 2);
            $table->string('pickup_code')->unique();
            $table->string('status')->default('menunggu_pengambilan');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};