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
        Schema::create('bussines_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('rfc_bussines_id')->constrained('rfc_bussines')->onDelete('cascade');
            $table->string('type');
            $table->enum('status', ['Solicitando', 'En proceso', 'Aprobado', 'Rechazado', 'Contestada', 'Examinada'])->default('Solicitando');
            $table->string('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bussines_requests');
    }
};
