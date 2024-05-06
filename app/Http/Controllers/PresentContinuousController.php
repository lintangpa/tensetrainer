<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

            $isAchieved = true;
            foreach ($requirement['simple_present'] as $quest => $requiredProgress) {
                if ($userProgress['simple_present'][$quest] < $requiredProgress) {
                    $isAchieved = false;
                    break;
                }
            }
            if ($isAchieved) {
                $this->storeAchievement($user, $achievement->nama);
                $notifications[] = $achievement->nama;
            }
        }
        return view('user.presentContinuousQuiz.presentContinuousHome', compact('notifications', 'userProgress'));
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
        $timertotal = 360;
        return view('user.presentContinuousQuiz.presentContinuous1', compact('ceritaContent', 'questions' ,'timertotal'));
    }

    public function quest2()
    {
        $ceritaContent = $this->questContent2;
        $questions = $this->questions2();
        $timertotal = 360;
        return view('user.presentContinuousQuiz.presentContinuous2', compact('ceritaContent', 'questions', 'timertotal'));
    }

    public function quest3()
    {
        $ceritaContent = $this->questContent3;
        $questions = $this->questions3();
        $timertotal = 360;
        return view('user.presentContinuousQuiz.presentContinuous3', compact('ceritaContent', 'questions', 'timertotal'));
    }

    protected $questContent1 = [
        "In the following days, Fred and Adelsten are going to the library to search for the basic knowledge book.",
        "After a while...",
        "Adelsten is searching for it but still isn't finding it",
        "What is this book actually like?",
        " Will they be finding it?"
    ];

    protected $questContent2 = [
        "After an hour and a half of searching for the book in the library.",
        "Fred and Adelsten are feeling dizzy and tired.",
        "However, their youthful spirit and enthusiasm",
        "still haven't surrendered yet in finding it."
    ];
    
    protected $questContent3 = [
        "10 minutes later, Fred and Adelsten are finishing their break.",
        "Both of them are starting to learn about basic knowledge.",
        "Heart..., Mind..., are the most essential foundations.",
        "...",
        "The day is already nearing evening without them realizing it."
    ];

    protected function questions1()
    {
        return ([
            [
                'question' => "Adelsten, are you finding your book?",
                'draggableWords' => ["I", "am", "searching", "for", "30", "minutes" ,"have", "been","will", "searched"],
                'correctAnswer' => ["I", "am", "searching", "for", "30", "minutes"],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "Yes, are you finding it?",
                'draggableWords' => ["I", "am", "not finding", "it", "yet", "was","have","will","not found","not find"],
                'correctAnswer' => ["I", "am", "not finding", "it", "yet"],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "The book should be on this shelf.",
                'draggableWords' => ["We", "are", "be","will", "searched", "searching", "again", "going", "home"],
                'correctAnswer' => ["We", "will","be", "searching", "again"],
                'negativeAnswer' => ["going", "home"],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
        ]
        );
    }

    protected function questions2()
    {
        return ([
            [
                'question' => "I am feeling very tired",
                'draggableWords' => ["We", "are", "currently", "searching","still","have", "been","will", "be"],
                'correctAnswer' => ["We", "are", "currently", "searching"],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "Do you see that brown book up there?",
                'draggableWords' => ["I", "get", "it", "am", "was","will","getting"],
                'correctAnswer' => ["I", "am", "getting", "it"],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "Yes, this is indeed the book, finally we are finding it",
                'draggableWords' => ["I", "am", "being", "happy", "to", "hear", "that", "feeling","glad"],
                'correctAnswer' => ["I", "am", "feeling", "happy", "to", "hear", "that"],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "How about we take a short break before starting to read it?",
                'draggableWords' => ["Yes!", "I", "am", "also", "resting", "for", "10", "minutes","taking", "a", "break"],
                'correctAnswer' => ["Yes!", "I", "am", "also", "resting", "for", "10", "minutes"],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
        ]
        );
    }

    protected function questions3()
    {
        return ([
            [
                'question' => "A calm mind and heart are the most important things, remember that, Adelsten.",
                'draggableWords' => ["Yes!", "I", "am", "always", "keeping", "it", "in", "mind","keep","thinking"],
                'correctAnswer' => ["Yes!", "I", "am", "always", "keeping", "it", "in", "mind"],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "This basic knowledge book by Fengxian is really good",
                'draggableWords' => [ "It's", "so", "good", "but", "the", "day", "is", "already", "getting", "late"],
                'correctAnswer' => [ "It's", "so", "good", "but", "the", "day", "is", "already", "getting", "late"],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
            [
                'question' => "you're right, time passes so quickly",
                'draggableWords' => ["Let's", "be", "going", "home", "go","to"],
                'correctAnswer' => ["Let's", "be", "going", "home"],
                'imagePath' => asset('image/chara/Fred.png'),
                'imageWrong' => asset('image/chara/FredAngry.png'),
                'imageCorrect' => asset('image/chara/FredSmile.png'),
            ],
        ]
        );
    }
}
