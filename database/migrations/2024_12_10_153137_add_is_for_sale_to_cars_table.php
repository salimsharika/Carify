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
        $table->boolean('is_for_sale')->default(false)->after('date_of_purchase'); // Add column with default value
    });
}

public function down()
{
    Schema::table('cars', function (Blueprint $table) {
        $table->dropColumn('is_for_sale'); // Rollback the column if needed
    });
}

};
