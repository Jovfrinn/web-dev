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
        Schema::create('checkout_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checkout_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); 
            $table->decimal('quantity', 12, 2);
            $table->decimal('price', 12, 2);
            $table->decimal('sub_total', 12, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout_details');
    }
};
