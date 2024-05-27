<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use OpenAI;
use OpenAI\Client;

class PresentContinuousController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $notifications = [];
        if (is_string($user->progress)) {
            $userProgress = json_decode($user->progress, true);
        } else {
            $userProgress = $user->progress;
        }
        $achievements = Achievement::all();

        foreach ($achievements as $achievement) {
            if ($user->achievement && array_key_exists($achievement->nama, $user->achievement)) {
                continue;
            }
            $requirement = json_decode($achievement->requirement, true);

            if ($this->isAchievementRequirementsMet($achievement, $userProgress)) {
                $this->storeAchievement($user, $achievement->nama);
                $notifications[] = $achievement->nama;
            }
        }
        return view('user.presentContinuousQuiz.presentContinuousHome', compact('notifications', 'userProgress'));
    }

    private function isAchievementRequirementsMet($achievement, $userProgress)
    {
        $requirement = json_decode($achievement->requirement, true);

        foreach ($requirement as $tense => $quests) {
            foreach ($quests as $quest => $requiredProgress) {
                if (!isset($userProgress[$tense][$quest]) || $userProgress[$tense][$quest] < $requiredProgress) {
                    return false;
                }
            }
        }

        return true;
    }

    private function storeAchievement(User $user, $achievementName)
    {

        $achievements = $user->achievement ?: [];
        $achievements[$achievementName] = true;
        $user->update(['achievement' => $achievements]);
    }

    public function getKarma()
    {
        $user = Auth::user();
        $progress = $user->progress;
        $nilaiKarma = $progress['karma'];
        return $nilaiKarma;
    }

    public function quest1()
    {
        $namaStory = 'questcontent2q1';
        $namaQuest = 'questions2q1';
        $story = DB::table('konten')->where('nama', $namaStory)->first();
        $ceritaContent = json_decode($story->content, true);
        $quest = DB::table('konten')->where('nama', $namaQuest)->first();
        $questions = json_decode($quest->content, true);
        $timertotal = 360;
        return view('user.presentContinuousQuiz.presentContinuous1', compact('ceritaContent', 'questions' ,'timertotal'));
    }

    public function quest2()
    {
        $namaStory = 'questcontent2q2';
        $namaQuest = 'questions2q2';
        $story = DB::table('konten')->where('nama', $namaStory)->first();
        $ceritaContent = json_decode($story->content, true);
        $quest = DB::table('konten')->where('nama', $namaQuest)->first();
        $questions = json_decode($quest->content, true);
        $timertotal = 360;
        return view('user.presentContinuousQuiz.presentContinuous2', compact('ceritaContent', 'questions', 'timertotal'));
    }

    public function quest3()
    {
        $namaStory = 'questcontent2q3';
        $namaQuest = 'questions2q3';
        $story = DB::table('konten')->where('nama', $namaStory)->first();
        $ceritaContent = json_decode($story->content, true);
        $quest = DB::table('konten')->where('nama', $namaQuest)->first();
        $questions = json_decode($quest->content, true);
        $timertotal = 360;
        return view('user.presentContinuousQuiz.presentContinuous3', compact('ceritaContent', 'questions', 'timertotal'));
    }
}
