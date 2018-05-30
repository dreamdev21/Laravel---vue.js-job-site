<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropProjectTesterIssuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('project_tester_issues');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_tester_issues', function(BluePrint $table){
            $table->increments('id');
            $table->integer('project_tester_id')->unsigned();
            $table->integer('issue_type_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('project_tester_id')->references('id')->on('project_testers')->onDelete('CASCADE');
            $table->foreign('issue_type_id')->references('id')->on('issue_types')->onDelete('CASCADE');
        });
    }
}
