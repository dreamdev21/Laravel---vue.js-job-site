<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->float('first_project_per_tester_charge')->comment('per tester charge for first project');
            $table->float('regular_per_tester_charge')->comment('regular per tester charge');
            $table->integer('discount_after_number_of_tester')->nullable()->default(0);
            $table->tinyInteger('discount_type')->nullable()->default(null)->comment('1 = percentage, 2 = direct amount');
            $table->float('discount_amount')->nullable()->default(null)->comment('it can be direct amount or percentage');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
