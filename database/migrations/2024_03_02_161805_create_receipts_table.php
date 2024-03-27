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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('number');
            $table->date('date');
            $table->foreignId('supplier_id')->constrained();
            $table->foreignId('warehouse_id')->constrained();
            $table->string('filepath')->nullable();
            $table->timestamps();
        });

        Schema::create('receipt_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dic_product_id')->constrained();
            $table->foreignId('receipt_id')->constrained();
            $table->string('count')->nullable()->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_products');
        Schema::dropIfExists('receipts');
    }
};
