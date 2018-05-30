<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratables', function (Blueprint $table) {
            $table->unsignedInteger('rating_id');
            $table->morphs('ratable');
            $table->timestamps();
            $table->foreign('rating_id')->references('id')->on('ratings')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratables');
    }
}
