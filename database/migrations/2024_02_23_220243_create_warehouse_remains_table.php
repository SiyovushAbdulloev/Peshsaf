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
        Schema::create('warehouse_remains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained();
            $table->foreignId('dic_product_id')->constrained();
            $table->timestamps();
        });

        Schema::create('warehouse_remain_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_remain_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_remain_products');
        Schema::dropIfExists('warehouse_remains');
    }
};
