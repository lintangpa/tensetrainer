<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SimplePastController extends Controller
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
        return view('user.simplePastQuiz.simplePastHome', compact('notifications', 'userProgress', 'achievement'));
    }

    private function isAchievementUnlocked($user, $achievement)
    {
        return $user->achievement && array_key_exists($achievement->nama, $user->achievement);
    }

    private function isAchievementRequirementsMet($achievement, $userProgress)
    {
        $requirement = json_decode($achievement->requirement, true);

        foreach ($requirement['simple_past'] as $quest => $requiredProgress) {
            if ($userProgress['simple_past'][$quest] < $requiredProgress) {
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
        $timertotal = 300;
        return view('user.simplePastQuiz.simplePast1', compact('ceritaContent', 'questions', 'timertotal'));
    }

    public function quest2()
    {
        $nilaiKarma = $this->getKarma();
        $ceritaContent = $this->questContent2;
        $questions = $this->questions2($nilaiKarma);
        $timertotal = 300;
        return view('user.simplePastQuiz.simplePast2',compact('ceritaContent', 'questions', 'timertotal'));
    }

    public function quest3()
    {
        $ceritaContent = $this->questContent3;
        $questions = $this->questions3();
        $timertotal = 300;
        return view('user.simplePastQuiz.simplePast3',compact('ceritaContent', 'questions', 'timertotal'));
    }

    protected $questContent1 = [
        "After reading the basic knowledge book at the library",
        "Adelsten continued his practice in the park every day.",
        "During his practice, Adelsten met Rose.",
        "Rose herself was his friend from the wizard academy.",
    ];

    protected $questContent2 = [
        "Adelsten, who was practicing...",
        "was approached by his friend Rose.",
        "Confused by what happened with Rose.",
        "What's really going on with Rose...",
    ];

    protected $questContent3 = [
        "All participants are gathering at the Academy today to take the selection exam.",
        "Adelsten was impressing him with his highly skilled magic Including Fred and Adelsten, who are also at the academy",
        "Everyone is called to proceed one by one.",
        "The exam consists of practice and interview. How will Adelsten face this?",
        "Upon arriving in the room...",
    ];

    protected function questions1($nilaiKarma)
    {
        if ($nilaiKarma > 3) {
            return ([
                [
                    'question' => "Adelsten, what did you do here?",
                    'draggableWords' => ["Hello,", "it's", "a", "long", "time", "since", "saw", "each", "other", "we", "are", "seeing", "been", "meet"],
                    'correctAnswer' => ["Hello,", "it's", "a", "long", "time", "since", "we", "saw", "each", "other"],
                    'imagePath' =>  asset('image/chara/Rose.png') ,
                    'imageWrong' =>  asset('image/chara/RoseSad.png') ,
                    'imageSmile' =>  asset('image/chara/RoseSmile.png') 
                ],
                [
                    'question' => "What did you do here",
                    'draggableWords' => ["That", "was", "none", "of", "your", "business."],
                    'correctAnswer' => ["That", "was", "none", "of", "your", "business."],
                    'negativeAnswer' => ["business"],
                    'imagePath' =>  asset('image/chara/Rose.png') ,
                    'imageWrong' =>  asset('image/chara/RoseSad.png') ,
                    'imageSmile' =>  asset('image/chara/RoseSmile.png') 
                ]
            ]
            );
        } else {
            return ([
                [
                    'question' => "Adelsten, what did you do here?",
                    'draggableWords' => ["Hello,", "it's", "a", "long", "time", "since", "we", "saw", "each", "other", "we", "are", "seeing", "been", "meet"],
                    'correctAnswer' => ["Hello,", "it's", "a", "long", "time", "since", "we", "saw", "each", "other"],
                    'imagePath' =>  asset('image/chara/Rose.png'),
                    'imageWrong' =>  asset('image/chara/RoseSad.png'),
                    'imageSmile' =>  asset('image/chara/RoseSmile.png')
                ],
                [
                    'question' => "What are you doing here?",
                    'draggableWords' => ["I", "was", "practicing", "basic", "magic", "practiced", "daily", "practice"],
                    'correctAnswer' => ["I", "was", "practicing", "basic", "magic"],
                    'imagePath' =>  asset('image/chara/Rose.png'),
                    'imageWrong' =>  asset('image/chara/RoseSad.png'),
                    'imageSmile' =>  asset('image/chara/RoseSmile.png')
                ],
                [
                    'question' => "Ah, I see. Yesterday I saw you walking to the library with Fred",
                    'draggableWords' => ["Yes!", "Yesterday", "I", "went", "to", "the", "library.", "am", "going", "have", "gone", "go", "will"],
                    'correctAnswer' => ["Yes!", "Yesterday", "I", "went", "to", "the", "library."],
                    'imagePath' =>  asset('image/chara/Rose.png'),
                    'imageWrong' =>  asset('image/chara/RoseSad.png'),
                    'imageSmile' =>  asset('image/chara/RoseSmile.png')
                ]
            ]
            );
        }
    }

    protected function questions2($nilaiKarma)
    {
        if ($nilaiKarma > 4) {
            return ([
                [
                    'question' => "Adelsten, would you like to accompany me to buy our favorite ice cream first?",
                    'draggableWords' => ["You", "went", "by", "yourself.", "go", "are", "going", "had", "gone", "could", "go"],
                    'correctAnswer' => ["You", "went", "by", "yourself."],
                    'imagePath' =>  asset('image/chara/Rose.png'),
                    'imageWrong' =>  asset('image/chara/RoseSad.png'),
                    'imageSmile' =>  asset('image/chara/RoseSmile.png')
                ],
                [
                    'question' => "Once again, I ask if you want to accompany me to buy our favorite ice cream first?",
                    'draggableWords' => ["I", "didn't", "want", "to", "go.", "don't", "wanted"],
                    'correctAnswer' => ["I", "didn't", "want", "to", "go."],
                    'negativeAnswer' => ["business"],
                    'imagePath' =>  asset('image/chara/Rose.png'),
                    'imageWrong' =>  asset('image/chara/RoseSad.png'),
                    'imageSmile' =>  asset('image/chara/RoseSmile.png')
                ],
                [
                    'question' => "I'll treat you",
                    'draggableWords' => ["Okay,", "Then", "I", "joined", "you", "join", "have"],
                    'correctAnswer' => ["Okay,", "Then", "I", "joined", "you"],
                    'negativeAnswer' => ["business"],
                    'imagePath' =>  asset('image/chara/Rose.png'),
                    'imageWrong' =>  asset('image/chara/RoseSad.png'),
                    'imageSmile' =>  asset('image/chara/RoseSmile.png')
                ]
            ]
            );
        } else {
            return ([
                [
                    'question' => "Adelsten, would you like to accompany me to buy our favorite ice cream first?",
                    'draggableWords' => ["What", "was", "wrong", "with", "you,", "Rose?", "is", "were"],
                    'correctAnswer' => ["What", "was", "wrong", "with", "you,", "Rose?"],
                    'imagePath' =>  asset('image/chara/Rose.png') ,
                    'imageWrong' =>  asset('image/chara/RoseSad.png') ,
                    'imageSmile' =>  asset('image/chara/RoseSmile.png') 
                ],
                [
                    'question' => "It seems I can't participate in the magic selection this year",
                    'draggableWords' => ["Why?", "Told", "me,", "Rose", "Tell", "Telling"],
                    'correctAnswer' => ["Why?", "Told", "me,", "Rose"],
                    'imagePath' =>  asset('image/chara/Rose.png') ,
                    'imageWrong' =>  asset('image/chara/RoseSad.png') ,
                    'imageSmile' =>  asset('image/chara/RoseSmile.png') 
                ],
                [
                    'question' => "Since a week ago, my mother fell ill. There's no one taking care of her.",
                    'draggableWords' => ["Was", "your", "father", "not", "at", "home?", "Were"],
                    'correctAnswer' => ["Was", "your", "father", "not", "at", "home?"],
                    'imagePath' =>  asset('image/chara/Rose.png') ,
                    'imageWrong' =>  asset('image/chara/RoseSad.png') ,
                    'imageSmile' =>  asset('image/chara/RoseSmile.png') 
                ],
                [
                    'question' => "My father went on a dungeon mission three days ago.",
                    'draggableWords' => ["I", "hoped", "your", "mother", "got", "well", "soon,", "Rose", "gets", "hope", "hoping"],
                    'correctAnswer' => ["I", "hoped", "your", "mother", "got", "well", "soon,", "Rose"],
                    'imagePath' =>  asset('image/chara/Rose.png') ,
                    'imageWrong' =>  asset('image/chara/RoseSad.png') ,
                    'imageSmile' =>  asset('image/chara/RoseSmile.png') 
                ],
                [
                    'question' => "Again, would you like to accompany me to buy our favorite ice cream first?",
                    'draggableWords' => ["Yes,", "of", "course", "I", "came", "after", "practicing!", "come", "will"],
                    'correctAnswer' => ["Yes,", "of", "course", "I", "came", "after", "practicing!"],
                    'imagePath' =>  asset('image/chara/Rose.png') ,
                    'imageWrong' =>  asset('image/chara/RoseSad.png') ,
                    'imageSmile' =>  asset('image/chara/RoseSmile.png') 
                ]
            ]
            );
        }
    }

    protected function questions3()
    {
        return ([
            [
                'question' => "This store makes me nostalgic",
                'draggableWords' => ["You", "were", "right,", "I", "always", "liked", "ice", "cream", "here.","are"],
                'correctAnswer' => ["You", "were", "right,", "I", "always", "liked", "ice", "cream", "here."],
                'imagePath' => asset('image/chara/Rose.png'),
                'imageWrong' => asset('image/chara/RoseSad.png'),
                'imageSmile' => asset('image/chara/RoseSmile.png'),
            ],
            [
                'question' => "After watching you practice, I want to give you one advice.",
                'draggableWords' => ["Gave", "your", "advice,", "Rose","Give","Giving"],
                'correctAnswer' => ["Gave", "your", "advice,", "Rose"],
                'imagePath' => asset('image/chara/Rose.png'),
                'imageWrong' => asset('image/chara/RoseSad.png'),
                'imageSmile' => asset('image/chara/RoseSmile.png'),
            ],
            [
                'question' => "You forget something. The flow of chi. You must feel the flow of chi within you, Adelsten",
                'draggableWords' => ["Oh", "my,", "I", "forgot", "about", "that,", "thank", "you", "knew"],
                'correctAnswer' => ["Oh", "my,", "I", "forgot", "about", "that,", "thank", "you"],
                'negativeAnswer' => ["knew"],
                'imagePath' => asset('image/chara/Rose.png'),
                'imageWrong' => asset('image/chara/RoseSad.png'),
                'imageSmile' => asset('image/chara/RoseSmile.png'),
            ],
        ]
        );
    }
}
