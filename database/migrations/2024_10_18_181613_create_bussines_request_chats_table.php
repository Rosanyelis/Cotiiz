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
        Schema::create('bussines_request_chats', function (Blueprint $table) {
            $table->id();

            // Relaciones con las claves foráneas
            $table->foreignId('rfc_bussines_id')
                ->constrained('rfc_bussines')
                ->onDelete('cascade'); // Si se elimina la empresa, se eliminan los chats relacionados

            $table->foreignId('bussines_request_id')
                ->constrained('bussines_requests')
                ->onDelete('cascade'); // Si se elimina la solicitud, se eliminan los chats relacionados

            $table->foreignId('bussines_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null'); // Si se elimina el usuario, se pone en null

            $table->foreignId('user_admin_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null'); // Si se elimina el administrador, se pone en null

            // Campos adicionales
            $table->string('message');
            $table->string('file')->nullable();
            $table->string('name_file')->nullable();
            $table->enum('status', ['Leido', 'No Leido'])->default('No Leido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bussines_request_chats');
    }
};
