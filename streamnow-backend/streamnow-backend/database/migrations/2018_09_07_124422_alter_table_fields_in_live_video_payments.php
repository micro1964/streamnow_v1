<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableFieldsInLiveVideoPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('live_video_payments', function (Blueprint $table) {
            DB::statement("ALTER TABLE `live_video_payments` CHANGE `live_video_amount` `live_video_amount` DOUBLE NOT NULL");
            DB::statement("ALTER TABLE `live_video_payments` CHANGE `coupon_amount` `coupon_amount` DOUBLE NOT NULL");
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
            //
        });
    }
}
