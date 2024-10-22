<?php

namespace Database\Seeders;

use App\Models\AppointmentType;
use App\Models\Citizenship;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            CitizenshipSeeder::class,
            CivilStatusSeeder::class,
            UserSeeder::class,
            DegreeSeeder::class,
            EventSeeder::class,
            EventEmployeeAttendanceSeeder::class,
            TrainingSeminarSeeder::class,
            EngagementStatusSeeder::class,
            InstituteSeeder::class
        ]);
    }
}
