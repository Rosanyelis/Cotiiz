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
        Schema::create('professionals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('rfc_suppliers_id')->constrained('rfc_suppliers')->onDelete('cascade');
            $table->foreignId('occupation_id')->constrained('occupations')->onDelete('cascade');
            $table->foreignId('specialty_id')->constrained('specialties')->onDelete('cascade');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('second_name')->nullable();
            $table->string('second_lastname')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('file_title_trainee_1')->nullable(); // titulo o carta de pasante
            $table->string('file_title_trainee_2')->nullable(); // titulo o carta de pasante
            $table->string('file_cv')->nullable();
            $table->string('file_voter_idcard_1')->nullable(); // foto delantera
            $table->string('file_voter_idcard_2')->nullable(); // reverso
            $table->string('file_photo')->nullable(); // selfie
            $table->enum('status', ['Aprobado', 'Rechazado', 'Pendiente'])->default('Pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionals');
    }
};
