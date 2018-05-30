<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('invoice_id');
            $table->unsignedInteger('payer_id')->nullable()->default(null);
            $table->string('gateway')->nullable()->default(null);
            $table->string('transaction_id')->nullable()->default(null);
            $table->string('paypal_payer_id')->nullable()->default(null);
            $table->string('sell_id')->nullable()->default(null);
            $table->boolean('is_paid')->default(false);
            $table->dateTime('paid_on')->nullable()->default(null);
            $table->float('total_amount')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('payer_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
