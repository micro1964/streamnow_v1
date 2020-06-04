<?php

use Illuminate\Database\Seeder;

class AddedServerUrlInSettings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
    		[
		        'key' => 'wowza_server_url',
		        'value' => "https://104.236.1.170:8087",
		    ],
		]);
    }
}
