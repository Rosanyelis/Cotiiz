<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bussines_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('rfc_prueba_id')->nullable()->after('rfc_bussines_id');
            $table->foreign('rfc_prueba_id')->references('id')->on('rfc_pruebas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('bussines_requests', function (Blueprint $table) {
            $table->dropForeign(['rfc_prueba_id']);
            $table->dropColumn('rfc_prueba_id');
        });
    }
};
