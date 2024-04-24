<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PastContinuousController extends Controller
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
        return view('user.pastContinuousQuiz.pastContinuousHome', compact('notifications', 'userProgress', 'achievement'));
    }

    private function isAchievementUnlocked($user, $achievement)
    {
        return $user->achievement && array_key_exists($achievement->nama, $user->achievement);
    }

    private function isAchievementRequirementsMet($achievement, $userProgress)
    {
        $requirement = json_decode($achievement->requirement, true);

        foreach ($requirement['past_continuous'] as $quest => $requiredProgress) {
            if ($userProgress['past_continuous'][$quest] < $requiredProgress) {
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
        $ceritaContent = $this->questContent1;
        $questions = $this->questions1($nilaiKarma);
        return view('user.pastContinuousQuiz.pastContinuous1',compact('ceritaContent', 'questions'));
    }

    public function quest2()
    {
        return view('user.pastContinuousQuiz.pastContinuous2');
    }

    public function quest3()
    {
        return view('user.pastContinuousQuiz.pastContinuous3');
    }

    protected $questContent1 = [
        "The following day, Adelsten was practicing in the front yard",
        "The selection exam was getting closer",
        "Suddenly, Fred came to Adelsten's house.",
    ];

    protected function questions1()
    {
        return ([
            [
                'question' => "Hello, Adelsten, were you practicing?",
                'draggableWords' => ["Fred!", "You", "were", "coming", "here.", "are", "come", "came"],
                'correctAnswer' => ["Fred!", "You", "were", "coming", "here."],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "Yes! I wanted to practice with you. Were you not at home yesterday?",
                'draggableWords' => ["Yesterday,", "I", "was", "at", "the", "park", "and", "I", "was", "meeting", "Rose.", "meet", "met", "being", "am"],
                'correctAnswer' => ["Yesterday,", "I", "was", "at", "the", "park", "and", "I", "was", "meeting", "Rose."],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "That's why, when I was doing physical training yesterday, you weren't seen practicing in your front yard. Was Rose also taking the selection exam this year?",
                'draggableWords' => ["Unfortunately,", "she", "wasn't", "taking", "the", "selection", "exam", "this", "year.", "didn't", "take"],
                'correctAnswer' => ["Unfortunately,", "she", "wasn't", "taking", "the", "selection", "exam", "this", "year."],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "why she wasn't taking the selection exam this year?",
                'draggableWords' => ["Her", "mother", "was", "sick", "for", "a", "week.", "is"],
                'correctAnswer' => ["Her", "mother", "was", "sick", "for", "a", "week."],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
        ]);
    }
}
