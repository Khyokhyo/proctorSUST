<?php

use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = [
			[
				  'fullname' => 'E',
				  'gender' => 'male',
				  'dept_id' => 4,
				  'post'	=> 'Associate Proffessor',
				  'email' => 'e@gmail.com',
				  'contact_no'	=> '01680890561',
				  'updated_at' => date('Y-m-d H:i:s'),
				  'created_at' => date('Y-m-d H:i:s')	
			],
		];

		DB::table('teachers')->insert($teachers);	
    }
}
