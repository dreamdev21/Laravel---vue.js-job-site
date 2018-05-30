<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCostFieldsToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['amount']);
            $table->float('cost_per_tester')->nullable()->default(null);
            $table->integer('allocated_tester')->nullable()->default(null);
            $table->float('total_cost')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['cost_per_tester', 'allocated_tester', 'total_cost']);
            $table->float('amount')->nullable()->default(null);
        });
    }
}
