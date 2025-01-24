<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsTestToBussinesRequestsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bussines_requests', function (Blueprint $table) {
            $table->boolean('is_test')->default(false)->after('type_solicitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('bussines_requests', function (Blueprint $table) {
            $table->dropColumn('is_test');
        });
    }
}
