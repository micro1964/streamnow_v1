<?php

use Illuminate\Database\Seeder;

class LiveVideoDeleteSeeder extends Seeder
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
		        'key' => 'delete_video',
		        'value' => 0
		    ],
		]);
    }
}
