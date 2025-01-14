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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('rfc_bussines_id')->nullable()->constrained('rfc_bussines')->onDelete('cascade');
            $table->foreignId('rfc_suppliers_id')->nullable()->constrained('rfc_suppliers')->onDelete('cascade');
            $table->foreignId('rfc_prueba_id')->nullable()->constrained('rfc_pruebas')->onDelete('cascade');
            $table->enum('type', ['Admin', 'Empresa', 'Proveedor', 'Prueba'])->default('Admin');
            $table->string('title');
            $table->string('message');
            $table->enum('status', ['Leido', 'No Leido'])->default('No Leido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
