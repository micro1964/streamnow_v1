<?php

use Illuminate\Database\Seeder;

class VodCommissionSplitSeeder extends Seeder
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
		        'key' => 'admin_vod_commission',
		        'value' => 10
		    ],

		    [
		        'key' => 'user_vod_commission',
		        'value' => 90
		    ],
		]);
    }
}
