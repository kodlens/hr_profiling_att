<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
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
                'education_level' => 'ELEMENTARY',
            ],
            [
                'education_level' => 'SECONDARY',
            ],
            [
                'education_level' => 'COLLEGE/DEGREE',
            ],
            [
                'education_level' => 'MASTERS',
            ],
            [
                'education_level' => 'DOCTORATE',
            ],
            
           
        ];

        \App\Models\EducationLevel::insertOrIgnore($data);
    }
}
