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
        Schema::create('purchases_history_headers', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('year')->index();
            $table->tinyInteger('month')->unsigned()->index();
            $table->unsignedInteger('amount_purchase');
            $table->decimal('total_purchase', 10, 2)->unsigned()->index();
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
        Schema::dropIfExists('purchases_history_headers');
    }
};
