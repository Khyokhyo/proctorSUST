<?php

use Illuminate\Database\Seeder;

class PoliciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $policies = [
			[
				  'number' => '2',
				  'content' => 'new policy for new policy'	  	
			]
		];

		DB::table('policies')->insert($policies);
    }
}
