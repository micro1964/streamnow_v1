<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id');
            $table->integer('user_id');
            $table->string('virtual_id');
            $table->string('type', 64)->nullable()->comment('Public, Private');
            $table->integer('payment_status')->default(0)->commen('0 - No, 1 - Yes');
            $table->float('amount')->default(0);
            $table->integer('is_streaming')->default(0);
            $table->integer('status')->default(0);
            $table->softDeletes();
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
        Schema::drop('live_videos');
    }
}
