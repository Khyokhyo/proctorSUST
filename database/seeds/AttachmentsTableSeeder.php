<?php

use Illuminate\Database\Seeder;

class AttachmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $attachments = [
            [
                  'name' => 'details',
                  'link' => 'E:\details.pdf'    
            ]
        ];

        DB::table('attachments')->insert($attachments);
    }
}
