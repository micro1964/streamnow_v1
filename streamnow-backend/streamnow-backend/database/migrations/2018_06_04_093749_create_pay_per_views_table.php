<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayPerViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_per_views', function (Blueprint $table) {
            $table->increments('id')->comment('Primary Key, It is an unique key');
            $table->integer('user_id')->unsigned()->comment('User table Primary key given as Foreign Key');
            $table->integer('video_id')->unsigned()->comment('VOD Video table Primary key given as Foreign Key');
            $table->string('payment_id');
            $table->string('type_of_subscription');
            $table->string('type_of_user');
            $table->float('amount');
            $table->float('admin_amount');
            $table->float('user_amount');
            $table->string('payment_mode', 8);
            $table->dateTime('expiry_date');
            $table->dateTime('ppv_date');
            $table->text('reason');
            $table->tinyInteger('is_watched')->default(0);
            $table->smallInteger('status')->default(0)->comment('Status of the per_per_view table');
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
        Schema::drop('pay_per_views');
    }
}
