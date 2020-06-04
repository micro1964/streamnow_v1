<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubscriptionFieldsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->float('amount_paid')->defined(0);
            $table->dateTime('expiry_date')->nullable();
            $table->integer('no_of_days')->defined(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('amount_paid');
            $table->dropColumn('expiry_date');
            $table->dropColumn('no_of_days');
        });
    }
}
