<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TrainingSeminarSeeder extends Seeder
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
                'seminar_title' => 'Data Analytics for Librarians in partnership with Nutrinet',
                'seminar_desc' => 'Data Analytics for Librarians in partnership with Nutrinet',
                'date_from' => '2023-11-15',
                'date_to' => '2023-11-15',
                'no_hours' => '4',
                'sponsored_by' => 'NATIONAL LIBRARY',
                'speaker' => 'DR. JUAN DELA CRUZ',
                'attach_path' => ''
            ],

            [
                'seminar_title' => 'Back-to-back Startup Workshop Series for Northern Mindanao Meentes',
                'seminar_desc' => '',
                'date_from' => '2023-11-16',
                'date_to' => '2023-11-16',
                'no_hours' => '4',
                'sponsored_by' => 'DICT',
                'speaker' => 'ENGR. JOHN BUENDIA',
                'attach_path' => ''
            ],

            [
                'seminar_title' => 'Educational Technology Towards New Era',
                'seminar_desc' => '',
                'date_from' => '2023-11-18',
                'date_to' => '2023-11-20',
                'no_hours' => '24',
                'sponsored_by' => 'DepEd',
                'speaker' => 'DR. SHEEN ROMEREZ, DR. SHEILA MENDEZ, DR. ASTILLERA GABO',
                'attach_path' => ''
            ],
        ];

        \App\Models\TrainingSeminar::insertOrIgnore($data);
    }
}
