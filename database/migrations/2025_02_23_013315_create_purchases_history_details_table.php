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
        Schema::create('purchases_history_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchases_history_header_id')->constrained('purchases_history_headers')->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            $table->unsignedSmallInteger('amount_product')->default(1);
            $table->foreignId('unit_product_id')->constrained('units')->onDelete('cascade');
            $table->decimal('sub_total_product', 10, 2)->index();

            $table->boolean('enabled')->default(true)->index();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['purchases_history_header_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases_history_details');
    }
};
