<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCouponFieldsInPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->tinyInteger('is_coupon_applied')->after('status');
            $table->string('coupon_code')->after('is_coupon_applied');
            $table->tinyInteger('coupon_amount')->after('coupon_code');
            $table->tinyInteger('subscription_amount')->after('coupon_amount')->commit('Subcription Amount');
            $table->text('coupon_reason')->after('subscription_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            $table->dropColumn('is_coupon_applied');
            $table->dropColumn('coupon_code');
            $table->dropColumn('coupon_amount');
            $table->dropColumn('subscription_amount');
            $table->dropColumn('coupon_reason');
        });
    }
}
