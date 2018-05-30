<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_question_tester_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_question_id')->unsigned();
            $table->integer('tester_id')->unsigned();
            $table->text('answer')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('project_question_id')->references('id')->on('project_questions')->onDelete('CASCADE');
            $table->foreign('tester_id')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_question_tester_answers');
    }
}
