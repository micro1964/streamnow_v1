<?php

use Illuminate\Database\Seeder;

class AddedCommonUrlInSettings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('settings')->insert([
    		[
		        'key' => 'cross_platform_url',
		        'value' => "104.236.1.170:1935",
		    ]
		]);
    }
}
