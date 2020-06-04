<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('token');
            $table->string('token_expiry');
            $table->integer('user_type')->defaut(0)->comment('0 - UnPaid User, 1 - Paid User');
            $table->string('picture');
            $table->string('social_unique_id');
            $table->enum('gender',array('male','female','others'));
            $table->string('description');
            $table->string('mobile');
            $table->string('dob');
            $table->integer('age');
            $table->string('address');
            $table->double('latitude', 15, 8);
            $table->double('longitude',15,8);
            $table->enum('device_type',array('web','android','ios'));
            $table->enum('register_type',array('web','android','ios'));            
            $table->enum('login_by',array('manual','facebook','google','twitter' , 'linkedin', 'others'));
            $table->string('payment_mode');
            $table->integer('card_id'); 
            $table->integer('is_verified')->comment="1 - verified , 0 - No";
            $table->integer('status')->comment="1 - Approve , 0 - decline";
            $table->string('timezone');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
