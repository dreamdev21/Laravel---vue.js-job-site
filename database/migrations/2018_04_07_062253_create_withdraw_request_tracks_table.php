<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawRequestTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_request_tracks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('withdrawal_id');
            $table->string('gateway_type')->default('paypal');
            $table->string('remote_identifier')->unique();
            $table->timestamps();

            $table->foreign('withdrawal_id')->references('id')->on('withdrawals')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraw_request_tracks');
    }
}
