<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVideoPaymentAmountToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->float('total')->after('status');
            $table->float('total_admin_amount')->after('total');
            $table->float('total_user_amount')->after('total_admin_amount');
            $table->float('paid_amount')->after('total_user_amount');
            $table->float('remaining_amount')->after('paid_amount');
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
            $table->dropColumn('total');
            $table->dropColumn('total_admin_amount');
            $table->dropColumn('total_user_amount');
            $table->dropColumn('paid_amount');
            $table->dropColumn('remaining_amount');
        });
    }
}
