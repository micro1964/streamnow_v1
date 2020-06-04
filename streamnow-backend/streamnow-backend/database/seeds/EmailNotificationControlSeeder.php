<?php

use Illuminate\Database\Seeder;

class EmailNotificationControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('settings')) {
    		DB::table('settings')->where('key' , 'email_notification')->delete();
    	}

    	DB::table('settings')->insert([
    		[
		        'key' => 'email_notification',
		        'value' => 1
		    ]
		]);
    }
}
