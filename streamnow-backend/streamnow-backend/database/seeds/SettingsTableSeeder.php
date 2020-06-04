<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();
    	DB::table('settings')->insert([
    		[
		        'key' => 'site_name',
		        'value' => 'StreamNow'
		    ],
		    [
		        'key' => 'site_logo',
		        'value' => 'https://live.appswamy.com/site_logo.png'
		    ],
		    [
		        'key' => 'site_icon',
		        'value' => 'https://live.appswamy.com/site_icon.png'
		    ],
		    [
		        'key' => 'browser_key',
		        'value' => ''
		    ],
		    [
		        'key' => 'default_lang',
		        'value' => 'en'
		    ], 
		    [
		        'key' => 'currency',
		        'value' => '$'
		    ],
		    [
        		'key' => 'admin_take_count',
        		'value' => 12
        	],
		    [
		        'key' => 'google_analytics',
		        'value' => ""
		    ],
		    [
		        'key' => 'ios_certificate',
		        'value' => ""
		    ],
		    [
	            'key' => 'admin_delete_control',
			    'value' => 0       	
			],
			[
		        'key' => 'is_subscription',
		        'value' => 1
		    ],
		    [
		        'key' => 'push_notification',
		        'value' => 1
		    ]
		]);
    }
}
