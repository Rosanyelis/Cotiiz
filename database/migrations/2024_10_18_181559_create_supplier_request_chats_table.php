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
        Schema::create('supplier_request_chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rfc_suppliers_id')->constrained('rfc_suppliers')->onDelete('cascade');
            $table->foreignId('supplier_request_id')->constrained('supplier_requests')->onDelete('cascade');
            $table->foreignId('supplier_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('user_admin_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('message');
            $table->string('file')->nullable();
            $table->enum('status', ['Leido', 'No Leido'])->default('No Leido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_request_chats');
    }
};
