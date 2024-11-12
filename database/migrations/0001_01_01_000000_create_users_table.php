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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['admin', 'provider', 'business', 'provider-operador', 'business-operador'])->default('admin');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->enum('status', ['0', '1', '2'])->default('0'); // 0 = pendiente, 1 = aprobado, 2 = bloqueado
            $table->timestamps();
        });

        # type hace referencia al tipo de usuario que se registro
        # admin = administrador
        # provider = proveedor Usuario principal solo si se registra por primera vez
        # business = bussines Usuario principal solo si se registra por primera vez
        # provider-operador = proveedor operador solo si busca el rfc o name de proveedor
        # business-operador = bussines operador solo si busca el rfc o name de bussines

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
