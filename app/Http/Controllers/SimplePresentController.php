<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;

class SimplePresentController extends Controller
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
            if ($this->isAchievementUnlocked($user, $achievement)) {
                continue;
            }

            if ($this->isAchievementRequirementsMet($achievement, $userProgress)) {
                $this->storeAchievement($user, $achievement->nama);
                $notifications[] = $achievement->nama;
            }
        }
        return view('user.simplePresentQuiz.simplepresenthome', compact('notifications', 'userProgress', 'achievement'));
    }

    private function isAchievementUnlocked($user, $achievement)
    {
        return $user->achievement && array_key_exists($achievement->nama, $user->achievement);
    }

    private function isAchievementRequirementsMet($achievement, $userProgress)
    {
        $requirement = json_decode($achievement->requirement, true);

        foreach ($requirement['simple_present'] as $quest => $requiredProgress) {
            if ($userProgress['simple_present'][$quest] < $requiredProgress) {
                return false;
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

    public function quest1()
    {
        return view('user.simplePresentQuiz.simplepresent1');
    }

    public function quest2()
    {
        return view('user.simplePresentQuiz.simplepresent2');
    }

    public function quest3()
    {
        return view('user.simplePresentQuiz.simplepresent3');
    }
}
