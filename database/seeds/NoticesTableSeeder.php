<?php

use Illuminate\Database\Seeder;

class NoticesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $notices = [
			[
				  'sender_id' => '16',
				  'subject' => 'Entertainment',
				  'category'	=> 'public',
				  'content' => 'onekkichuonekkichuonekkichuonekkic huonekkichuone kkichuonekkichuonekkichu',
				  'dop'	=> '2017-01-23'	  	
			]
		];

		DB::table('notices')->insert($notices);
    }
}
