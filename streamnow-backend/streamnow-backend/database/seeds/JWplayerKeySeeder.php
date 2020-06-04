<?php

use Illuminate\Database\Seeder;

class JWplayerKeySeeder extends Seeder
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
		        'key' => 'jwplayer_key',
		        'value' => ''
		    ],

		]);
    }
}
