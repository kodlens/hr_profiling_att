<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EngagementStatusSeeder extends Seeder
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
                'engagement_status' => 'JOB ORDER',
            ],
            [
                'engagement_status' => 'PERMANENT',
            ],
            [
                'engagement_status' => 'CONTRACT OF SERVICE',
            ],
            [
                'engagement_status' => 'PROJECT BASE',
            ],
        ];

        \App\Models\EngagementStatus::insertOrIgnore($data);
    }
}
