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
        Schema::create('bussine_request_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bussines_request_id')->constrained('bussines_requests')->onDelete('cascade');
            $table->string('product_name');
            $table->string('model')->nullable();
            $table->string('brand')->nullable();
            $table->string('quantity')->nullable();
            $table->string('budget')->nullable();
            $table->string('urgency')->nullable();
            $table->string('description')->nullable();
            $table->string('link_drive')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bussine_request_products');
    }
};
