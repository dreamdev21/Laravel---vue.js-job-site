<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_testers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->nullable()->default(null);
            $table->integer('tester_id')->unsigned()->nullable()->default(null);

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('CASCADE');
            $table->foreign('tester_id')->references('id')->on('users')->onDelete('CASCADE');
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
        Schema::dropIfExists('project_testers');
    }
}
