<?php

use Illuminate\Database\Seeder;

class WowzaIpAddress extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('settings')) {

            DB::table('settings')->where('key' , 'wowza_ip_address')->delete();

        }
        
        DB::table('settings')->insert([
    		[
		        'key' => 'wowza_ip_address',
		        'value' => ''
		    ],
		]);
    }
}
