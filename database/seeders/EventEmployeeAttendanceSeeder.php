<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventEmployeeAttendanceSeeder extends Seeder
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
                'event_id' => 1,
                'user_id' => 4,
                'img_description' => 'sample description of the image',
                'img_path' => 'Um0RYniXZfYl0Phcp2x5R5hQDyjZGZvaviPKjGth.png',
                'attendance_status' => 0
            ],
            [
                'event_id' => 1,
                'user_id' => 5,
                'img_description' => 'sample description of the image',
                'img_path' => 'JbR31WvvDJYeTL8aUtbL2aEwmfMF0GNO7q4SurNH.jpg',
                'attendance_status' => 0
            ],
            [
                'event_id' => 1,
                'user_id' => 6,
                'img_description' => 'sample description of the image',
                'img_path' => 'Um0RYniXZfYl0Phcp2x5R5hQDyjZGZvaviPKjGth.png',
                'attendance_status' => 0
            ],
            [
                'event_id' => 1,
                'user_id' => 7,
                'img_description' => 'sample description of the image',
                'img_path' => 'Um0RYniXZfYl0Phcp2x5R5hQDyjZGZvaviPKjGth.png',
                'attendance_status' => 0
            ],
            [
                'event_id' => 1,
                'user_id' => 8,
                'img_description' => 'sample description of the image',
                'img_path' => 'JbR31WvvDJYeTL8aUtbL2aEwmfMF0GNO7q4SurNH.jpg',
                'attendance_status' => 0
            ],
            [
                'event_id' => 1,
                'user_id' => 9,
                'img_description' => 'sample description of the image',
                'img_path' => 'Um0RYniXZfYl0Phcp2x5R5hQDyjZGZvaviPKjGth.png',
                'attendance_status' => 0
            ],

            
            
            [
                'event_id' => 2,
                'user_id' => 10,
                'img_description' => 'sample description of the image',
                'img_path' => 'Um0RYniXZfYl0Phcp2x5R5hQDyjZGZvaviPKjGth.png',
                'attendance_status' => 0
            ],
            [
                'event_id' => 2,
                'user_id' => 11,
                'img_description' => 'sample description of the image',
                'img_path' => 'Um0RYniXZfYl0Phcp2x5R5hQDyjZGZvaviPKjGth.png',
                'attendance_status' => 0
            ],
            [
                'event_id' => 2,
                'user_id' => 12,
                'img_description' => 'sample description of the image',
                'img_path' => 'Um0RYniXZfYl0Phcp2x5R5hQDyjZGZvaviPKjGth.png',
                'attendance_status' => 0
            ],
            [
                'event_id' => 2,
                'user_id' => 13,
                'img_description' => 'sample description of the image',
                'img_path' => 'Um0RYniXZfYl0Phcp2x5R5hQDyjZGZvaviPKjGth.png',
                'attendance_status' => 0
            ],
            [
                'event_id' => 2,
                'user_id' => 14,
                'img_description' => 'sample description of the image',
                'img_path' => 'Um0RYniXZfYl0Phcp2x5R5hQDyjZGZvaviPKjGth.png',
                'attendance_status' => 0
            ],

        ];

        \App\Models\EventEmployeeAttendance::insertOrIgnore($data);


    }
}
