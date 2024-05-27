<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SimpleFutureController extends Controller
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
        return view('user.simpleFutureQuiz.simpleFutureHome', compact('notifications', 'userProgress'));
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
        $nilaiKarma = $this->getKarma();
        $namaStory = 'questcontent5q1';
        $namaQuest = 'questions5q1';
        $namaQuestK = 'questions5q1k';
        $story = DB::table('konten')->where('nama', $namaStory)->first();
        $ceritaContent = json_decode($story->content, true);
        if ($nilaiKarma > 5) {
            $quest = DB::table('konten')->where('nama', $namaQuestK)->first();
            $questions = json_decode($quest->content, true);
        } else {
            $quest = DB::table('konten')->where('nama', $namaQuest)->first();
            $questions = json_decode($quest->content, true);
        }
        return view('user.simpleFutureQuiz.simpleFuture1', compact('ceritaContent', 'questions', 'timertotal'));
    }

    public function quest2()
    {
        $namaStory = 'questcontent5q2';
        $namaQuest = 'questions5q2';
        $story = DB::table('konten')->where('nama', $namaStory)->first();
        $ceritaContent = json_decode($story->content, true);
        $quest = DB::table('konten')->where('nama', $namaQuest)->first();
        $questions = json_decode($quest->content, true);
        $timertotal = 240;
        return view('user.simpleFutureQuiz.simpleFuture2', compact('ceritaContent', 'questions', 'timertotal'));
    }

    public function quest3()
    {
        $nilaiKarma = $this->getKarma();
        $namaStory = 'questcontent5q3';
        $namaQuest = 'questions5q3';
        $namaEnding = 'ending';
        $namaEndingK = 'endingk';
        $story = DB::table('konten')->where('nama', $namaStory)->first();
        $ceritaContent = json_decode($story->content, true);
        $quest = DB::table('konten')->where('nama', $namaQuest)->first();
        $questions = json_decode($quest->content, true);
        if ($nilaiKarma > 5) {
            $quest = DB::table('konten')->where('nama', $namaEndingK)->first();
            $endingContent = json_decode($quest->content, true);
        } else {
            $quest = DB::table('konten')->where('nama', $namaEnding)->first();
            $endingContent = json_decode($quest->content, true);
        }
        $timertotal = 240;
        return view('user.simpleFutureQuiz.simpleFuture3', compact('ceritaContent', 'questions', 'timertotal', 'endingContent'));
    }
}
