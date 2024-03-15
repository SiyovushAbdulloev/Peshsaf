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
        Schema::table('dic_products', function (Blueprint $table) {
            $table->foreignId('active_ingredient_id')->constrained('active_ingredients');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dic_products', function (Blueprint $table) {
           $table->dropForeign('dic_products_active_ingredient_id_foreign');
           $table->dropColumn('active_ingredient_id');
        });
    }
};
