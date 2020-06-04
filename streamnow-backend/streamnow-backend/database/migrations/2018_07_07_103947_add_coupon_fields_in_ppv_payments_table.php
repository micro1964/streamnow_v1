<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCouponFieldsInPpvPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pay_per_views', function (Blueprint $table) {
            $table->tinyInteger('is_coupon_applied')->after('status');
            $table->string('coupon_code')->after('is_coupon_applied');
            $table->tinyInteger('coupon_amount')->after('coupon_code');
            $table->tinyInteger('ppv_amount')->after('coupon_amount')->commit('Pay per view Amount');
            $table->text('coupon_reason')->after('ppv_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pay_per_views', function (Blueprint $table) {
            $table->dropColumn('is_coupon_applied');
            $table->dropColumn('coupon_code');
            $table->dropColumn('coupon_amount');
            $table->dropColumn('ppv_amount');
            $table->dropColumn('coupon_reason');
        });
    }
}
