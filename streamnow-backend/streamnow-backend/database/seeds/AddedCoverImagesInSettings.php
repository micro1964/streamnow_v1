<?php

use Illuminate\Database\Seeder;

class AddedCoverImagesInSettings extends Seeder
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
		        'key' => 'home_bg_image',
		        'value' => "https://live.appswamy.com/live-now.webm",
		    ],
		    [
		        'key' => 'common_bg_image',
		        'value' => "https://live.appswamy.com/background_picture.jpg",
		    ]
		]);
    }
}
