<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
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
                'event_title' => 'HUDYAKA',
                'content' => 'Greetings from the Light of the World! ?
                    Please be informed that ALL Employee are REQUIRED to attend. We are the sponsor of the event.',
                'event_datetime' => '2023-09-22 15:00:00',
                'img_path' => 'gbeDdXVEl7nljb93hFvE4vVc2pA8jhzqH9ChDqHe.jpg'
            ],

            [
                'event_title' => 'Monthly Mass',
                'content' => '<p><strong>Announcement All Employee.</strong></p><p><br></p><p><br></p><p>We will have a monthly mass this afternoon. All students are required to attend.</p>',
                'event_datetime' => '2023-09-22 15:00:00',
                'img_path' => 'T6qZYwDpIdOmhDkLvkFUTPV306j7DsoL18ieCxTG.jpg'
            ],

        ];

        \App\Models\Event::insertOrIgnore($data);

    }
}
