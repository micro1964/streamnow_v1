<?php

use Illuminate\Database\Seeder;

class UrlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('settings')) {

            DB::table('settings')->where('key' , 'SOCKET_URL')->delete();

            DB::table('settings')->where('key' , 'BASE_URL')->delete();

        }
        
        DB::table('settings')->insert([
    		[
		        'key' => 'SOCKET_URL',
		        'value' => ""
		    ],
		    [
		        'key' => 'BASE_URL',
		        'value' => "/"
		    ]
		]);
    }
}
