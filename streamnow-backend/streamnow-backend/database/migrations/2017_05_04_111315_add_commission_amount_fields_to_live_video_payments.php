<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommissionAmountFieldsToLiveVideoPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('live_video_payments', function (Blueprint $table) {
            $table->float('admin_amount')->after('amount');
            $table->float('user_amount')->after('admin_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('live_video_payments', function (Blueprint $table) {
            $table->dropColumn('admin_amount');
            $table->dropColumn('user_amount');
        });
    }
}
