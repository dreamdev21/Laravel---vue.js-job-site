<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsersDetailsColumnsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->string('first_name')->nullable()->default(null);
            $table->string('middle_name')->nullable()->default(null);
            $table->string('last_name')->nullable()->default(null);
            $table->string('mobile_no', 12)->nullable()->default(null);
            $table->date('date_of_birth')->nullable()->default(null);
            $table->string('gender')->nullable()->default(null);
            $table->text('address')->nullable()->default(null);
            $table->string('city')->nullable()->default(null);
            $table->string('country')->nullable()->default(null);
            $table->integer('pin_code')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table){
            $table->dropColumn(['first_name', 'middle_name', 'last_name', 'mobile_no', 'date_of_birth', 'gender', 'address', 'city', 'country', 'pin_code']);
        });
    }
}
