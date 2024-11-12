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
        Schema::create('rfc_bussines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_positive_opinion')->nullable();
            $table->string('file_bank_information')->nullable();
            $table->string('file_fiscal_constancy')->nullable();
            $table->string('file_fiscal_address')->nullable();
            $table->string('number_plant')->nullable();
            $table->string('positive_constancy')->nullable();
            $table->string('acceptance_letter')->nullable();
            $table->string('products_list')->nullable();
            $table->string('cashback')->nullable();
            $table->string('phone')->nullable();
            $table->string('street')->nullable();
            $table->string('street_number')->nullable();
            $table->string('colony')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('municipality')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('main_activity')->nullable();
            $table->enum('status', ['0', '1', '2'])->default('0'); // 0 = pendiente, 1 = aprobado, 2 = bloqueado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rfc_bussines');
    }
};
