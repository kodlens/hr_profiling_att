<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DegreeSeeder extends Seeder
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
                'level' => 'ELEMENTARY',
                'degree_program' => 'GRADE 1',
                'active' => 1
            ],
            [
                'level' => 'ELEMENTARY',
                'degree_program' => 'GRADE 2',
                'active' => 1
            ],
            [
                'level' => 'ELEMENTARY',
                'degree_program' => 'GRADE 3',
                'active' => 1
            ],
            [
                'level' => 'ELEMENTARY',
                'degree_program' => 'GRADE 4',
                'active' => 1
            ],
            [
                'level' => 'ELEMENTARY',
                'degree_program' => 'GRADE 5',
                'active' => 1
            ],
            [
                'level' => 'ELEMENTARY',
                'degree_program' => 'GRADE 6',
                'active' => 1
            ],


            //
            [
                'level' => 'SECONDARY',
                'degree_program' => '1ST YEAR',
                'active' => 1
            ],
            [
                'level' => 'SECONDARY',
                'degree_program' => '2ND YEAR',
                'active' => 1
            ],
            [
                'level' => 'SECONDARY',
                'degree_program' => '3RD YEAR',
                'active' => 1
            ],
            [
                'level' => 'SECONDARY',
                'degree_program' => '4TH YEAR',
                'active' => 1
            ],
            [
                'level' => 'SECONDARY',
                'degree_program' => 'GRADE 11',
                'active' => 1
            ],
            [
                'level' => 'SECONDARY',
                'degree_program' => 'GRADE 12',
                'active' => 1
            ],



            //vocational
            [
                'level' => 'VOCATIONAL/TRADE COURSE',
                'degree_program' => 'AUTOMOTIVE',
                'active' => 1
            ],
            [
                'level' => 'VOCATIONAL/TRADE COURSE',
                'degree_program' => 'COOKING',
                'active' => 1
            ],
            [
                'level' => 'VOCATIONAL/TRADE COURSE',
                'degree_program' => 'RADIO/TV ELECTRONICS REPAIR',
                'active' => 1
            ],
            [
                'level' => 'VOCATIONAL/TRADE COURSE',
                'degree_program' => 'COMPUTER REPAIR',
                'active' => 1
            ],
            [
                'level' => 'VOCATIONAL/TRADE COURSE',
                'degree_program' => 'ELECTRICAL',
                'active' => 1
            ],




            //college
            [
                'level' => 'COLLEGE',
                'degree_program' => 'BACHELOR OF SCIENCE IN COMPUTER SCIENCE',
                'active' => 1
            ],
            [
                'level' => 'COLLEGE',
                'degree_program' => 'BACHELOR OF SCIENCE IN HOTEL AND RESTAURANT MANAGEMENT',
                'active' => 1
            ],
            [
                'level' => 'COLLEGE',
                'degree_program' => 'BACHELOR OF SCIENCE IN INFORMATION TECHNOLOGY',
                'active' => 1
            ],
            [
                'level' => 'COLLEGE',
                'degree_program' => 'BACHELOR OF SCIENCE IN CRIMINOLOGY',
                'active' => 1
            ],
            [
                'level' => 'COLLEGE',
                'degree_program' => 'BACHELOR OF SCIENCE IN BUSINESS ADMINISTRATION',
                'active' => 1
            ],
            [
                'level' => 'COLLEGE',
                'degree_program' => 'BACHELOR OF SCIENCE IN OFFICE ADMINISTRATION',
                'active' => 1
            ],



            //graduate studies

            [
                'level' => 'GRADUATE STUDIES',
                'degree_program' => 'MASTERS IN COMPUTER SCIENCE',
                'active' => 1
            ],
            [
                'level' => 'GRADUATE STUDIES',
                'degree_program' => 'MASTERS IN SCIENCE IN COMPUTER SCIENCE',
                'active' => 1
            ],
            [
                'level' => 'GRADUATE STUDIES',
                'degree_program' => 'MASTERS IN INFORMATION TECHNOLOGY',
                'active' => 1
            ],
            [
                'level' => 'GRADUATE STUDIES',
                'degree_program' => 'MASTERS IN SCIENCE IN INFORMATION TECHNOLOGY',
                'active' => 1
            ],
            [
                'level' => 'GRADUATE STUDIES',
                'degree_program' => 'DOCTOR IN PHILOSOPY',
                'active' => 1
            ],
           
        ];

        \App\Models\Degree::insertOrIgnore($data);

    }
}
