<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPublishTimeInVodVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vod_videos', function (Blueprint $table) {
            $table->datetime('publish_time')->after('user_amount');
            $table->tinyInteger('publish_status')->after('publish_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vod_videos', function (Blueprint $table) {
            $table->dropColumn('publish_time');
            $table->dropColumn('publish_status');
        });
    }
}
