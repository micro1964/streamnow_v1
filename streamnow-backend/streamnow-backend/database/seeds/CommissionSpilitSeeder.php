<?php

use Illuminate\Database\Seeder;

class CommissionSpilitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasTable('settings')) {

            DB::table('settings')->where('key' , 'admin_commission')->delete();

            DB::table('settings')->where('key' , 'user_commission')->delete();

        }
        DB::table('settings')->insert([
    		[
		        'key' => 'admin_commission',
		        'value' => 10
		    ],

		    [
		        'key' => 'user_commission',
		        'value' => 90
		    ],
		]);
    }
}
