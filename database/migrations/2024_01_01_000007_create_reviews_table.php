<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->integer('rating');
            $table->text('comment')->nullable();
            $table->timestamps();
            
            // Ensure one review per product per order per user
            $table->unique(['user_id', 'product_id', 'order_id']);
            
            // Indexes
            $table->index('user_id');
            $table->index('product_id');
            $table->index('order_id');
            $table->index('rating');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};