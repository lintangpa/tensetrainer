<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            if ($this->isAchievementUnlocked($user, $achievement)) {
                continue;
            }

            if ($this->isAchievementRequirementsMet($achievement, $userProgress)) {
                $this->storeAchievement($user, $achievement->nama);
                $notifications[] = $achievement->nama;
            }
        }
        return view('user.simpleFutureQuiz.simpleFutureHome', compact('notifications', 'userProgress', 'achievement'));
    }

    private function isAchievementUnlocked($user, $achievement)
    {
        return $user->achievement && array_key_exists($achievement->nama, $user->achievement);
    }

    private function isAchievementRequirementsMet($achievement, $userProgress)
    {
        $requirement = json_decode($achievement->requirement, true);

        foreach ($requirement['simple_future'] as $quest => $requiredProgress) {
            if ($userProgress['simple_future'][$quest] < $requiredProgress) {
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
        // dump($questions);
        return view('user.simpleFutureQuiz.simpleFuture1', compact('ceritaContent', 'questions'));
    }

    public function quest2()
    {
        $ceritaContent = $this->questContent2;
        $questions = $this->questions2();
        return view('user.simpleFutureQuiz.simpleFuture2', compact('ceritaContent', 'questions'));
    }

    public function quest3()
    {
        return view('user.simpleFutureQuiz.simpleFuture3');
    }

    protected $questContent1 = [
        "All participants are gathering at the Academy today to take the selection exam.",
        "Adelsten was impressing him with his highly skilled magic Including Fred and Adelsten, who are also at the academy",
        "Everyone is called to proceed one by one.",
        "The exam consists of practice and interview. How will Adelsten face this?",
        "Upon arriving in the room...",
    ];

    protected $questContent2 = [
        "Adelsten continues his examination.",
        "Now is the time for Adelsten to take the practical exam.",
        "Will Adelsten be able to take the practical exam smoothly later?",
    ];

    protected function questions1($nilaiKarma)
    {
        if ($nilaiKarma > 4) {
            return ([
                [
                    'question' => "So, what are your plans if you become a level 3 wizard?",
                    'draggableWords' => ["I", "still", "haven't", "thought", "about", "the", "future", "don't"],
                    'correctAnswer' => ["I", "still", "haven't", "thought", "about", "the", "future"],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredAngry.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
                [
                    'question' => "Hmm okay",
                    'draggableWords' => ["Will", "I", "be", "passing", "the", "oral", "exam,", "ma'am?", "pass"],
                    'correctAnswer' => ["Will", "I", "be", "passing", "the", "oral", "exam,", "ma'am?"],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredAngry.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
                [
                    'question' => "We'll see later, for now you can leave the room and continue with the practical exam",
                    'draggableWords' => ["Okay,", "I'll", "leave", "the", "room", "and", "continue", "with", "the", "practical", "exam", "leaving"],
                    'correctAnswer' => ["Okay,", "I'll", "leave", "the", "room", "and", "continue", "with", "the", "practical", "exam"],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredAngry.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
            ]);
        } else {
            return ([
                [
                    'question' => "So, what are your plans if you become a level 3 wizard?",
                    'draggableWords' => ["I", "will", "be", "helping", "others", "across", "the", "country,", "ma'am", "help"],
                    'correctAnswer' => ["I", "will", "be", "helping", "others", "across", "the", "country,", "ma'am"],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredAngry.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
                [
                    'question' => "Is there anything else?",
                    'draggableWords' => ["I", "will", "be", "starting", "my", "adventure", "from", "tomorrow", "started", "start"],
                    'correctAnswer' => ["I", "will", "be", "starting", "my", "adventure", "from", "tomorrow"],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredSad.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
                [
                    'question' => "Well done. For now you can leave the room and continue with the practical exam",
                    'draggableWords' => ["I", "will", "also", "be", "gathering", "new", "magic", "while", "I", "am", "on", "my", "adventure"],
                    'correctAnswer' => ["I", "will", "also", "be", "gathering", "new", "magic", "while", "I", "am", "on", "my", "adventure"],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredSad.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
            ]);
        }
    }

    protected function questions2()
    {
        return ([
            [
                'question' => "Adelsten, step forward and please show me your best magic!",
                'draggableWords' => ["Alright", "sir,", "I", "will", "show", "you", "a", "magic", "of", "flower", "arrangement", "showed", "showing"],
                'correctAnswer' => ["Alright", "sir,", "I", "will", "show", "you", "a", "magic", "of", "flower", "arrangement"],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "Why are you showing that magic?",
                'draggableWords' => ["I", "will", "spread", "joy", "around", "the", "world,", "sir.", "spreading"],
                'correctAnswer' => ["I", "will", "spread", "joy", "around", "the", "world,", "sir."],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "Very noble, but can you also perform attack magic?",
                'draggableWords' => ["Yes,", "I", "will", "perform", "fire", "magic", "performing", "performed"],
                'correctAnswer' => ["Yes,", "I", "will", "perform", "fire", "magic"],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
        ]);
    }
}
