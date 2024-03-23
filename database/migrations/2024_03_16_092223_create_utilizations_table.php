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
        Schema::create('utilizations', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('outlet');
            $table->string('status');
            $table->morphs('model');
            $table->string('number');
            $table->date('date');
            $table->foreignId('client_id')->nullable()->constrained();
            $table->foreignId('outlet_id')->nullable()->constrained();
            $table->timestamps();
        });

        Schema::create('utilization_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilization_id')->constrained();
            $table->foreignId('product_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilization_products');
        Schema::dropIfExists('utilizations');
    }
};
