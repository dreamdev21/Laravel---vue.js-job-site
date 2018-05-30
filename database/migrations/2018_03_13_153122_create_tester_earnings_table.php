<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTesterEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tester_earnings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tester_id');
            $table->unsignedInteger('project_id');
            $table->float('amount');
            $table->boolean('is_bonus')->default(false);
            $table->text('note')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('tester_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tester_earnings');
    }
}
