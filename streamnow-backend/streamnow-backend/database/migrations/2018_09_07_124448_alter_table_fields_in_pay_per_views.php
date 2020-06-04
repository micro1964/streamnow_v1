<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFieldsInPayPerViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pay_per_views', function (Blueprint $table) {
            DB::statement("ALTER TABLE `pay_per_views` CHANGE `ppv_amount` `ppv_amount` DOUBLE NOT NULL ");
            DB::statement("ALTER TABLE `pay_per_views` CHANGE `coupon_amount` `coupon_amount` DOUBLE NOT NULL");
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
            //
        });
    }
}
