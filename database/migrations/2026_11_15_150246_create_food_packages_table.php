<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('food_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('canteen_partner_id')
                  ->constrained('canteen_partners')
                  ->cascadeOnDelete();

            $table->string('name');
            $table->text('description');
            $table->decimal('normal_price', 10, 2);
            $table->decimal('offer_price', 10, 2);
            $table->unsignedInteger('stock');
            $table->dateTime('pickup_deadline');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('food_packages');
    }
};