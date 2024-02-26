@extends('layout.userlayout')
@section('konten')
    <style>
        .hide {
            display: none;
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
                <div
                    class="explanation-wrapper w-full mb-4 p-4 rounded-md text-violet-950 text-lg font-semibold bg-white hide">
                </div>
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
                <a href="{{ route('simple-present') }} " onclick="addExp(event)">
                    <button class="mb-6 w-full h-16 bg-blue-600 rounded-md text-white text-lg font-semibold">Back to
                        Menu</button>
                </a>
            </div>
        </div>
    </div>
    <script>
        function addExp(event) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajax({
                type: "POST",
                url: "{{ route('addexp') }}", 
                data: {
                    exp: 50,_token: csrfToken
                },
                success: function(response) {
                    window.location.href = "{{ route('simple-present') }}";
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            event.preventDefault();
        }

        const startBtn = document.querySelector(".start"),
            numQuestions = document.querySelector("#num-questions"),
            quiz = document.querySelector(".quiz"),
            explanationWrapper = document.querySelector(".explanation-wrapper"),
            startScreen = document.querySelector(".start-screen");

        let questions = [],
            score = 0,
            currentQuestion;

        const startQuiz = () => {
            questions = [{
                    "question": "What is the formula for Simple Present Tense for singular subjects (I, you, he/she/it)?",
                    "correct_answer": "Subject + Verb + -s/-es",
                    "incorrect_answers": ["Subject + Verb-ing", "Subject + Verb + -ed",
                        "Subject + Verb + have/has"
                    ],
                    "explanation": "Dalam Simple Present Tense, untuk subjek tunggal seperti 'he', 'she', dan 'it', kata kerja (verb) ditambahkan dengan -s/-es di akhir kata."
                },
                {
                    "question": "What is the formula for Simple Present Tense for plural subjects (we, you, they)?",
                    "correct_answer": "Subject + Verb + -s/-es",
                    "incorrect_answers": ["Subject + Verb-ing", "Subject + Verb + -ed",
                        "Subject + Verb + have/has"
                    ],
                    "explanation": "Untuk subjek jamak seperti 'we', 'you', dan 'they', kata kerja (verb) juga ditambahkan dengan -s/-es di akhir kata dalam Simple Present Tense."
                },
                {
                    "question": "What is added to the verb for singular subjects 'he', 'she', and 'it' in Simple Present Tense?",
                    "correct_answer": "-s/-es",
                    "incorrect_answers": ["-ing", "-ed", "have/has"],
                    "explanation": "Ketika kata kerja (verb) digunakan untuk subjek tunggal 'he', 'she', dan 'it', maka ditambahkan -s/-es di akhir kata."
                },
                {
                    "question": "How do you form negative sentences in Simple Present Tense for singular subjects?",
                    "correct_answer": "Subject + does not + Verb",
                    "incorrect_answers": ["Subject + do not + Verb", "Subject + did not + Verb",
                        "Subject + not + Verb"
                    ],
                    "explanation": "Untuk membentuk kalimat negatif dalam Simple Present Tense untuk subjek tunggal, gunakan 'does not' diikuti dengan kata kerja (verb) dalam bentuk dasar."
                },
                {
                    "question": "What is the formula for forming questions in Simple Present Tense?",
                    "correct_answer": "Do/Does + Subject + Verb",
                    "incorrect_answers": ["Subject + Verb + -s/-es", "Subject + Verb + -ed", "Subject + Verb-ing"],
                    "explanation": "Untuk membentuk kalimat tanya dalam Simple Present Tense, gunakan 'Do' atau 'Does' diikuti dengan subjek dan kata kerja (verb) dalam bentuk dasar."
                },
                {
                    "question": "What is the verb 'to be' form in Simple Present Tense for the subject 'I'?",
                    "correct_answer": "am",
                    "incorrect_answers": ["is", "are", "be"],
                    "explanation": "Kata kerja 'to be' memiliki bentuk 'am' saat digunakan dengan subjek 'I' dalam Simple Present Tense."
                },
                {
                    "question": "What is the verb 'to be' form in Simple Present Tense for the subject 'he'?",
                    "correct_answer": "is",
                    "incorrect_answers": ["am", "are", "be"],
                    "explanation": "Untuk subjek tunggal seperti 'he', kata kerja 'to be' memiliki bentuk 'is' dalam Simple Present Tense."
                },
                {
                    "question": "What is the verb 'to be' form in Simple Present Tense for the subject 'they'?",
                    "correct_answer": "are",
                    "incorrect_answers": ["is", "am", "be"],
                    "explanation": "Bentuk kata kerja 'to be' untuk subjek jamak seperti 'they' adalah 'are' dalam Simple Present Tense."
                },
                {
                    "question": "What is the formula for forming negative sentences in Simple Present Tense for plural subjects?",
                    "correct_answer": "Subject + do not + Verb",
                    "incorrect_answers": ["Subject + does not + Verb", "Subject + did not + Verb",
                        "Subject + not + Verb"
                    ],
                    "explanation": "Untuk subjek jamak, gunakan 'do not' diikuti dengan kata kerja (verb) dalam bentuk dasar untuk membentuk kalimat negatif dalam Simple Present Tense."
                },
                {
                    "question": "How do you form questions in Simple Present Tense for singular subjects?",
                    "correct_answer": "Does + Subject + Verb",
                    "incorrect_answers": ["Do + Subject + Verb", "Are + Subject + Verb", "Is + Subject + Verb"],
                    "explanation": "Untuk membentuk kalimat tanya untuk subjek tunggal, gunakan 'Does' diikuti dengan subjek dan kata kerja (verb) dalam bentuk dasar dalam Simple Present Tense."
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
        };

        const submitBtn = document.querySelector(".submit"),
            nextBtn = document.querySelector(".next");
        submitBtn.addEventListener("click", () => {
            checkAnswer();
            showExplanation(questions[currentQuestion - 1]);
        });

        nextBtn.addEventListener("click", () => {
            nextQuestion();
            submitBtn.style.display = "block";
            nextBtn.style.display = "none";
        });

        const checkAnswer = () => {
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

        const showExplanation = (question) => {
            explanationWrapper.innerHTML = `<p>${question.explanation}</p>`;
            explanationWrapper.classList.remove("hide");
            nextBtn.classList.remove("hide");
            submitBtn.classList.add("hide");
        };

        const nextQuestion = () => {
            explanationWrapper.classList.add("hide");
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
