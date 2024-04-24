<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            [
                'name' => 'Lintang P',
                'email' => 'lintang2505@gmail.com',
                'password' => Hash::make('wonagoliku'),
                'progress' => [
                    "karma" => 0,
                    "simple_present" => [
                        "quest_1" => 0,
                        "quest_2" => 0,
                        "quest_3" => 0,
                        "quest_4" => 0
                    ],
                    "present_continuous" => [
                        "quest_1" => 0,
                        "quest_2" => 0,
                        "quest_3" => 0,
                        "quest_4" => 0
                    ],
                    "simple_past" => [
                        "quest_1" => 0,
                        "quest_2" => 0,
                        "quest_3" => 0,
                        "quest_4" => 0
                    ],
                    "past_continuous" => [
                        "quest_1" => 0,
                        "quest_2" => 0,
                        "quest_3" => 0,
                        "quest_4" => 0
                    ],
                    "simple_future" => [
                        "quest_1" => 0,
                        "quest_2" => 0,
                        "quest_3" => 0,
                        "quest_4" => 0
                    ]
                ]
            ]
        );
    }
}
