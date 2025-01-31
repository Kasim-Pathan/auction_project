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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            // $table->string('features_id');
            $table->string('name');
            $table->string('image');
            $table->json('optionalImage')->nullable();
            $table->integer('price');
            $table->integer('bid_price');
            $table->dateTime('auction_start');
            $table->dateTime('auction_end');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
