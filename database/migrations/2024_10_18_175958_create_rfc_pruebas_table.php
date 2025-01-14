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
        Schema::create('rfc_pruebas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_fantasy');
            $table->string('phone')->nullable();
            $table->string('street')->nullable();
            $table->string('street_number')->nullable();
            $table->string('colony')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('municipality')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rfc_pruebas');
    }
};
