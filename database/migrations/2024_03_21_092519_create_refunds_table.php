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
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('type');
            $table->timestamp('date');
            $table->morphs('origin');
            $table->foreignId('warehouse_id')->nullable()->constrained();
            $table->foreignId('client_id')->nullable()->constrained();
            $table->string('number');
            $table->timestamps();
        });

        Schema::create('refund_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refund_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_products');
        Schema::dropIfExists('refunds');
    }
};
