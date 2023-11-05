<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                "name" => "Administrator",
                "username" => "admin",
                "password" =>  Hash::make('root'),
            ]
        ]);
        Event::insert([
            [
                'event_name' => 'Workshop Laravel X Qrcode',
                'event_description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam voluptas vero tempore ab libero iusto, voluptatem eveniet necessitatibus pariatur tempora exercitationem neque inventore cum repudiandae ratione porro illum iste deleniti.',
                'event_date' => date('Y-m-d'),
                'event_location' => 'IF UPN'
            ],
            [
                'event_name' => 'AWS S3 Cloud Service',
                'event_description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam voluptas vero tempore ab libero iusto, voluptatem eveniet necessitatibus pariatur tempora exercitationem neque inventore cum repudiandae ratione porro illum iste deleniti.',
                'event_date' => date('Y-m-12'),
                'event_location' => 'IF UPN'
            ],
            [
                'event_name' => 'Laravel Deployment',
                'event_description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam voluptas vero tempore ab libero iusto, voluptatem eveniet necessitatibus pariatur tempora exercitationem neque inventore cum repudiandae ratione porro illum iste deleniti.',
                'event_date' => date('Y-m-10'),
                'event_location' => 'IF UPN'
            ],
            [
                'event_name' => 'CodeIgniter RestAPI',
                'event_description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam voluptas vero tempore ab libero iusto, voluptatem eveniet necessitatibus pariatur tempora exercitationem neque inventore cum repudiandae ratione porro illum iste deleniti.',
                'event_date' => date('Y-m-2'),
                'event_location' => 'IF UPN'
            ],
            [
                'event_name' => 'Node JS & Express JS',
                'event_description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nam voluptas vero tempore ab libero iusto, voluptatem eveniet necessitatibus pariatur tempora exercitationem neque inventore cum repudiandae ratione porro illum iste deleniti.',
                'event_date' => date('Y-m-28'),
                'event_location' => 'IF UPN'
            ],
        ]);

        Participant::insert($this->generateParticipants(100));
    }

    private function generateParticipants($iteration)
    {
        $participants = [];

        for ($i = 0; $i < $iteration; $i++) {
            $participants[] = [
                'event_id' => rand(1, 5),
                'name' => fake()->name(),
                'phone' => '6281' . fake()->randomNumber(5, true),
                'email' => fake()->unique()->safeEmail(),
                'address' => fake()->address(),
                'uniq_code' => $this->generateUniqCode($i),
            ];
        }

        return $participants;
    }

    private function generateUniqCode($i)
    {
        return md5(env('APP_NAME') . $i);
    }
}
