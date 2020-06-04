<?php

use Illuminate\Database\Seeder;

class AdminDemoLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('settings')) {

            DB::table('settings')->where('key' , 'admin_demo_email')->delete();

            DB::table('settings')->where('key' , 'admin_demo_password')->delete();

        }
        
        DB::table('settings')->insert([
    		[
		        'key' => 'admin_demo_email',
		        'value' => 'admin@streamnow.com'
		    ],

		    [
		        'key' => 'admin_demo_password',
		        'value' => '123456'
		    ],
		]);
    }
}
