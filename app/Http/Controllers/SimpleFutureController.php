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
        $timertotal = 240;
        // dump($questions);
        return view('user.simpleFutureQuiz.simpleFuture1', compact('ceritaContent', 'questions', 'timertotal'));
    }

    public function quest2()
    {
        $ceritaContent = $this->questContent2;
        $questions = $this->questions2();
        $timertotal = 240;
        return view('user.simpleFutureQuiz.simpleFuture2', compact('ceritaContent', 'questions', 'timertotal'));
    }

    public function quest3()
    {
        $nilaiKarma = $this->getKarma();
        $ceritaContent = $this->questContent3;
        $endingContent = $this->ending($nilaiKarma);
        $questions = $this->questions3();
        $timertotal = 240;
        return view('user.simpleFutureQuiz.simpleFuture3', compact('ceritaContent', 'questions', 'timertotal', 'endingContent'));
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

    protected $questContent3 = [
        "After Adelsten shows his fire magic",
        "he will leave the room and meet Fred in the academy's courtyard",
        "They will discuss their future plans.",
    ];


    protected function questions1($nilaiKarma)
    {
        if ($nilaiKarma > 4) {
            return ([
                [
                    'question' => "So, what are your plans if you become a level 3 wizard?",
                    'draggableWords' => ["I", "still", "haven't", "thought", "about", "the", "future", "don't"],
                    'correctAnswer' => ["I", "still", "haven't", "thought", "about", "the", "future"],
                    'imagePath' => asset('image/chara/elsker.png'),
                    'imageWrong' => asset('image/chara/elskerAngry.png'),
                    'imageCorrect' => asset('image/chara/elskerSmile.png'),
                ],
                [
                    'question' => "Hmm okay",
                    'draggableWords' => ["Will", "I", "be", "passing", "the", "oral", "exam,", "ma'am?", "pass"],
                    'correctAnswer' => ["Will", "I", "be", "passing", "the", "oral", "exam,", "ma'am?"],
                    'imagePath' => asset('image/chara/elsker.png'),
                    'imageWrong' => asset('image/chara/elskerAngry.png'),
                    'imageCorrect' => asset('image/chara/elskerSmile.png'),
                ],
                [
                    'question' => "We'll see later, for now you can leave the room and continue with the practical exam",
                    'draggableWords' => ["Okay,", "I'll", "leave", "the", "room", "and", "continue", "with", "the", "practical", "exam", "leaving"],
                    'correctAnswer' => ["Okay,", "I'll", "leave", "the", "room", "and", "continue", "with", "the", "practical", "exam"],
                    'imagePath' => asset('image/chara/elsker.png'),
                    'imageWrong' => asset('image/chara/elskerAngry.png'),
                    'imageCorrect' => asset('image/chara/elskerSmile.png'),
                ],
            ]);
        } else {
            return ([
                [
                    'question' => "So, what are your plans if you become a level 3 wizard?",
                    'draggableWords' => ["I", "will", "be", "helping", "others", "across", "the", "country,", "ma'am", "help"],
                    'correctAnswer' => ["I", "will", "be", "helping", "others", "across", "the", "country,", "ma'am"],
                    'imagePath' => asset('image/chara/elsker.png'),
                    'imageWrong' => asset('image/chara/elskerAngry.png'),
                    'imageCorrect' => asset('image/chara/elskerSmile.png'),
                ],
                [
                    'question' => "Is there anything else?",
                    'draggableWords' => ["I", "will", "be", "starting", "my", "adventure", "from", "tomorrow", "started", "start"],
                    'correctAnswer' => ["I", "will", "be", "starting", "my", "adventure", "from", "tomorrow"],
                    'imagePath' => asset('image/chara/elsker.png'),
                    'imageWrong' => asset('image/chara/elskerAngry.png'),
                    'imageCorrect' => asset('image/chara/elskerSmile.png'),
                ],
                [
                    'question' => "Well done. For now you can leave the room and continue with the practical exam",
                    'draggableWords' => ["I", "will", "also", "be", "gathering", "new", "magic", "while", "I", "am", "on", "my", "adventure"],
                    'correctAnswer' => ["I", "will", "also", "be", "gathering", "new", "magic", "while", "I", "am", "on", "my", "adventure"],
                    'imagePath' => asset('image/chara/elsker.png'),
                    'imageWrong' => asset('image/chara/elskerAngry.png'),
                    'imageCorrect' => asset('image/chara/elskerSmile.png'),
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
                'imagePath' => asset('image/chara/vinde.png'),
                'imageWrong' => asset('image/chara/vindeAngry.png'),
                'imageCorrect' => asset('image/chara/vindeSmile.png'),
            ],
            [
                'question' => "Why are you showing that magic?",
                'draggableWords' => ["I", "will", "spread", "joy", "around", "the", "world,", "sir.", "spreading"],
                'correctAnswer' => ["I", "will", "spread", "joy", "around", "the", "world,", "sir."],
                'imagePath' => asset('image/chara/vinde.png'),
                'imageWrong' => asset('image/chara/vindeAngry.png'),
                'imageCorrect' => asset('image/chara/vindeSmile.png'),
            ],
            [
                'question' => "Very noble, but can you also perform attack magic?",
                'draggableWords' => ["Yes,", "I", "will", "perform", "fire", "magic", "performing", "performed"],
                'correctAnswer' => ["Yes,", "I", "will", "perform", "fire", "magic"],
                'imagePath' => asset('image/chara/vinde.png'),
                'imageWrong' => asset('image/chara/vindeAngry.png'),
                'imageCorrect' => asset('image/chara/vindeSmile.png'),
            ],
        ]);
    }

    protected function questions3()
    {
        return ([
            [
                'question' => "Adelsten, did you finish your exam?",
                'draggableWords' => ["Yes,", "I", "think", "I'll", "pass", "the", "exam.","thought",],
                'correctAnswer' => ["Yes,", "I", "think", "I'll", "pass", "the", "exam."],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "What your plans after this, Adelsten?",
                'draggableWords' => ["I", "will", "help", "people", "around", "me", "while", "waiting", "for", "the", "exam", "results.", "helped","be"],
                'correctAnswer' => ["I", "will", "help", "people", "around", "me", "while", "waiting", "for", "the", "exam", "results."],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "Wow, you will indeed be very kind, Adelsten.",
                'draggableWords' => ["I", "will", "become", "a", "kind", "witch."],
                'correctAnswer' => ["I", "will", "become", "a", "kind", "witch."],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
        ]);
    }

    protected function ending($nilaiKarma)
    {
        if ($nilaiKarma > 5) {
            return ([
                "Three weeks later, they will receive the announcement letter of the selection exam results.",
                "A total of 18 participants will be declared passed in the Class 3 Wizard Selection Exam",
                "But among the 18 participants, only Fred will be there.",
                "Adelsten will not be declared passed the selection.",
                "Adelsten will have to retake it next year.",
            ]);
        } else {
            return ([
                "Three weeks later, they will receive the announcement letter of the selection exam results.",
                "A total of 18 participants will be declared passed in the Class 3 Wizard Selection Exam",
                "Including Adelsten and Fred, both of whom will be declared passed",
                "Fred will join the adventure guild and continue exploring dungeons",
                "Adelsten will go explore the world and collect all the magic.",
            ]);
        }
    }
}
