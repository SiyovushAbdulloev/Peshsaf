<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->morphs('model');
            $table->foreignId('outlet_id')->constrained();
            $table->string('number');
            $table->date('date');
            $table->timestamps();
        });

        Schema::create('movement_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movement_id')->constrained();
            $table->foreignId('product_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movement_products');
        Schema::dropIfExists('movements');
    }
};
