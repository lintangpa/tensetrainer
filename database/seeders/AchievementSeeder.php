<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementSeeder extends Seeder
{
    public function run()
    {
        Achievement::create([
            'nama' => 'Master of Simple Present Tense',
            'deskripsi' => 'Master all quests in Simple Present Tense',
            'requirement' => json_encode([
                'simple_present' => [
                    'quest_3' => 1
                ]
            ]),
            'icon' => '',
        ]);
    }
}

