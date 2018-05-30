<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIssueTypeIdToProjectQuestionTesterAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_question_tester_answers', function($table){
            $table->unsignedInteger('issue_type_id')->nullable()->default(null);
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
        Schema::table('project_question_tester_answers', function($table){
            $table->dropForeign('project_question_tester_answers_issue_type_id_foreign');
            $table->dropColumn('issue_type_id');
        });
    }
}
