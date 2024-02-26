@extends('layout.userlayout')
@section('konten')
    <style>
        .hide {
            display: none;
        }

        .timer {
            width: 100%;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin-bottom: 30px;
        }

        .timer .progress {
            position: relative;
            width: 100%;
            height: 40px;
            background: transparent;
            border-radius: 30px;
            overflow: hidden;
            margin-bottom: 10px;
            border: 3px solid #3f4868;
        }

        .timer .progress .progress-bar {
            width: 100%;
            height: 100%;
            border-radius: 30px;
            overflow: hidden;
            background: linear-gradient(to right, #facc15, #ca8a04);
            transition: 1s linear;
        }

        .timer .progress .progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-size: 16px;
            font-weight: 500;
        }

        .question-wrapper .number {
            color: #a2aace;
            font-size: 25px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .question-wrapper .number .total {
            color: #576081;
            font-size: 18px;
        }

        .question-wrapper .question {
            color: #fff;
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .answer-wrapper .answer {
            width: 100%;
            height: 60px;
            padding: 20px;
            border-radius: 10px;
            color: #fff;
            border: 3px solid #3f4868;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            cursor: pointer;
            transition: 0.3s linear;
        }

        .answer .checkbox {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 3px solid #3f4868;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .answer .checkbox i {
            color: #fff;
            font-size: 10px;
            opacity: 0;
            transition: all 0.3s;
        }

        .answer:hover:not(.checked) .checkbox,
        .answer.selected .checkbox {
            background-color: #0c80ef;
            border-color: #0c80ef;
        }

        .answer.selected .checkbox i {
            opacity: 1;
        }

        .answer.correct {
            border-color: #0cef2a;
        }

        .answer.wrong {
            border-color: #fc3939;
        }

        .question-wrapper,
        .answer-wrapper {
            margin-bottom: 50px;
        }
    </style>
    <div class="p-4 sm:ml-64 flex items-center justify-center min-h-screen">
        <div class="my-auto w-full p-4 max-w-md bg-violet-950 shadow-md rounded-lg">
            <div class="start-screen">
                <div class="settings">
                </div>
                <button
                    class="w-full h-16 bg-blue-600 rounded-md text-white text-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring focus:border-blue-300 transition start">Start
                    Quiz</button>
            </div>
            <div class="quiz hide">
                {{-- <div class="timer">
                    <div class="progress">
                        <div class="progress-bar"></div>
                        <span class="progress-text"></span>
                    </div>
                </div> --}}
                <div class="question-wrapper">
                    <div class="number">
                        Question <span class="current">1</span>
                        <span class="total">/10</span>
                    </div>
                    <div class="question">This is a question This is a question?</div>
                </div>
                <div class="answer-wrapper">
                    <div class="answer selected">
                        <span class="text">answer</span>
                        <span class="checkbox">
                            <i class="fas fa-check"></i>
                        </span>
                    </div>
                </div>
                <button
                    class="btn submit w-full h-16 bg-blue-600 rounded-md text-white text-lg font-semibold cursor-pointer submit"
                    disabled>Submit</button>
                <button
                    class="btn next w-full h-16 bg-blue-600 rounded-md text-white text-lg font-semibold hidden next">Next</button>
            </div>
            <div class="end-screen hide">
                <div class="score">
                    <span class="score-text text-gray-400 text-lg font-semibold mb-8">Your score:</span>
                    <div>
                        <span class="final-score text-white text-4xl font-semibold">0</span>
                        <span class="total-score text-gray-400 text-lg font-semibold">/10</span>
                    </div>
                </div>
                <button class="mb-6 btn restart w-full h-16 bg-blue-600 rounded-md text-white text-lg font-semibold">Restart
                    Quiz</button>
                <a href="{{ route('simple-present') }}">
                    <button class="mb-6 w-full h-16 bg-blue-600 rounded-md text-white text-lg font-semibold">Back to
                        Menu</button>
                </a>
            </div>
        </div>
    </div>
    <script>
        // const progressBar = document.querySelector(".progress-bar"),
        //     progressText = document.querySelector(".progress-text");

        // const progress = (value) => {
        //     const percentage = (value / time) * 100;
        //     progressBar.style.width = `${percentage}%`;
        //     progressText.innerHTML = `${value}`;
        // };

        const startBtn = document.querySelector(".start"),
            numQuestions = document.querySelector("#num-questions"),
            // timePerQuestion = document.querySelector("#time"),
            quiz = document.querySelector(".quiz"),
            startScreen = document.querySelector(".start-screen");

        let questions = [],
            time = 10,
            score = 0,
            currentQuestion,
            timer;

        const startQuiz = () => {
            questions = [{
                    "question": "What is the formula for Simple Present Tense for singular subjects (I, you, he/she/it)?",
                    "correct_answer": "Subject + Verb + -s/-es",
                    "incorrect_answers": ["Subject + Verb-ing", "Subject + Verb + -ed", "Subject + Verb + have/has"]
                },
                {
                    "question": "What is the formula for Simple Present Tense for plural subjects (we, you, they)?",
                    "correct_answer": "Subject + Verb + -s/-es",
                    "incorrect_answers": ["Subject + Verb-ing", "Subject + Verb + -ed", "Subject + Verb + have/has"]
                },
                {
                    "question": "What is added to the verb for singular subjects 'he', 'she', and 'it' in Simple Present Tense?",
                    "correct_answer": "-s/-es",
                    "incorrect_answers": ["-ing", "-ed", "have/has"]
                },
                {
                    "question": "How do you form negative sentences in Simple Present Tense for singular subjects?",
                    "correct_answer": "Subject + does not + Verb",
                    "incorrect_answers": ["Subject + do not + Verb", "Subject + did not + Verb",
                        "Subject + not + Verb"
                    ]
                },
                {
                    "question": "What is the formula for forming questions in Simple Present Tense?",
                    "correct_answer": "Do/Does + Subject + Verb",
                    "incorrect_answers": ["Subject + Verb + -s/-es", "Subject + Verb + -ed", "Subject + Verb-ing"]
                },
                {
                    "question": "What is the verb 'to be' form in Simple Present Tense for the subject 'I'?",
                    "correct_answer": "am",
                    "incorrect_answers": ["is", "are", "be"]
                },
                {
                    "question": "What is the verb 'to be' form in Simple Present Tense for the subject 'he'?",
                    "correct_answer": "is",
                    "incorrect_answers": ["am", "are", "be"]
                },
                {
                    "question": "What is the verb 'to be' form in Simple Present Tense for the subject 'they'?",
                    "correct_answer": "are",
                    "incorrect_answers": ["is", "am", "be"]
                },
                {
                    "question": "What is the formula for forming negative sentences in Simple Present Tense for plural subjects?",
                    "correct_answer": "Subject + do not + Verb",
                    "incorrect_answers": ["Subject + does not + Verb", "Subject + did not + Verb",
                        "Subject + not + Verb"
                    ]
                },
                {
                    "question": "How do you form questions in Simple Present Tense for singular subjects?",
                    "correct_answer": "Does + Subject + Verb",
                    "incorrect_answers": ["Do + Subject + Verb", "Are + Subject + Verb", "Is + Subject + Verb"]
                }
            ];
            setTimeout(() => {
                startScreen.classList.add("hide");
                quiz.classList.remove("hide");
                currentQuestion = 1;
                showQuestion(questions[0]);
            }, 1000);
        };

        startBtn.addEventListener("click", startQuiz);

        const showQuestion = (question) => {
            const questionText = document.querySelector(".question"),
                answersWrapper = document.querySelector(".answer-wrapper");
            questionNumber = document.querySelector(".number");

            questionText.innerHTML = question.question;

            const answers = [
                ...question.incorrect_answers,
                question.correct_answer.toString(),
            ];
            answersWrapper.innerHTML = "";
            answers.sort(() => Math.random() - 0.5);
            answers.forEach((answer) => {
                answersWrapper.innerHTML += `
                    <div class="answer ">
                <span class="text">${answer}</span>
                <span class="checkbox">
                  <i class="fas fa-check"></i>
                </span>
              </div>
            `;
            });

            questionNumber.innerHTML = ` Question <span class="current">${
                questions.indexOf(question) + 1
            }</span>
                <span class="total">/${questions.length}</span>`;
            //add event listener to each answer
            const answersDiv = document.querySelectorAll(".answer");
            answersDiv.forEach((answer) => {
                answer.addEventListener("click", () => {
                    if (!answer.classList.contains("checked")) {
                        answersDiv.forEach((answer) => {
                            answer.classList.remove("selected");
                        });
                        answer.classList.add("selected");
                        submitBtn.disabled = false;
                    }
                });
            });

            //tempat ganti waktu pertanyaan
            time = 10;
            startTimer(time);
        };

        const startTimer = (time) => {
            timer = setInterval(() => {
                if (time === 3) {
                    playAdudio("countdown.mp3");
                }
                if (time >= 0) {
                    progress(time);
                    time--;
                } else {
                    checkAnswer();
                }
            }, 1000);
        };

        // const loadingAnimation = () => {
        //     startBtn.innerHTML = "Loading";
        //     const loadingInterval = setInterval(() => {
        //         if (startBtn.innerHTML.length === 10) {
        //             startBtn.innerHTML = "Loading";
        //         } else {
        //             startBtn.innerHTML += ".";
        //         }
        //     }, 500);
        // };

        const submitBtn = document.querySelector(".submit"),
            nextBtn = document.querySelector(".next");
        submitBtn.addEventListener("click", () => {
            checkAnswer();
        });

        nextBtn.addEventListener("click", () => {
            nextQuestion();
            submitBtn.style.display = "block";
            nextBtn.style.display = "none";
        });

        const checkAnswer = () => {
            clearInterval(timer);
            const selectedAnswer = document.querySelector(".answer.selected");
            if (selectedAnswer) {
                const answer = selectedAnswer.querySelector(".text").innerHTML;
                console.log(currentQuestion);
                if (answer === questions[currentQuestion - 1].correct_answer) {
                    score++;
                    selectedAnswer.classList.add("correct");
                } else {
                    selectedAnswer.classList.add("wrong");
                    const correctAnswer = document
                        .querySelectorAll(".answer")
                        .forEach((answer) => {
                            if (
                                answer.querySelector(".text").innerHTML ===
                                questions[currentQuestion - 1].correct_answer
                            ) {
                                answer.classList.add("correct");
                            }
                        });
                }
            } else {
                const correctAnswer = document
                    .querySelectorAll(".answer")
                    .forEach((answer) => {
                        if (
                            answer.querySelector(".text").innerHTML ===
                            questions[currentQuestion - 1].correct_answer
                        ) {
                            answer.classList.add("correct");
                        }
                    });
            }
            const answersDiv = document.querySelectorAll(".answer");
            answersDiv.forEach((answer) => {
                answer.classList.add("checked");
            });

            submitBtn.style.display = "none";
            nextBtn.style.display = "block";
        };

        const nextQuestion = () => {
            if (currentQuestion < questions.length) {
                currentQuestion++;
                showQuestion(questions[currentQuestion - 1]);
            } else {
                showScore();
            }
        };

        const endScreen = document.querySelector(".end-screen"),
            finalScore = document.querySelector(".final-score"),
            totalScore = document.querySelector(".total-score");
        const showScore = () => {
            endScreen.classList.remove("hide");
            quiz.classList.add("hide");
            finalScore.innerHTML = score;
            totalScore.innerHTML = `/ ${questions.length}`;
        };

        const restartBtn = document.querySelector(".restart");
        restartBtn.addEventListener("click", () => {
            window.location.reload();
        });

        const playAdudio = (src) => {
            const audio = new Audio(src);
            audio.play();
        };
    </script>
@endsection
