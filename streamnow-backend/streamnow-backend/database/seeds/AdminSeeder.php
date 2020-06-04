<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('admins')) {
            
            DB::table('admins')->where('email' ,'admin@streamnow.com')->delete();
            DB::table('admins')->where('email' ,'test@streamnow.com')->delete();
        }

        DB::table('admins')->insert([
    		[
		        'name' => 'Admin',
		        'email' => 'admin@streamnow.com',
		        'password' => \Hash::make('123456'),
		        'picture' =>"https://live.appswamy.com/images/default-profile.jpg",
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s')
		    ],

            [
                'name' => 'Test',
                'email' => 'test@streamnow.com',
                'password' => \Hash::make('123456'),
                'picture' =>"https://live.appswamy.com/images/default-profile.jpg",
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
		]);
    }
}
