<?php

use Illuminate\Database\Seeder;

class SettingsAngularURLAndEmailVerify extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	if(Schema::hasTable('settings')) {
            
    		DB::table('settings')->where('key' ,'email_verify_control')->delete();
    		DB::table('settings')->where('key','ANGULAR_URL')->delete();
    	}

    	DB::table('settings')->insert([
    		[
		        'key' => 'email_verify_control',
		        'value' => 1
		    ],
		    [
		        'key' => 'ANGULAR_URL',
		        'value' => ""
		    ],
		]);
    }
}
