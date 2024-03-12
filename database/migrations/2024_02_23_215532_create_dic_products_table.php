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
        Schema::create('dic_products', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('name');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('measure_id')->constrained();
            $table->foreignId('country_id')->constrained();
            $table->string('barcode')->nullable()->unique();
            $table->date('expiry_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dic_products');
    }
};
