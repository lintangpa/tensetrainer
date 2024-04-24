<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function getKarma()
    {
        $user = Auth::user();
        $progress = $user->progress;
        $nilaiKarma = $progress['karma'];
        return $nilaiKarma;
    }

    public function quest1()
    {
        $ceritaContent = $this->questContent1;
        $questions = $this->questions1();
        return view('user.simplePresentQuiz.simplepresent1', compact('ceritaContent', 'questions'));
    }

    public function quest2()
    {
        $ceritaContent = $this->questContent2;
        $questions = $this->questions2();
        return view('user.simplePresentQuiz.simplepresent2', compact('ceritaContent', 'questions'));
    }

    public function quest3()
    {
        $ceritaContent = $this->questContent3;
        $questions = $this->questions3();
        return view('user.simplePresentQuiz.simplepresent3', compact('ceritaContent', 'questions'));
    }

    protected $questContent1 = [
        "At a renowned school in the city of Yden, a selection test for magic is being held.",
        "Fred and Adelsten are childhood friends.",
        "Because they are now 15 years old, they will take the magic selection test to prove themselves worthy of becoming a level 3 wizard. ",
        "Meanwhile, when in front of Fred's house.",
        "...",
    ];

    protected $questContent2 = [
        "The next day...",
        "Adelsten comes to Fred's house to practice together.",
        "Fred goes inside to find a basic knowledge book.",
        "After a few minutes ...",
    ];

    protected $questContent3 = [
        "Today, Adelsten goes to Fred's house again to practice together. ",
        "But, there is bad news brought by Adelsten.",
        "What bad news does Adelsten convey?",
        "...",
    ];

    protected function questions1()
    {
        return ([
            [
                'question' => "Hi, Adelsten! How are you today?",
                'draggableWords' => [
                    "Hi,", "Fred!", "I'm", "doing", "fine.", "Are", "you", "ready", "for", "the",
                    "magic", "selection", "test", "next", "week?",
                ],
                'correctAnswer' => [
                    "Hi,", "Fred!", "I'm", "doing", "fine.", "Are", "you", "ready", "for", "the",
                    "magic", "selection", "test", "next", "week?",
                ],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "Oh, yes, I have to prepare for it. How about you?",
                'draggableWords' => ["I", "practice", "practiced", "every", "day", "practicing"],
                'correctAnswer' => ["I", "practice", "every", "day"],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "How about we practice together?",
                'draggableWords' => [
                    "Great", "idea,", "when", "do", "we", "start", "practicing", "practiced",
                    "together?", "I", "am", "lazy", "to", "practice", "every", "day",
                ],
                'correctAnswer' => ["Great", "idea,", "when", "do", "we", "start", "practicing", "together?"],
                'negativeAnswer' => ["lazy"],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
        ]
        );
    }

    protected function questions2()
    {
        return (
            [
                [
                    'question' => "Adelsten, you're here",
                    'draggableWords' => [
                        "what", "are", "we", "going", "to", "learn", "today?", "Do",
                    ],
                    'correctAnswer' => [
                        "Do", "we", "learn", "today?",
                    ],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredAngry.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
                [
                    'question' => "We'll just focus on strengthening basic techniques today",
                    'draggableWords' => [
                        "That", "is", "important", "has", "been", "was",
                    ],
                    'correctAnswer' => [
                        "That", "is", "important",
                    ],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredAngry.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
                [
                    'question' => "Do you have the basic book, Adelsten?",
                    'draggableWords' => [
                        "I", "don't", "have", "it", "with", "me", "right", "now", "didn't", "won't", "haven't",
                    ],
                    'correctAnswer' => [
                        "I", "don't", "have", "it", "with", "me", "right", "now",
                    ],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredAngry.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
                [
                    'question' => "Do we start tomorrow?",
                    'draggableWords' => [
                        "Okay,", "then", "we'll", "practice", "tomorrow",
                    ],
                    'correctAnswer' => [
                        "Okay,", "then", "we'll", "practice", "tomorrow",
                    ],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredAngry.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
            ]

        );
    }

    protected function questions3()
    {
        return (
            [
                [
                    'question' => "Hello Adelsten, do you bring your book?",
                    'draggableWords' => [
                        "Sorry,", "my", "book", "is", "missing", "was", "are", "has", "isn't", "I", "forget",
                        "to", "bring", "it",
                    ],
                    'correctAnswer' => ["Sorry,", "my", "book", "is", "missing"],
                    'negativeAnswer' => ["forget"],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredAngry.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
                [
                    'question' => "No need to be sad, Adelsten, there is always a way",
                    'draggableWords' => [
                        "Do", "we", "go", "to", "the", "library?", "Does", "Do", "Are", "Will",
                    ],
                    'correctAnswer' => ["Do", "we", "go", "to", "the", "library?"],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredAngry.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
                [
                    'question' => "But I can't leave the house today, I have to clean the house because it's my routine",
                    'draggableWords' => [
                        "It's", "okay,", "We", "meet", "again", "tomorrow.", "met", "will", "meets",
                    ],
                    'correctAnswer' => ["It's", "okay,", "We", "meet", "again", "tomorrow."],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredAngry.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
            ]
        );
    }
}
