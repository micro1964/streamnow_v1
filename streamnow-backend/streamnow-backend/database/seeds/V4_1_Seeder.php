<?php

use Illuminate\Database\Seeder;

class V4_1_Seeder extends Seeder
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
		        'key' => 'demo_users',
		        'value' => 'user@streamnow.com,viewer@streamnow.com,streamer@streamnow.com'
		    ]
		]);

        DB::table('settings')->insert([
            [
                'key' => 'is_multilanguage_enabled',
                'value' => 1
            ],
        ]);

        DB::table('languages')->delete();

        DB::table('languages')->insert([
            [
                'folder_name' => 'en',
                'language' => 'English',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
