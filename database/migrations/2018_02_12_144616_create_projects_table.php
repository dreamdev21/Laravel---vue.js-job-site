<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('publisher_id')->unsigned()->nullable();
            $table->string('project_description')->nullable()->default(null);
            $table->integer('project_type_id')->unsigned()->nullable();
            $table->float('amount')->nullable()->default(null);
            $table->string('estimate_tester_time')->nullable()->default(null);
            $table->date('start_date')->nullable()->default(null);
            $table->integer('tester_needed')->nullable()->default(null);
            $table->date('end_date')->nullable()->default(null);
            $table->text('notes_instruction')->nullable()->default(null);
            $table->boolean('is_test_project')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('publisher_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('project_type_id')->references('id')->on('project_types')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
