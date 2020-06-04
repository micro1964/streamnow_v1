<?php

use Illuminate\Database\Seeder;

class AddedRTMPKeyInsettings extends Seeder
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
		        'key' => 'mobile_rtmp',
		        'value' => "",
		    ],
		]);

        
    }
}
