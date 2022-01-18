<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class studentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'name'=>'testdata',
            'email_id'=>'testdata@gmail.com',
            'phone_no'=>'9090876789'
        ]);
    }
}
