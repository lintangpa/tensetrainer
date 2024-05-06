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
        $ceritaContent = $this->questContent1;
        $questions = $this->questions1();
        $timertotal = 300;
        return view('user.pastContinuousQuiz.pastContinuous1', compact('ceritaContent', 'questions', 'timertotal'));
    }

    public function quest2()
    {
        $nilaiKarma = $this->getKarma();
        $ceritaContent = $this->questContent2;
        $questions = $this->questions2($nilaiKarma);
        $timertotal = 300;
        return view('user.pastContinuousQuiz.pastContinuous2', compact('ceritaContent', 'questions', 'timertotal'));
    }

    public function quest3()
    {
        $ceritaContent = $this->questContent3;
        $questions = $this->questions3();
        $timertotal = 300;
        return view('user.pastContinuousQuiz.pastContinuous3', compact('ceritaContent', 'questions', 'timertotal'));
    }

    protected $questContent1 = [
        "The following day, Adelsten was practicing in the front yard",
        "The selection exam was getting closer",
        "Suddenly, Fred came to Adelsten's house.",
    ];

    protected $questContent2 = [
        "During the training session with Fred.",
        "Adelsten was impressing him with his highly skilled magic.",
        "Fred was curious to know the secret behind Adelsten's proficiency",
    ];

    protected $questContent3 = [
        "BOOM!! BLAMM!!",
        "The magic sound produced by Fred was very loud",
        "Fred was very impressed with his own magic.",
        "Fred was very happy with the results of his training.",
        "Adelsten and Fred were very ready to take the selection exam tomorrow.",
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

    protected function questions2($nilaiKarma)
    {
        if ($nilaiKarma > 5) {
            return ([
                [
                    'question' => "Wow Adelsten, where were you learning control like that?",
                    'draggableWords' => ["Rose", "was", "giving", "me", "advice.", "gives", "gave", "is"],
                    'correctAnswer' => ["Rose", "was", "giving", "me", "advice."],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredAngry.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
                [
                    'question' => "Tell me too!",
                    'draggableWords' => ["I", "couldn't be", "telling", "you.", "wasn't", "won't be"],
                    'correctAnswer' => ["I", "couldn't", "be", "telling", "you."],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredAngry.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
            ]
            );
        } else {
            return ([
                [
                    'question' => "Wow Adelsten, where were you learning control like that?",
                    'draggableWords' => ["Rose", "was", "giving", "me", "advice.", "gives", "gave", "is"],
                    'correctAnswer' => ["Rose", "was", "giving", "me", "advice."],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredAngry.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
                [
                    'question' => "Tell me too, please!",
                    'draggableWords' => ["I", "was", "feeling", "the", "flow", "of", "chi", "within", "me.", "felt", "feel"],
                    'correctAnswer' => ["I", "was", "feeling", "the", "flow", "of", "chi", "within", "me."],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredSad.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
                [
                    'question' => "Ah, like that, try practicing it again while I watch",
                    'draggableWords' => ["Were", "you", "ready", "now?", "Are"],
                    'correctAnswer' => ["Were", "you", "ready", "now?"],
                    'imagePath' => asset('image/chara/Fred.png'),
                    'imageWrong' => asset('image/chara/FredSad.png'),
                    'imageCorrect' => asset('image/chara/FredSmile.png'),
                ],
            ]
            );
        }
    }

    protected function questions3()
    {
        return ([
            [
                'question' => "Adelsten, were you seeing that? It was very cool",
                'draggableWords' => ["You", "were", "looking", "very", "different", "compared", "to", "yesterday", "looked", "look"],
                'correctAnswer' => ["You", "were", "looking", "very", "different", "compared", "to", "yesterday"],
                'imagePath' =>  asset('image/chara/Fred.png'),
                'imageWrong' =>  asset('image/chara/FredAngry.png'),
                'imageCorrect' =>  asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "Yes, I was feeling the same way. It's all thanks to you, Adelsten",
                'draggableWords' => ["Were", "you", "bringing", "the", "book", "we", "borrowed", "from", "the", "library", "yesterday?"],
                'correctAnswer' => ["Were", "you", "bringing", "the", "book", "we", "borrowed", "from", "the", "library", "yesterday?"],
                'imagePath' =>  asset('image/chara/Fred.png'),
                'imageWrong' =>  asset('image/chara/FredAngry.png'),
                'imageCorrect' =>  asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "Yes, of course, here is the book",
                'draggableWords' => ["I", "was", "wanting", "to", "read", "the", "book", "while", "you", "were", "training", "wanted", "want"],
                'correctAnswer' => ["I", "was", "wanting", "to", "read", "the", "book", "while", "you", "were", "training"],
                'imagePath' =>  asset('image/chara/Fred.png'),
                'imageWrong' =>  asset('image/chara/FredAngry.png'),
                'imageCorrect' =>  asset('image/chara/FredSmile.png'),
            ],
        ]
        );
    }
}
