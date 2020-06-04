<?php

use Illuminate\Database\Seeder;

class ChatUrlSettings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if(Schema::hasTable('settings')) {

            DB::table('settings')->where('key' , 'chat_socket_url')->delete();

            DB::table('settings')->where('key' , 'chat_socket_url')->delete();

        }
        DB::table('settings')->insert([
    		[
		        'key' => 'chat_socket_url',
		        'value' => ''
		    ],
		]);
    }
}
