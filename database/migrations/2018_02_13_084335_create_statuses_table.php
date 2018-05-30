<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('reason')->nullable();
            $table->morphs('model');
            $table->integer('action_by')->unsigned()->nullable()->default(null);
            $table->timestamps();
            $table->foreign('action_by')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
