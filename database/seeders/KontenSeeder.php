<?php

namespace Database\Seeders;

use App\Models\Konten;
use Illuminate\Database\Seeder;

class KontenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Konten::create([
            'nama' => 'questcontent1q1',
            'content' => [
                "At a renowned school in the city of Yden, a selection test for magic is being held.",
                "Fred and Adelsten are childhood friends.",
                "Because they are now 15 years old, they will take the magic selection test to prove themselves worthy of becoming a level 3 wizard. ",
                "Meanwhile, when in front of Fred's house.",
                "...",
            ],
        ]);

        Konten::create([
            'nama' => 'questcontent1q2',
            'content' => [
                "The next day...",
                "Adelsten comes to Fred's house to practice together.",
                "Fred goes inside to find a basic knowledge book.",
                "After a few minutes ...",
            ],
        ]);

        Konten::create([
            'nama' => 'questcontent1q3',
            'content' => [
                "Today, Adelsten goes to Fred's house again to practice together. ",
                "But, there is bad news brought by Adelsten.",
                "What bad news does Adelsten convey?",
                "...",
            ],
        ]);

        Konten::create([
            'nama' => 'questcontent2q1',
            'content' => [
                "In the following days, Fred and Adelsten are going to the library to search for the basic knowledge book.",
                "After a while...",
                "Adelsten is searching for it but still isn't finding it",
                "What is this book actually like?",
                " Will they be finding it?"
            ],
        ]);

        Konten::create([
            'nama' => 'questcontent2q2',
            'content' => [
                "After an hour and a half of searching for the book in the library.",
                "Fred and Adelsten are feeling dizzy and tired.",
                "However, their youthful spirit and enthusiasm",
                "still haven't surrendered yet in finding it."
            ],
        ]);

        Konten::create([
            'nama' => 'questcontent2q3',
            'content' => [
                "10 minutes later, Fred and Adelsten are finishing their break.",
                "Both of them are starting to learn about basic knowledge.",
                "Heart..., Mind..., are the most essential foundations.",
                "...",
                "The day is already nearing evening without them realizing it."
            ],
        ]);

        Konten::create([
            'nama' => 'questcontent3q1',
            'content' => [
                "After reading the basic knowledge book at the library",
                "Adelsten continued his practice in the park every day.",
                "During his practice, Adelsten met Rose.",
                "Rose herself was his friend from the wizard academy.",
            ],
        ]);

        Konten::create([
            'nama' => 'questcontent3q2',
            'content' => [
                "Adelsten, who was practicing...",
                "was approached by his friend Rose.",
                "Confused by what happened with Rose.",
                "What's really going on with Rose...",
            ],
        ]);

        Konten::create([
            'nama' => 'questcontent3q3',
            'content' => [
                "Adelsten and Rose bought their favorite ice cream when they were still studying at the academy",
                "Rose seemed entertained and happy to be with her friend when she was sad",
                "Indeed, as a friend, we should always help each other",
                "and always be there in times of joy or sadness",
            ],
        ]);

        Konten::create([
            'nama' => 'questcontent4q1',
            'content' => [
                "The following day, Adelsten was practicing in the front yard",
                "The selection exam was getting closer",
                "Suddenly, Fred came to Adelsten's house.",
            ],
        ]);

        Konten::create([
            'nama' => 'questcontent4q2',
            'content' => [
                "During the training session with Fred.",
                "Adelsten was impressing him with his highly skilled magic.",
                "Fred was curious to know the secret behind Adelsten's proficiency",
            ],
        ]);

        Konten::create([
            'nama' => 'questcontent4q3',
            'content' => [
                "BOOM!! BLAMM!!",
                "The magic sound produced by Fred was very loud",
                "Fred was very impressed with his own magic.",
                "Fred was very happy with the results of his training.",
                "Adelsten and Fred were very ready to take the selection exam tomorrow.",
            ],
        ]);

        Konten::create([
            'nama' => 'questcontent5q1',
            'content' => [
                "All participants are gathering at the Academy today to take the selection exam.",
                "Adelsten was impressing him with his highly skilled magic Including Fred and Adelsten, who are also at the academy",
                "Everyone is called to proceed one by one.",
                "The exam consists of practice and interview. How will Adelsten face this?",
                "Upon arriving in the room...",
            ],
        ]);

        Konten::create([
            'nama' => 'questcontent5q2',
            'content' => [
                "Adelsten continues his examination.",
                "Now is the time for Adelsten to take the practical exam.",
                "Will Adelsten be able to take the practical exam smoothly later?",
            ],
        ]);

        Konten::create([
            'nama' => 'questcontent5q3',
            'content' => [
                "After Adelsten shows his fire magic",
                "he will leave the room and meet Fred in the academy's courtyard",
                "They will discuss their future plans.",
            ],
        ]);

        Konten::create([
            'nama' => 'questions1q1',
            'content' => [
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
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "Oh, yes, I have to prepare for it. How about you?",
                    'draggableWords' => ["I", "practice", "practiced", "every", "day", "practicing"],
                    'correctAnswer' => ["I", "practice", "every", "day"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "How about we practice together?",
                    'draggableWords' => [
                        "That", "a", "great", "idea",
                        "I", "am", "lazy", "to", "practice", "every", "day", "is"
                    ],
                    'correctAnswer' => ["That", "is", "a", "great", "idea"],
                    'negativeAnswer' => ["lazy"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions1q2',
            'content' => [
                [
                    'question' => "Adelsten, you're here",
                    'draggableWords' => [
                        "what", "are", "we", "going", "to", "learn", "today?", "Do",
                    ],
                    'correctAnswer' => [
                        "Do", "we", "learn", "today?",
                    ],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "We'll just focus on strengthening basic techniques today",
                    'draggableWords' => [
                        "That", "is", "important", "has", "been", "was",
                    ],
                    'correctAnswer' => [
                        "That", "is", "important",
                    ],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "Do you have the basic book, Adelsten?",
                    'draggableWords' => [
                        "I", "don't", "have", "it", "with", "me", "right", "now", "didn't", "won't", "haven't",
                    ],
                    'correctAnswer' => [
                        "I", "don't", "have", "it", "with", "me", "right", "now",
                    ],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "Do we start tomorrow?",
                    'draggableWords' => [
                        "Okay,", "then", "we'll", "practice", "tomorrow",
                    ],
                    'correctAnswer' => [
                        "Okay,", "then", "we'll", "practice", "tomorrow",
                    ],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions1q3',
            'content' => [
                [
                    'question' => "Hello Adelsten, do you bring your book?",
                    'draggableWords' => [
                        "Sorry,", "my", "book", "is", "missing", "was", "are", "has", "isn't", "I", "forget",
                        "to", "bring", "it",
                    ],
                    'correctAnswer' => ["Sorry,", "my", "book", "is", "missing"],
                    'negativeAnswer' => ["forget"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "No need to be sad, Adelsten, there is always a way",
                    'draggableWords' => [
                        "Do", "we", "go", "to", "the", "library?", "Does", "Do", "Are", "Will",
                    ],
                    'correctAnswer' => ["Do", "we", "go", "to", "the", "library?"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "But I can't leave the house today, I have to clean the house because it's my routine",
                    'draggableWords' => [
                        "It's", "okay,", "We", "meet", "again", "tomorrow.", "met", "will", "meets",
                    ],
                    'correctAnswer' => ["It's", "okay,", "We", "meet", "again", "tomorrow."],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions2q1',
            'content' => [
                [
                    'question' => "Adelsten, are you finding your book?",
                    'draggableWords' => ["I", "am", "searching", "for", "30", "minutes" ,"have", "been","will", "searched"],
                    'correctAnswer' => ["I", "am", "searching", "for", "30", "minutes"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "Yes, are you finding it?",
                    'draggableWords' => ["I", "am", "not finding", "it", "yet", "was","have","will","not found","not find"],
                    'correctAnswer' => ["I", "am", "not finding", "it", "yet"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "The book should be on this shelf.",
                    'draggableWords' => ["We", "are", "be","will", "searched", "searching", "again", "going", "home"],
                    'correctAnswer' => ["We", "will","be", "searching", "again"],
                    'negativeAnswer' => ["going", "home"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions2q2',
            'content' => [
                [
                    'question' => "I am feeling very tired",
                    'draggableWords' => ["We", "are", "currently", "searching","still","have", "been","will", "be"],
                    'correctAnswer' => ["We", "are", "currently", "searching"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "Do you see that brown book up there?",
                    'draggableWords' => ["I", "get", "it", "am", "was","will","getting"],
                    'correctAnswer' => ["I", "am", "getting", "it"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "Yes, this is indeed the book, finally we are finding it",
                    'draggableWords' => ["I", "am", "being", "happy", "to", "hear", "that", "feeling","glad"],
                    'correctAnswer' => ["I", "am", "feeling", "happy", "to", "hear", "that"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "How about we take a short break before starting to read it?",
                    'draggableWords' => ["Yes!", "I", "am", "also", "resting", "for", "10", "minutes","taking", "a", "break"],
                    'correctAnswer' => ["Yes!", "I", "am", "also", "resting", "for", "10", "minutes"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions2q3',
            'content' => [
                [
                    'question' => "A calm mind and heart are the most important things, remember that, Adelsten.",
                    'draggableWords' => ["Yes!", "I", "am", "always", "keeping", "it", "in", "mind","keep","thinking"],
                    'correctAnswer' => ["Yes!", "I", "am", "always", "keeping", "it", "in", "mind"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "This basic knowledge book by Fengxian is really good",
                    'draggableWords' => [ "It's", "so", "good", "but", "the", "day", "is", "already", "getting", "late"],
                    'correctAnswer' => [ "It's", "so", "good", "but", "the", "day", "is", "already", "getting", "late"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "you're right, time passes so quickly",
                    'draggableWords' => ["Let's", "be", "going", "home", "go","to"],
                    'correctAnswer' => ["Let's", "be", "going", "home"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions3q1',
            'content' => [
                [
                    'question' => "Adelsten, what did you do here?",
                    'draggableWords' => ["Hello,", "it's", "a", "long", "time", "since", "we", "saw", "each", "other", "we", "are", "seeing", "been", "meet"],
                    'correctAnswer' => ["Hello,", "it's", "a", "long", "time", "since", "we", "saw", "each", "other"],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
                [
                    'question' => "What are you doing here?",
                    'draggableWords' => ["I", "was", "practicing", "basic", "magic", "practiced", "daily", "practice"],
                    'correctAnswer' => ["I", "was", "practicing", "basic", "magic"],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
                [
                    'question' => "Ah, I see. Yesterday I saw you walking to the library with Fred",
                    'draggableWords' => ["Yes!", "Yesterday", "I", "went", "to", "the", "library.", "am", "going", "have", "gone", "go", "will"],
                    'correctAnswer' => ["Yes!", "Yesterday", "I", "went", "to", "the", "library."],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ]
            ],
        ]);

        Konten::create([
            'nama' => 'questions3q1k',
            'content' => [
                [
                    'question' => "Adelsten, what did you do here?",
                    'draggableWords' => ["Hello,", "it's", "a", "long", "time", "since", "saw", "each", "other", "we", "are", "seeing", "been", "meet"],
                    'correctAnswer' => ["Hello,", "it's", "a", "long", "time", "since", "we", "saw", "each", "other"],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
                [
                    'question' => "What did you do here",
                    'draggableWords' => ["That", "was", "none", "of", "your", "business."],
                    'correctAnswer' => ["That", "was", "none", "of", "your", "business."],
                    'negativeAnswer' => ["business"],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions3q2',
            'content' => [
                [
                    'question' => "Adelsten, would you like to accompany me to buy our favorite ice cream first?",
                    'draggableWords' => ["What", "was", "wrong", "with", "you,", "Rose?", "is", "were"],
                    'correctAnswer' => ["What", "was", "wrong", "with", "you,", "Rose?"],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
                [
                    'question' => "It seems I can't participate in the magic selection this year",
                    'draggableWords' => ["Why?", "Told", "me,", "Rose", "Tell", "Telling"],
                    'correctAnswer' => ["Why?", "Told", "me,", "Rose"],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
                [
                    'question' => "Since a week ago, my mother fell ill. There's no one taking care of her.",
                    'draggableWords' => ["Was", "your", "father", "not", "at", "home?", "Were"],
                    'correctAnswer' => ["Was", "your", "father", "not", "at", "home?"],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
                [
                    'question' => "My father went on a dungeon mission three days ago.",
                    'draggableWords' => ["I", "hoped", "your", "mother", "got", "well", "soon,", "Rose", "gets", "hope", "hoping"],
                    'correctAnswer' => ["I", "hoped", "your", "mother", "got", "well", "soon,", "Rose"],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
                [
                    'question' => "Again, would you like to accompany me to buy our favorite ice cream first?",
                    'draggableWords' => ["Yes,", "of", "course", "I", "came", "after", "practicing!", "come", "will"],
                    'correctAnswer' => ["Yes,", "of", "course", "I", "came", "after", "practicing!"],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions3q2k',
            'content' => [
                [
                    'question' => "Adelsten, would you like to accompany me to buy our favorite ice cream first?",
                    'draggableWords' => ["You", "went", "by", "yourself.", "go", "are", "going", "had", "gone", "could", "go"],
                    'correctAnswer' => ["You", "went", "by", "yourself."],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
                [
                    'question' => "Once again, I ask if you want to accompany me to buy our favorite ice cream first?",
                    'draggableWords' => ["I", "didn't", "want", "to", "go.", "don't", "wanted"],
                    'correctAnswer' => ["I", "didn't", "want", "to", "go."],
                    'negativeAnswer' => ["business"],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
                [
                    'question' => "I'll treat you",
                    'draggableWords' => ["Okay,", "Then", "I", "joined", "you", "join", "have"],
                    'correctAnswer' => ["Okay,", "Then", "I", "joined", "you"],
                    'negativeAnswer' => ["business"],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions3q3',
            'content' => [
                [
                    'question' => "This store makes me nostalgic",
                    'draggableWords' => ["You", "were", "right,", "I", "always", "liked", "ice", "cream", "here.", "are"],
                    'correctAnswer' => ["You", "were", "right,", "I", "always", "liked", "ice", "cream", "here."],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
                [
                    'question' => "After watching you practice, I want to give you one advice.",
                    'draggableWords' => ["Gave", "your", "advice,", "Rose", "Give", "Giving"],
                    'correctAnswer' => ["Gave", "your", "advice,", "Rose"],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
                [
                    'question' => "You forget something. The flow of chi. You must feel the flow of chi within you, Adelsten",
                    'draggableWords' => ["Oh", "my,", "I", "forgot", "about", "that,", "thank", "you", "knew"],
                    'correctAnswer' => ["Oh", "my,", "I", "forgot", "about", "that,", "thank", "you"],
                    'negativeAnswer' => ["knew"],
                    'imagePath' => 'image/chara/Rose.png',
                    'imageWrong' => 'image/chara/RoseSad.png',
                    'imageSmile' => 'image/chara/RoseSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions4q1',
            'content' => [
                [
                    'question' => "Hello, Adelsten, were you practicing?",
                    'draggableWords' => ["Fred!", "You", "were", "coming", "here.", "are", "come", "came"],
                    'correctAnswer' => ["Fred!", "You", "were", "coming", "here."],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "Yes! I wanted to practice with you. Were you not at home yesterday?",
                    'draggableWords' => ["Yesterday,", "I", "was", "at", "the", "park", "and", "I", "was", "meeting", "Rose.", "meet", "met", "being", "am"],
                    'correctAnswer' => ["Yesterday,", "I", "was", "at", "the", "park", "and", "I", "was", "meeting", "Rose."],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "That's why, when I was doing physical training yesterday, you weren't seen practicing in your front yard. Was Rose also taking the selection exam this year?",
                    'draggableWords' => ["Unfortunately,", "she", "wasn't", "taking", "the", "selection", "exam", "this", "year.", "didn't", "take"],
                    'correctAnswer' => ["Unfortunately,", "she", "wasn't", "taking", "the", "selection", "exam", "this", "year."],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "why she wasn't taking the selection exam this year?",
                    'draggableWords' => ["Her", "mother", "was", "sick", "for", "a", "week.", "is"],
                    'correctAnswer' => ["Her", "mother", "was", "sick", "for", "a", "week."],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions4q2',
            'content' => [
                [
                    'question' => "Wow Adelsten, where were you learning control like that?",
                    'draggableWords' => ["Rose", "was", "giving", "me", "advice.", "gives", "gave", "is"],
                    'correctAnswer' => ["Rose", "was", "giving", "me", "advice."],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "Tell me too, please!",
                    'draggableWords' => ["I", "was", "feeling", "the", "flow", "of", "chi", "within", "me.", "felt", "feel"],
                    'correctAnswer' => ["I", "was", "feeling", "the", "flow", "of", "chi", "within", "me."],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredSad.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "Ah, like that, try practicing it again while I watch",
                    'draggableWords' => ["Were", "you", "ready", "now?", "Are"],
                    'correctAnswer' => ["Were", "you", "ready", "now?"],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredSad.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions4q2k',
            'content' => [
                [
                    'question' => "Wow Adelsten, where were you learning control like that?",
                    'draggableWords' => ["Rose", "was", "giving", "me", "advice.", "gives", "gave", "is"],
                    'correctAnswer' => ["Rose", "was", "giving", "me", "advice."],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "Tell me too!",
                    'draggableWords' => ["I", "couldn't be", "telling", "you.", "wasn't", "won't be"],
                    'correctAnswer' => ["I", "couldn't", "be", "telling", "you."],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions4q3',
            'content' => [
                [
                    'question' => "Adelsten, were you seeing that? It was very cool",
                    'draggableWords' => ["You", "were", "looking", "very", "different", "compared", "to", "yesterday", "looked", "look"],
                    'correctAnswer' => ["You", "were", "looking", "very", "different", "compared", "to", "yesterday"],
                    'imagePath' =>  'image/chara/Fred.png',
                    'imageWrong' =>  'image/chara/FredAngry.png',
                    'imageCorrect' =>  'image/chara/FredSmile.png',
                ],
                [
                    'question' => "Yes, I was feeling the same way. It's all thanks to you, Adelsten",
                    'draggableWords' => ["Were", "you", "bringing", "the", "book", "we", "borrowed", "from", "the", "library", "yesterday?"],
                    'correctAnswer' => ["Were", "you", "bringing", "the", "book", "we", "borrowed", "from", "the", "library", "yesterday?"],
                    'imagePath' =>  'image/chara/Fred.png',
                    'imageWrong' =>  'image/chara/FredAngry.png',
                    'imageCorrect' =>  'image/chara/FredSmile.png',
                ],
                [
                    'question' => "Yes, of course, here is the book",
                    'draggableWords' => ["I", "was", "wanting", "to", "read", "the", "book", "while", "you", "were", "training", "wanted", "want"],
                    'correctAnswer' => ["I", "was", "wanting", "to", "read", "the", "book", "while", "you", "were", "training"],
                    'imagePath' =>  'image/chara/Fred.png',
                    'imageWrong' =>  'image/chara/FredAngry.png',
                    'imageCorrect' =>  'image/chara/FredSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions5q1',
            'content' => [
                [
                    'question' => "So, what are your plans if you become a level 3 wizard?",
                    'draggableWords' => ["I", "will", "be", "helping", "others", "across", "the", "country,", "ma'am", "help"],
                    'correctAnswer' => ["I", "will", "be", "helping", "others", "across", "the", "country,", "ma'am"],
                    'imagePath' => 'image/chara/elsker.png',
                    'imageWrong' => 'image/chara/elskerAngry.png',
                    'imageCorrect' => 'image/chara/elskerSmile.png',
                ],
                [
                    'question' => "Is there anything else?",
                    'draggableWords' => ["I", "will", "be", "starting", "my", "adventure", "from", "tomorrow", "started", "start"],
                    'correctAnswer' => ["I", "will", "be", "starting", "my", "adventure", "from", "tomorrow"],
                    'imagePath' => 'image/chara/elsker.png',
                    'imageWrong' => 'image/chara/elskerAngry.png',
                    'imageCorrect' => 'image/chara/elskerSmile.png',
                ],
                [
                    'question' => "Well done. For now you can leave the room and continue with the practical exam",
                    'draggableWords' => ["I", "will", "also", "be", "gathering", "new", "magic", "while", "I", "am", "on", "my", "adventure"],
                    'correctAnswer' => ["I", "will", "also", "be", "gathering", "new", "magic", "while", "I", "am", "on", "my", "adventure"],
                    'imagePath' => 'image/chara/elsker.png',
                    'imageWrong' => 'image/chara/elskerAngry.png',
                    'imageCorrect' => 'image/chara/elskerSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions5q1k',
            'content' => [
                [
                    'question' => "So, what are your plans if you become a level 3 wizard?",
                    'draggableWords' => ["I", "still", "haven't", "thought", "about", "the", "future", "don't"],
                    'correctAnswer' => ["I", "still", "haven't", "thought", "about", "the", "future"],
                    'imagePath' => 'image/chara/elsker.png',
                    'imageWrong' => 'image/chara/elskerAngry.png',
                    'imageCorrect' => 'image/chara/elskerSmile.png',
                ],
                [
                    'question' => "Hmm okay",
                    'draggableWords' => ["Will", "I", "be", "passing", "the", "oral", "exam,", "ma'am?", "pass"],
                    'correctAnswer' => ["Will", "I", "be", "passing", "the", "oral", "exam,", "ma'am?"],
                    'imagePath' => 'image/chara/elsker.png',
                    'imageWrong' => 'image/chara/elskerAngry.png',
                    'imageCorrect' => 'image/chara/elskerSmile.png',
                ],
                [
                    'question' => "We'll see later, for now you can leave the room and continue with the practical exam",
                    'draggableWords' => ["Okay,", "I'll", "leave", "the", "room", "and", "continue", "with", "the", "practical", "exam", "leaving"],
                    'correctAnswer' => ["Okay,", "I'll", "leave", "the", "room", "and", "continue", "with", "the", "practical", "exam"],
                    'imagePath' => 'image/chara/elsker.png',
                    'imageWrong' => 'image/chara/elskerAngry.png',
                    'imageCorrect' => 'image/chara/elskerSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions5q2',
            'content' => [
                [
                    'question' => "Adelsten, step forward and please show me your best magic!",
                    'draggableWords' => ["Alright", "sir,", "I", "will", "show", "you", "a", "magic", "of", "flower", "arrangement", "showed", "showing"],
                    'correctAnswer' => ["Alright", "sir,", "I", "will", "show", "you", "a", "magic", "of", "flower", "arrangement"],
                    'imagePath' => 'image/chara/vinde.png',
                    'imageWrong' => 'image/chara/vindeAngry.png',
                    'imageCorrect' => 'image/chara/vindeSmile.png',
                ],
                [
                    'question' => "Why are you showing that magic?",
                    'draggableWords' => ["I", "will", "spread", "joy", "around", "the", "world,", "sir.", "spreading"],
                    'correctAnswer' => ["I", "will", "spread", "joy", "around", "the", "world,", "sir."],
                    'imagePath' => 'image/chara/vinde.png',
                    'imageWrong' => 'image/chara/vindeAngry.png',
                    'imageCorrect' => 'image/chara/vindeSmile.png',
                ],
                [
                    'question' => "Very noble, but can you also perform attack magic?",
                    'draggableWords' => ["Yes,", "I", "will", "perform", "fire", "magic", "performing", "performed"],
                    'correctAnswer' => ["Yes,", "I", "will", "perform", "fire", "magic"],
                    'imagePath' => 'image/chara/vinde.png',
                    'imageWrong' => 'image/chara/vindeAngry.png',
                    'imageCorrect' => 'image/chara/vindeSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'questions5q3',
            'content' => [
                [
                    'question' => "Adelsten, did you finish your exam?",
                    'draggableWords' => ["Yes,", "I", "think", "I'll", "pass", "the", "exam.","thought",],
                    'correctAnswer' => ["Yes,", "I", "think", "I'll", "pass", "the", "exam."],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "What your plans after this, Adelsten?",
                    'draggableWords' => ["I", "will", "help", "people", "around", "me", "while", "waiting", "for", "the", "exam", "results.", "helped","be"],
                    'correctAnswer' => ["I", "will", "help", "people", "around", "me", "while", "waiting", "for", "the", "exam", "results."],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
                [
                    'question' => "Wow, you will indeed be very kind, Adelsten.",
                    'draggableWords' => ["I", "will", "become", "a", "kind", "witch."],
                    'correctAnswer' => ["I", "will", "become", "a", "kind", "witch."],
                    'imagePath' => 'image/chara/Fred.png',
                    'imageWrong' => 'image/chara/FredAngry.png',
                    'imageCorrect' => 'image/chara/FredSmile.png',
                ],
            ],
        ]);

        Konten::create([
            'nama' => 'ending',
            'content' => [
                "Three weeks later, they will receive the announcement letter of the selection exam results.",
                "A total of 18 participants will be declared passed in the Class 3 Wizard Selection Exam",
                "Including Adelsten and Fred, both of whom will be declared passed",
                "Fred will join the adventure guild and continue exploring dungeons",
                "Adelsten will go explore the world and collect all the magic.",
            ],
        ]);

        Konten::create([
            'nama' => 'endingk',
            'content' => [
                "Three weeks later, they will receive the announcement letter of the selection exam results.",
                "A total of 18 participants will be declared passed in the Class 3 Wizard Selection Exam",
                "But among the 18 participants, only Fred will be there.",
                "Adelsten will not be declared passed the selection.",
                "Adelsten will have to retake it next year.",
            ],
        ]);
    }
}
