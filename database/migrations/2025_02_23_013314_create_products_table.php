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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->text('description')->nullable();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->foreignId('category_id')->constrained("categories")->onDelete('cascade');
            $table->foreignId('place_id')->constrained("places")->onDelete('cascade');
            $table->foreignId('status_id')->constrained('product_statuses')->onDelete('cascade')->nullable();
            $table->text('observation')->nullable();
            $table->string('image')->nullable();
            $table->boolean('enabled')->default(true)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
