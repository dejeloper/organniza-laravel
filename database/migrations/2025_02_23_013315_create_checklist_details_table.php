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
        Schema::create('checklist_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checklist_header_id')->constrained('checklist_headers')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('pantry_amount_product');
            $table->foreignId('pantry_unit_product')->constrained('units')->onDelete('cascade');
            $table->integer('required_amount_product');
            $table->foreignId('required_unit_product')->constrained('units')->onDelete('cascade');
            $table->boolean('enabled')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checklist_details');
    }
};
