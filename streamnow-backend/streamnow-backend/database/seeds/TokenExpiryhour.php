<?php

use Illuminate\Database\Seeder;

class TokenExpiryhour extends Seeder
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
		        'key' => 'token_expiry_hour',
		        'value' =>1
		    ],
		]);
    }
}
