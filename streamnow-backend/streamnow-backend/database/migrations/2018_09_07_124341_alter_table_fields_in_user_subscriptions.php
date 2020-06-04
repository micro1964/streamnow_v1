<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFieldsInUserSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_subscritpions', function (Blueprint $table) {
            DB::statement("ALTER TABLE `user_subscriptions` CHANGE `subscription_amount` `subscription_amount` DOUBLE NOT NULL");
            DB::statement("ALTER TABLE `user_subscriptions` CHANGE `coupon_amount` `coupon_amount` DOUBLE NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_subscritpions', function (Blueprint $table) {
            //
        });
    }
}
