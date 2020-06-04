<?php

use Illuminate\Database\Seeder;

use App\Helpers\AppJwt;

use App\Helpers\Helper;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('users')) {
            
            DB::table('users')->where('email' ,'user@streamnow.com')->delete();
    		DB::table('users')->where('email' ,'test@streamnow.com')->delete();
    	}

    	DB::table('users')->insert([
    		[
		        'name' => 'User',
		        'email' => 'user@streamnow.com',
		        'password' => \Hash::make('123456'),
		        'picture' =>"https://live.appswamy.com/images/default-profile.jpg",
                'chat_picture'=>"https://live.appswamy.com/images/default-profile.jpg",
		        'is_verified' => 1,
		        'user_type' => 1,
                'status' => 1,
		        'push_status' => 1,
                'is_content_creator'=>1,
                'role' => 'model',
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],
            [
                'name' => 'TEST',
                'email' => 'test@streamnow.com',
                'password' => \Hash::make('123456'),
                'picture' =>"https://live.appswamy.com/images/default-profile.jpg",
                'chat_picture'=>"https://live.appswamy.com/images/default-profile.jpg",
                'is_verified' => 1,
                'is_content_creator'=>0,
                'user_type' => 1,
                'status' => 1,
                'push_status' => 1,
                'role' => 'model',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
		
        ]);

        if($user_1 = User::where('email' , 'user@streamnow.com')->first()) {

            $user_1->token = Helper::generate_token();

            $user_1->token_expiry = Helper::generate_token_expiry();
            
            $user_1->save();
        }

        if($user_2 = User::where('email' , 'test@streamnow.com')->first()) {

            $user_2->token = Helper::generate_token();

            $user_2->token_expiry = Helper::generate_token_expiry();

            $user_2->save();
        }

    }
}
