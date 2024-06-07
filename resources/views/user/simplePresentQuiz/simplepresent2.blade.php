@extends('layout.userlayout')
@section('konten')
    <style>
        .question-container {
            margin-bottom: 20px;
        }

        .question-container img {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
            width: 50px;
            height: 50px;
        }

        .answers-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .answer {
            background-color: #f3f4f6;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .answer:hover {
            background-color: #e5e7eb;
        }

        .answer input {
            margin-right: 10px;
        }
    </style>
    <div class="p-4 sm:ml-64">
        <!-- Bagian Header -->
        <div class=" p-1 rounded-lg shadow bg-white bg-opacity-15 backdrop-blur-lg">
            <div id="Header" class="mb-4">
                <div class="relative w-full bg-center mx-auto bg-cover bg-no-repeat rounded p-6 shadow-md text-center"
                    style="background-image: url('{{ asset('image/rumahFred.jpg') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-transparent to-slate-900"></div>
                    <h2 class="text-2xl font-bold text-white shadow-black mb-4 z-10 relative">SIMPLE PRESENT 2</h2>
                </div>
            </div>
            <!-- Bagian cerita -->
            <div id="cerita">
                <div class="relative bg-cover bg-bottom h-full w-full mx-auto"
                    style="background-image: url('image/rumahFred.jpg'); ">
                    <div class="absolute inset-0 bg-gradient-to-t from-transparent to-slate-900"></div>
                    <div class="w-full mx-auto rounded p-6 shadow-md text-center relative z-10">
                        <p id="ceritaContent" class="text-white"></p>
                        <button id="lanjutCeritaBtn"
                            class="bg-amber-500 text-white px-4 py-2 rounded mt-4 hover:bg-amber-600 focus:outline-none focus:bg-amber-600 mx-auto"
                            style="display:none;">Next</button>
                    </div>
                </div>
            </div>
            <!-- Bagian Pertanyaan -->
            <div id="pertanyaan" style="display: none;">
                <div class="w-full mx-auto bg-white rounded p-6 shadow-md">
                    <div class="flex justify-between items-center mb-2">
                        <div id="timer" class="text-amber-500">Timer: 00:00</div>
                        <button id="showCeritaBtn" class="bg-green-500 text-white p-2 rounded-full hover:bg-green-600 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                                <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        
                    </div>
                    <div id="isipertanyaan">
                        <div class="mb-4">
                            <div class="question-container">
                                <p class="inline"></p>
                            </div>
                            <div class="answers-container" id="answers-container">
                                <!-- Pilihan jawaban akan dimasukkan di sini -->
                            </div>
                        </div>
                        <div class="flex mt-4">
                            <button id="resetBtn"
                                class="flex-1 bg-gray-500 text-white px-4 py-2 rounded mt-4 mr-2 hover:bg-gray-600 focus:outline-none focus:bg-gray-600">Reset
                            </button>
                            <button id="checkBtn"
                                class="flex-1 bg-amber-500 text-white px-4 py-2 rounded mt-4 mr-2 hover:bg-amber-600 focus:outline-none focus:bg-amber-600">Check
                                Answer</button>
                            <button id="nextBtn"
                                class="flex-1 bg-amber-500 text-white px-4 py-2 rounded mt-4 mr-2 hover:bg-amber-600 focus:outline-none focus:bg-amber-600"
                                style="display: none;">Next
                            </button>
                        </div>
                    </div>
                    <div id="result" class="mt-4 text-center font-semibold text-xl">

                    </div>
                    <button id="backmenu" onclick="" style="display: none;"
                        class="mb-6 w-full h-16 bg-amber-500 text-white px-4 py-2 rounded mt-4 hover:bg-amber-600 focus:outline-none focus:bg-amber-600 mx-auto text-lg font-semibold">
                        Back to Menu
                    </button>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //Script Cerita
        let ceritaIndex = 0;
        const ceritaContent = @json($ceritaContent);
        const questions = @json($questions);
        const ceritaDiv = document.getElementById('cerita');
        const pertanyaanDiv = document.getElementById('pertanyaan');
        const lanjutCeritaBtn = document.getElementById('lanjutCeritaBtn')
        const ceritaText = ceritaContent[ceritaIndex];
        const ceritaElement = document.getElementById('ceritaContent');
        let charIndex = 0;

        let timerElement = document.getElementById('timer');
        let timerInterval;
        let timertotal = {{ $timertotal }};

        function startTimer(durationInSeconds) {
            let timer = durationInSeconds;
            timerInterval = setInterval(function() {
                let minutes = Math.floor(timer / 60);
                let seconds = timer % 60;

                minutes = minutes < 10 ? '0' + minutes : minutes;
                seconds = seconds < 10 ? '0' + seconds : seconds;

                timerElement.textContent = 'Timer: ' + minutes + ':' + seconds;

                if (--timer < 0) {
                    clearInterval(timerInterval);
                    Swal.fire({
                        icon: 'info',
                        title: 'Time is over!',
                        text: 'You ran out of time.',
                    });
                    document.getElementById('nextBtn').style.display = 'block';
                    document.getElementById('resetBtn').style.display = 'none';
                    document.getElementById('checkBtn').style.display = 'none';
                }
            }, 1000);
        }

        function stopTimer() {
            clearInterval(timerInterval);
        }

        function typeWriter() {
            if (charIndex < ceritaText.length) {
                ceritaElement.textContent += ceritaText.charAt(charIndex);
                charIndex++;
                setTimeout(typeWriter, 20);
                stopTimer();
            } else {
                lanjutCeritaBtn.style.display = 'block';
                stopTimer();
            }
        }

        typeWriter();

        lanjutCeritaBtn.addEventListener('click', function() {
            ceritaIndex++;
            if (ceritaIndex < ceritaContent.length) {
                const currentCerita = ceritaContent[ceritaIndex];
                clearInterval(typingInterval);
                displayCerita(currentCerita);
                lanjutCeritaBtn.style.display = 'none';
                stopTimer();
                // Cerita setelah berapa kalimat?
                if (ceritaIndex === 2) {
                    pertanyaanDiv.style.display = 'block';
                    ceritaDiv.style.display = 'none';
                    startTimer(timertotal);
                }

            } else {
                stopTimer();
                ceritaDiv.style.display = 'none';
                pertanyaanDiv.style.display = 'block';
                startTimer(timertotal);
            }
        });


        let typingInterval;

        function displayCerita(cerita) {
            stopTimer();
            const ceritaElement = document.getElementById('ceritaContent');
            ceritaElement.textContent = '';
            let charIndex = 0;
            typingInterval = setInterval(function() {
                ceritaElement.textContent += cerita[charIndex];
                if (charIndex === cerita.length - 1) {
                    clearInterval(typingInterval);
                    lanjutCeritaBtn.style.display = 'block';
                }
                charIndex++;
            }, 20); // makin kecil makin cepet
        }

        // Script Multiple Choice
        let currentQuestionIndex = 0;
        initializeQuestion(currentQuestionIndex);
        let correctAnswersCount = 0;

        function initializeQuestion(index) {
            const question = questions[index];
            const questionElement = document.querySelector('.question-container');
            const answersContainer = document.getElementById('answers-container');

            const shuffledAnswers = question.draggableWords.sort(() => Math.random() - 0.5); // Acak pilihan jawaban

            const questionHTML = `
        <img src="${question.imagePath}" alt="Question Image">
        <p>${question.question}</p>
    `;
            questionElement.innerHTML = questionHTML;

            answersContainer.innerHTML = '';
            shuffledAnswers.forEach((answer, i) => {
                const answerHTML = `
            <label class="answer">
                <input type="radio" name="answer" value="${answer}">
                ${answer}
            </label>
        `;
                answersContainer.innerHTML += answerHTML;
            });
            startTimer(timertotal);
        }


        document.getElementById('resetBtn').addEventListener('click', resetChoices);

        function resetChoices() {
            const answersContainer = document.getElementById('answers-container');
            const radioButtons = answersContainer.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(radio => {
                radio.checked = false;
            });
        }

        document.getElementById('checkBtn').addEventListener('click', checkAnswer);

        function checkAnswer() {
            const answersContainer = document.getElementById('answers-container');
            const selectedAnswer = answersContainer.querySelector('input[type="radio"]:checked');

            if (!selectedAnswer) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select an answer!',
                });
                return;
            }

            const selectedAnswerText = selectedAnswer.value;
            const correctAnswerText = questions[currentQuestionIndex].correctAnswer;

            if (selectedAnswerText === correctAnswerText) {
                Swal.fire({
                    icon: 'success',
                    title: 'Correct!',
                    text: 'Your answer is correct.',
                });
                correctAnswersCount++;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Wrong!',
                    text: 'Your answer is incorrect.',
                });
            }

            stopTimer();
            document.getElementById('nextBtn').style.display = 'block';
            document.getElementById('resetBtn').style.display = 'none';
            document.getElementById('checkBtn').style.display = 'none';
        }

        document.getElementById('nextBtn').addEventListener('click', function() {
            currentQuestionIndex++;

            if (currentQuestionIndex < questions.length) {
                initializeQuestion(currentQuestionIndex);
                document.getElementById('nextBtn').style.display = 'none';
                document.getElementById('resetBtn').style.display = 'block';
                document.getElementById('checkBtn').style.display = 'block';
                resetChoices();
            } else {
                document.getElementById('pertanyaan').style.display = 'none';
                document.getElementById('result').textContent = 'Quiz completed! Correct answers: ' +
                    correctAnswersCount;
                document.getElementById('backmenu').style.display = 'block';
            }
        });


        document.getElementById('nextBtn').addEventListener('click', function() {
            currentQuestionIndex++;
            if (currentQuestionIndex < questions.length) {
                initializeQuestion(currentQuestionIndex);
                resetChoices();
                document.getElementById('nextBtn').style.display = 'none';
                document.getElementById('resetBtn').style.display = 'block';
                document.getElementById('checkBtn').style.display = 'block';
            } else {
                showResults();
            }
        });

        function showResults() {
            const resultContainer = document.getElementById('result');
            resultContainer.innerHTML =
                `You answered ${correctAnswersCount} out of ${questions.length} questions correctly.`;
            document.getElementById('backmenu').style.display = 'block';
        }

        document.getElementById('showCeritaBtn').addEventListener('click', function() {
            Swal.fire({
                title: 'Context',
                html: ceritaContent.join('<br>'),
                confirmButtonText: 'Close'
            });
        });
    </script>
@endsection
