<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVodVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vod_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id');
            $table->integer('user_id');
            $table->string('title');
            $table->text('description');
            $table->string('image');
            $table->string('video');
            $table->string('created_by');
            $table->tinyInteger('is_pay_per_view');
            $table->tinyInteger('type_of_user')->default(0);
            $table->tinyInteger('type_of_subscription')->default(0);
            $table->float('amount')->default(0);
            $table->float('admin_amount')->default(0);
            $table->float('user_amount')->default(0);
            $table->tinyInteger('viewer_count')->default(0);
            $table->tinyInteger('admin_status')->default(0);
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vod_videos');
    }
}
