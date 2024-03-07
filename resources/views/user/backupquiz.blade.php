@extends('layout.userlayout')
@section('konten')
    <style>
        @import url(https://fonts.googleapis.com/css?family=Poppins:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic);

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #000d58;
        }

        .container {
            position: relative;
            width: 100%;
            max-width: 400px;
            background: #1f2847;
            padding: 30px;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .heading {
            text-align: center;
            font-size: 40px;
            color: #fff;
            margin-bottom: 50px;
        }

        label {
            display: block;
            font-size: 12px;
            margin-bottom: 10px;
            color: #fff;
        }

        select {
            width: 100%;
            padding: 10px;
            border: none;
            text-transform: capitalize;
            border-radius: 5px;
            margin-bottom: 20px;
            background: #fff;
            color: #1f2847;
            font-size: 14px;
        }

        .start-screen .btn {
            margin-top: 50px;
        }

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
            background: linear-gradient(to right, #ea517c, #b478f1);
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

        .btn {
            width: 100%;
            height: 60px;
            background: #0c80ef;
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s linear;
        }

        .btn:hover {
            background: #0a6bc5;
        }

        .btn:disabled {
            background: #576081;
            cursor: not-allowed;
        }

        .btn.next {
            display: none;
        }

        .end-screen .score {
            color: #fff;
            font-size: 25px;
            font-weight: 500;
            margin-bottom: 80px;
            text-align: center;
        }

        .score .score-text {
            color: #a2aace;
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 120px;
        }

        @media (max-width: 468px) {
            .container {
                min-height: 100vh;
                max-width: 100%;
                border-radius: 0;
            }
        }
    </style>
    <div class="p-4 sm:ml-64  flex flex-auto justify-center">
        <div class="container">
            <div class="start-screen">
                <div class="settings">
                </div>
                <button class="btn start">Start Quiz</button>
            </div>
            <div class="quiz hide">
                <div class="timer">
                    <div class="progress">
                        <div class="progress-bar"></div>
                        <span class="progress-text"></span>
                    </div>
                </div>
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
                <button class="btn submit" disabled>Submit</button>
                <button class="btn next">Next</button>
            </div>
            <div class="end-screen hide">
                <h1 class="heading">Quiz App</h1>
                <div class="score">
                    <span class="score-text">Your score:</span>
                    <div>
                        <span class="final-score">0</span>
                        <span class="total-score">/10</span>
                    </div>
                </div>
                <button class="btn restart">Restart Quiz</button>
            </div>
        </div>
    </div>
    <script>
        const progressBar = document.querySelector(".progress-bar"),
            progressText = document.querySelector(".progress-text");

        const progress = (value) => {
            const percentage = (value / time) * 100;
            progressBar.style.width = `${percentage}%`;
            progressText.innerHTML = `${value}`;
        };

        const startBtn = document.querySelector(".start"),
            numQuestions = document.querySelector("#num-questions"),
            category = document.querySelector("#category"),
            difficulty = document.querySelector("#difficulty"),
            timePerQuestion = document.querySelector("#time"),
            quiz = document.querySelector(".quiz"),
            startScreen = document.querySelector(".start-screen");

        let questions = [],
            time = 10,
            score = 0,
            currentQuestion,
            timer;

        const startQuiz = () => {
            questions = [{
                    question: "Apa ibukota Indonesia?",
                    correct_answer: "Jakarta",
                    incorrect_answers: ["Bandung", "Surabaya", "Yogyakarta"]
                },
                {
                    question: "Siapakah presiden pertama Indonesia?",
                    correct_answer: "Soekarno",
                    incorrect_answers: ["Soeharto", "Jokowi", "Megawati"]
                },
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

        const loadingAnimation = () => {
            startBtn.innerHTML = "Loading";
            const loadingInterval = setInterval(() => {
                if (startBtn.innerHTML.length === 10) {
                    startBtn.innerHTML = "Loading";
                } else {
                    startBtn.innerHTML += ".";
                }
            }, 500);
        };

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
