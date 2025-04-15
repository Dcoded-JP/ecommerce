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
        Schema::create('i_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('sku')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->string('category_id')->nullable();
            $table->json('color_id');
            $table->json('size_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('i_products');
    }
};
