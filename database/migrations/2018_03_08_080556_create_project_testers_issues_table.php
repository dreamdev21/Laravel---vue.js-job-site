<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTestersIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_testers_issues', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('project_tester_id');
            $table->unsignedInteger('issue_type_id');
            $table->string('description')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('project_tester_id')->references('id')->on('project_testers')->onDelete('cascade');
            $table->foreign('issue_type_id')->references('id')->on('issue_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_testers_issues');
    }
}
