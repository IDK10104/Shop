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
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->integer('price'); // cents
            $table->integer('compare_price')->nullable(); // original price for sale display
            $table->string('image')->nullable();
            $table->json('images')->nullable(); // additional images
            $table->integer('stock')->default(0);
            $table->string('sku')->nullable()->unique();
            $table->boolean('featured')->default(false);
            $table->boolean('active')->default(true);
            $table->string('badge')->nullable(); // "New", "Sale", "Hot"
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
