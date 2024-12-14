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
        Schema::create('bussine_request_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bussines_request_id')->constrained('bussines_requests')->onDelete('cascade');
            $table->string('service_name');
            $table->text('description')->nullable();
            $table->text('budget')->nullable();
            $table->text('description_problem')->nullable();
            $table->string('urgency')->nullable();
            $table->text('link_drive')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bussine_request_services');
    }
};
