<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveGroupMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_group_members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('live_group_id');
            $table->integer('owner_id');
            $table->integer('member_id');
            $table->integer('status');
            $table->string('reason');
            $table->string('added_by');
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
        Schema::drop('live_group_members');
    }
}
