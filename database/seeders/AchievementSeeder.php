<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievements;

class AchievementSeeder extends Seeder
{
    public function run()
    {
        Achievements::create([
            'nama' => 'Master of Simple Present Tense',
            'deskripsi' => 'Master all quests in Simple Present Tense',
            'syarat' => json_encode([
                'quest_1' => 0,
                'quest_2' => 1,
                'quest_3' => 0,
                'quest_4' => 0,
            ]),
            'icon' => 'simple_present_icon.png',
            'points' => 100,
        ]);
    }
}

