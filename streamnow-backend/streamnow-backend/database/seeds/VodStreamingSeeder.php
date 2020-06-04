<?php

use Illuminate\Database\Seeder;

class VodStreamingSeeder extends Seeder
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
		        'key' => 'RTMP_STREAMING_URL',
		        'value' => ""
		    ],

		    [
		        'key' => 'HLS_STREAMING_URL',
		        'value' => ""
		    ],
		    [
		        'key' => 'RTMP_SECURE_VIDEO_URL',
		        'value' => ""
		    ],
		    [
		        'key' => 'HLS_SECURE_VIDEO_URL',
		        'value' => ""
		    ],

		    [
		        'key' => 'VIDEO_SMIL_URL',
		        'value' => ""
		    ]
		]);
    }
}
