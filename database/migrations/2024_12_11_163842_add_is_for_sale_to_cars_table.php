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
    Schema::table('cars', function (Blueprint $table) {
        $table->boolean('is_for_sale')->default(0); // Add the is_for_sale column
    });
}

public function down()
{
    Schema::table('cars', function (Blueprint $table) {
        $table->dropColumn('is_for_sale');
    });
}

};