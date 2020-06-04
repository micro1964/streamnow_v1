<?php

use Illuminate\Database\Seeder;

class AddedSocketKeyInSettings extends Seeder
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
		        'key' => 'kurento_socket_url',
		        'value' => "livetest.streamhash.info:8443",
		    ],
		]);
    }
}
