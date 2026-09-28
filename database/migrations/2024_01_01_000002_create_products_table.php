<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('old_price', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->integer('weight')->default(100)->comment('in grams');
            $table->string('brand')->nullable();
            $table->string('image')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('sold_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_best_seller')->default(false);
            $table->timestamps();
            
            // Indexes
            $table->index('category_id');
            $table->index('slug');
            $table->index('price');
            $table->index('rating');
            $table->index('is_featured');
            $table->index('is_best_seller');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};