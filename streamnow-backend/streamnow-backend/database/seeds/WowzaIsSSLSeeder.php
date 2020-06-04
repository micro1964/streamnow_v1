<?php

use Illuminate\Database\Seeder;

class WowzaIsSSLSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         //
        DB::table('settings')->insert([
    		[
		        'key' => 'wowza_is_ssl',
		        'value' => 1
		    ],
		]);
    }
}
