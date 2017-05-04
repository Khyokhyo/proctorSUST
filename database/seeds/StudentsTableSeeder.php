<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = [
			[
				  'fullname' => 'Ara',
				  'reg_no' => '2012331024',
				  'gender' => 'female',
				  'dept_id' => 3,
				  'session'	=> '2012-13',
				  'email' => 'ara.24@gmail.com',
				  'contact_no'	=> '01686056913',
				  'updated_at' => date('Y-m-d H:i:s'),
				  'created_at' => date('Y-m-d H:i:s')	
			],
		];

		DB::table('students')->insert($students);
    }
}
