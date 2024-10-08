@extends('layout.userlayout')
@section('konten')
    <style>
        .droppable {
            min-height: 50px;
            border: 2px dashed #4a5568;
            padding: 10px;
        }

        .draggable {
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .draggable:active {
            transform: scale(1.1);
        }
    </style>
    <div class="p-4 sm:ml-64">
        <!-- Bagian Header -->
        <div class=" p-1 rounded-lg shadow bg-white bg-opacity-15 backdrop-blur-lg">
            <div id="Header" class="mb-4">
                <div class="relative w-full bg-center mx-auto bg-cover bg-no-repeat rounded p-6 shadow-md text-center"
                    style="background-image: url('{{ asset('image/rumahAdelsten.jpg') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-transparent to-slate-900"></div>
                    <h2 class="text-2xl font-bold text-white shadow-black mb-4 z-10 relative">Past Continuous 1</h2>
                </div>
            </div>
            <!-- Bagian cerita -->
            <div id="cerita">
                <div class="relative bg-cover bg-bottom h-full w-full mx-auto"
                    style="background-image: url('image/rumahAdelsten.jpg'); ">
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
                    <div id="timer" class="mb-2 text-amber-500">Timer: 00:00</div>
                    <div id="isipertanyaan">
                        <div class="mb-4">
                            <div class="question-container flex items-center">
                                <p class="inline"></p>
                            </div>
                            <div class="droppable mt-4" id="droppable" ondrop="drop(event)" ondragover="allowDrop(event)">
                            </div>
                        </div>
                        <div class="draggable-container flex flex-wrap">
                            {{-- <div class="draggable bg-gray-200 rounded p-2 m-1" draggable="true" ontouchstart="touchStart(event)"
                            ontouchmove="touchMove(event)" ontouchend="touchEnd(event)" ondragstart="dragStart(event)"></div> --}}
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
                    <div id="result" class="mt-4 text-center font-semibold text-xl"></div>
                    <a id="backmenu" href="{{ route('past-continuous') }} " onclick="" style="display: none;">
                        <button
                            class="mb-6 w-full h-16 bg-amber-500 text-white px-4 py-2 rounded mt-4 hover:bg-amber-600 focus:outline-none focus:bg-amber-600 mx-auto text-lg font-semibold">Back
                            to
                            Menu</button>
                    </a>
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
                // if (ceritaIndex === 2) {
                //     pertanyaanDiv.style.display = 'block';
                //     ceritaDiv.style.display = 'none';
                // }
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

        //Script dragndrop2
        let currentTouchTarget = null;
        let sentence = '';
        let currentQuestionIndex = 0;
        initializeQuestion(currentQuestionIndex);
        let correctAnswersCount = 0;

        function initializeQuestion(index) {
            const question = questions[index];
            const questionElement = document.querySelector('.question-container');
            const wordsContainer = document.querySelector('.draggable-container');
            // const questionTitleElement = document.querySelector('.question-container p');
            const questionHTML =
                `<img src="${question.imagePath}" alt="Question Image" class="inline-block mr-2 w-10 h-10"> <p>${question.question}</p>`;
            document.querySelector('.question-container').innerHTML = questionHTML;
            wordsContainer.innerHTML = '';
            const shuffledDraggableWords = shuffleArray(question.draggableWords);
            shuffledDraggableWords.forEach(word => {
                const draggableElement = createDraggableElement(word);
                wordsContainer.appendChild(draggableElement);
            });
            startTimer(timertotal);
        }

        function createDraggableElement(word) {
            const draggableElement = document.createElement('div');
            draggableElement.textContent = word;
            draggableElement.classList.add('draggable', 'bg-gray-200', 'rounded', 'p-2', 'm-1');
            draggableElement.setAttribute('draggable', true);
            draggableElement.setAttribute('ontouchstart', 'touchStart(event)');
            draggableElement.setAttribute('ontouchmove', 'touchMove(event)');
            draggableElement.setAttribute('ontouchend', 'touchEnd(event)');
            draggableElement.setAttribute('ondragstart', 'dragStart(event)');
            return draggableElement;
        }

        // Fungsi acak
        function shuffleArray(array) {
            const shuffledArray = array.slice();
            for (let i = shuffledArray.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [shuffledArray[i], shuffledArray[j]] = [shuffledArray[j], shuffledArray[
                    i]];
            }
            return shuffledArray;
        }

        document.getElementById('resetBtn').addEventListener('click', function() {
            document.getElementById('droppable').innerHTML = '';
            const resultElement = document.getElementById('result');
            resultElement.innerHTML = '';
            sentence = '';
        });

        document.getElementById('nextBtn').addEventListener('click', function() {
            currentQuestionIndex++;
            stopTimer();
            if (currentQuestionIndex < questions.length) {
                initializeQuestion(currentQuestionIndex);
                document.getElementById('droppable').innerHTML = '';
                document.getElementById('result').innerHTML = '';
                sentence = '';
                document.getElementById('nextBtn').style.display = 'none';
                document.getElementById('resetBtn').style.display = 'block';
                document.getElementById('checkBtn').style.display = 'block';
            } else {
                document.getElementById('isipertanyaan').style.display = 'none';
                showResult();
            }
            //cerita setelah berapa kalimat?
            // if (answeredQuestionsCount === 2) {
            //     document.getElementById('pertanyaan').style.display = 'none';
            //     document.getElementById('cerita').style.display = 'block';
            //     return;
            // }
        });
        let karma = 0;
        let answeredQuestionsCount = 0;

        document.getElementById('checkBtn').addEventListener('click', async function() {
            try {
                const currentQuestion = questions[currentQuestionIndex];
                const nextQuestion = questions[currentQuestionIndex + 1];
                const userAnswer = sentence.trim();
                const pastContinuousPrompt =
                    `Is this sentence in the past continuous tense in either the interrogative, negative, or positive form? "${userAnswer}". answer with yes or no.`;
                const pastContinuousResponse = await fetchOpenAI(pastContinuousPrompt);
                const pastContinuousData = await pastContinuousResponse.json();
                const pastContinuousAnswer = await pastContinuousData.choices[0].text.trim().toLowerCase();
                let imageFred;
                let prompt;
                if (pastContinuousAnswer === 'yes') {
                    correctAnswersCount++;
                    const negativeAnswerPrompt =
                        `If on "${userAnswer}" there is "${currentQuestion.negativeAnswer}" then the answer is negative if not the answer is not negative. Is "${userAnswer}" considered a negative answer? Answer with yes or no.`;
                    const negativeAnswerResponse = await fetchOpenAI(negativeAnswerPrompt);
                    const negativeAnswerData = await negativeAnswerResponse.json();
                    const negativeAnswer = negativeAnswerData.choices[0].text.trim().toLowerCase();

                    if (negativeAnswer === 'yes') {
                        prompt =
                            `What should Fred response for "${userAnswer}" based on "${currentQuestion.negativeAnswer}" ? Response only Fred should say without any command. Fred response sad because answer is negative.Fred answer must based on context ${questions}. response is not shown for rose`;
                        karma += 1;
                        imageFred = currentQuestion.imagePath;
                    } else {
                        prompt =
                            `What should Fred response for "${userAnswer}" based on "${currentQuestion.correctAnswer}"? Fred's response must be a question that the answer is ${currentQuestion.correctAnswer}.Fred answer must based on context ${questions}.response is not shown for rose`;
                        imageFred = currentQuestion.imageCorrect;
                    }
                } else {
                    const negativeAnswerPrompt =
                        `If on "${userAnswer}" there is "${currentQuestion.negativeAnswer}" then the answer is negative if not the answer is not negative. Is "${userAnswer}" considered a negative answer? Answer with yes or no.`;
                    const negativeAnswerResponse = await fetchOpenAI(negativeAnswerPrompt);
                    const negativeAnswerData = await negativeAnswerResponse.json();
                    const negativeAnswer = negativeAnswerData.choices[0].text.trim().toLowerCase();

                    if (negativeAnswer === 'yes') {
                        prompt =
                            `Dimana letak kesalahan dari “${userAnswer}” dan apa yang perlu diubah agar menjadi past continuous tense? Pembetulan harus berdasar pada "${currentQuestion.correctAnswer}. Jawab dengan marah karena terdapat "${currentQuestion.negativeAnswer}"`;
                        karma += 1;
                        imageFred = currentQuestion.imageWrong;
                    } else {
                        prompt =
                            `Jawab dengan maksimal 25 kata dimana letak kesalahan dari “${userAnswer}” dan apa yang perlu diubah agar menjadi past continuous tense? Pembetulan harus berdasar pada "${currentQuestion.correctAnswer}"`;
                        imageFred = currentQuestion.imageWrong;
                    }
                }

                const response = await fetchOpenAI(prompt);
                const data = await response.json();
                const userAnswerWithoutPunctuation = userAnswer.replace(/[^\w\s]/g, '');

                if (data && data.choices && data.choices.length > 0 && data.choices[0].text) {
                    const generatedText = data.choices[0].text.trim();
                    Swal.fire({
                        text: generatedText,
                        imageUrl: imageFred,
                        imageWidth: 100,
                        imageHeight: 100
                    });
                    stopTimer();
                    document.getElementById('nextBtn').style.display = 'block';
                    document.getElementById('resetBtn').style.display = 'none';
                    document.getElementById('checkBtn').style.display = 'none';
                } else {
                    console.error('Error', data);
                    Swal.fire({
                        text: 'Please try another answer',
                        imageUrl: currentQuestion.imageWrong,
                        imageWidth: 100,
                        imageHeight: 100
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    text: 'Please try another answer',
                    imageUrl: currentQuestion.imageWrong,
                    imageWidth: 100,
                    imageHeight: 100
                });
            }
        });

        window.OPENAI_API_KEY = "{{ env('OPENAI_API_KEY') }}";

        async function fetchOpenAI(prompt) {
            const response = await fetch('https://api.openai.com/v1/completions', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${window.OPENAI_API_KEY}`
                },
                body: JSON.stringify({
                    model: 'gpt-3.5-turbo-instruct',
                    prompt: prompt,
                    max_tokens: 50,
                    temperature: 0.7
                })
            });
            return response;
        }

        function showResult() {
            let resultText = '';
            if (correctAnswersCount >= 2) {
                resultText = `Congratulations! You can proceed.`;
                imagePath = 'image/chara/adelstenSmile.png';
            } else {
                resultText = `Oops! You didn't pass.`;
                imagePath = 'image/chara/adelstenAngry.png';
            }

            resultText += `<div class="flex justify-center mt-4"><img src="${imagePath}" alt="Fred" class="w-32 h-32 object-contain"></div>`;

            document.getElementById('result').innerHTML = resultText;
            document.getElementById('timer').style.display = 'none';
            document.getElementById('checkBtn').style.display = 'none';
            document.getElementById('nextBtn').style.display = 'none';
            document.getElementById('backmenu').style.display = 'block';
        }

        let touchStartX, touchStartY;
        let draggableElement;

        // Fungsi touchStart
        function touchStart(event) {
            event.preventDefault();
            touchStartX = event.touches[0].clientX;
            touchStartY = event.touches[0].clientY;
            draggableElement = event.target;
        }

        // Fungsi touchMove
        function touchMove(event) {
            event.preventDefault();
            const touchX = event.touches[0].clientX;
            const touchY = event.touches[0].clientY;
            const deltaX = touchX - touchStartX;
            const deltaY = touchY - touchStartY;
            if (draggableElement) {
                draggableElement.style.transform = `translate(${deltaX}px, ${deltaY}px)`;
            }
        }

        // Fungsi touchEnd
        function touchEnd(event) {
            event.preventDefault();
            if (draggableElement) {
                draggableElement.style.transition = 'transform 0.2s ease';
                draggableElement.style.transform = 'translate(0, 0)';
                sentence += draggableElement.textContent + ' ';
                document.getElementById('droppable').innerHTML += draggableElement.textContent + ' ';
                draggableElement = null;
            }
        }

        // Fungsi allowDrop
        function allowDrop(ev) {
            ev.preventDefault();
        }

        // Fungsi dragStart
        function dragStart(ev) {
            ev.dataTransfer.setData("text", ev.target.textContent);
        }

        // Fungsi drop
        function drop(ev) {
            ev.preventDefault();
            const data = ev.dataTransfer.getData("text");
            sentence += data + ' ';
            ev.target.innerHTML += data + ' ';
        }

        document.getElementById('backmenu').addEventListener('click', function(event) {
            if (correctAnswersCount >= 2) {
                updateProgress(event);
            } else {
                window.location.href = "{{ route('past-continuous') }}";
            }
        });

        function updateProgress(event) {
            var correctPercentage = (correctAnswersCount / questions.length) * 100;
            if (correctPercentage >= 50) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                $.ajax({
                    type: "POST",
                    url: "{{ route('updateprogress4Q1') }}",
                    data: {
                        _token: csrfToken
                    },
                    success: function(response) {
                        addExp(event);
                        window.location.href = "{{ route('past-continuous') }}";
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                addExp(event);
                window.location.href = "{{ route('past-continuous') }}";
            }
            event.preventDefault();
        }

        function addExp(event) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajax({
                type: "POST",
                url: "{{ route('addexp') }}",
                data: {
                    exp: 50*correctAnswersCount/2.7,
                    _token: csrfToken
                },
                success: function(response) {},
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            event.preventDefault();
        }

        //kontrol musik
        document.addEventListener("DOMContentLoaded", function() {
            var audio = document.getElementById("bgMusic");
            if (audio) {
                audio.volume = 0.1;
            } else {
                console.error("Audio element not found");
            }
        });
    </script>

    {{-- <audio id="bgMusic" loop autoplay>
        <source src="{{ asset('Bloom.mp3') }}" type="audio/mpeg">
    </audio> --}}
@endsection
