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
        Schema::create('product_variation_price', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('variant_id')->constrained('variations');
            $table->foreignId('variation_option_id')->constrained('variation_options');
            $table->double('price')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('sku')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variation_price', function (Blueprint $table) {
            //
        });
    }
};
