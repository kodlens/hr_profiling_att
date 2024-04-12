<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InstituteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data = [
            [
                'code' => 'ICS',
                'institute' => 'Institute of Computer Studies',
                'active' => 1
            ],
            [
                'code' => 'IBFS',
                'institute' => 'Institute of Business and Finance Services',
                'active' => 1
            ],
            [
                'code' => 'ICJE',
                'institute' => 'Institute of Criminal Justice Education',
                'active' => 1
            ],
            [
                'code' => 'IOM',
                'institute' => 'Institute of Midwifery',
                'active' => 1
            ],
           
        ];

        \App\Models\Institute::insertOrIgnore($data);

    }
}
