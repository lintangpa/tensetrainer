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
                    style="background-image: url('{{ asset('image/DepanSekolah.jpg') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-transparent to-slate-900"></div>
                    <h2 class="text-2xl font-bold text-white shadow-black mb-4 z-10 relative">Bloom de Fleur</h2>
                </div>
            </div>
            <!-- Bagian cerita -->
            <div id="cerita">
                <div class="relative bg-cover bg-bottom h-full w-full mx-auto"
                    style="background-image: url('image/DepanSekolah.jpg'); ">
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
                    <div id="result" class="mt-4"></div>
                    <a id="backmenu" href="{{ route('simple-present') }} " onclick="updateProgress(event)"
                        style="display: none;">
                        <button class="mb-6 w-full h-16 bg-amber-600 rounded-md text-white text-lg font-semibold">Back to
                            Menu</button>
                    </a>
                    {{-- <button id="backmenu" onclick="updateProgress(event)" style="display: none;"
                        class="mb-6 w-full h-16 bg-amber-500 text-white px-4 py-2 rounded mt-4 hover:bg-amber-600 focus:outline-none focus:bg-amber-600 mx-auto text-lg font-semibold">
                        Back to Menu
                    </button> --}}

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //Script Cerita
        let ceritaIndex = 0;
        const ceritaContent = [
            "Today, Adelsten goes to Fred's house again to practice together. ",
            "But, there is bad news brought by Adelsten.",
            "What bad news does Adelsten convey?",
            "..."
        ];

        const ceritaDiv = document.getElementById('cerita');
        const pertanyaanDiv = document.getElementById('pertanyaan');
        const lanjutCeritaBtn = document.getElementById('lanjutCeritaBtn')
        const ceritaText = ceritaContent[ceritaIndex];
        const ceritaElement = document.getElementById('ceritaContent');
        let charIndex = 0;

        let timerElement = document.getElementById('timer');
        let timerInterval;

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
                startTimer(30);
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

        const questions = [{
                question: "Hello Adelsten, do you bring your book?",
                draggableWords: ["Sorry,", "my", "book", "is", "missing", "was", "are", "has", "isn't", "I", "forget",
                    "to", "bring", "it",
                ],
                correctAnswer: ["Sorry,", "my", "book", "is", "missing"],
                negativeAnswer: ["forget"],
                imagePath: "{{ asset('image/chara/Fred.png') }}",
                imageWrong: "{{ asset('image/chara/FredAngry.png') }}",
                imageCorrect: "{{ asset('image/chara/FredSmile.png') }}",
            },
            {
                question: "No need to be sad, Adelsten, there is always a way",
                draggableWords: ["Do", "we", "go", "to", "the", "library?", "Does", "Do", "Are", "Will"],
                correctAnswer: ["Do", "we", "go", "to", "the", "library?"],
                imagePath: "{{ asset('image/chara/Fred.png') }}",
                imageWrong: "{{ asset('image/chara/FredAngry.png') }}",
                imageCorrect: "{{ asset('image/chara/FredSmile.png') }}",
            },
            {
                question: "But I can't leave the house today, I have to clean the house because it's my routine",
                draggableWords: ["It's", "okay,", "We", "meet", "again", "tomorrow.", "met", "will", "meets"],
                correctAnswer: ["It's", "okay,", "We", "meet", "again", "tomorrow."],
                imagePath: "{{ asset('image/chara/Fred.png') }}",
                imageWrong: "{{ asset('image/chara/FredAngry.png') }}",
                imageCorrect: "{{ asset('image/chara/FredSmile.png') }}",
            },
        ];

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
            startTimer(30);
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
                const simplePresentPrompt =
                    ` Is this sentence in the simple present tense in either the interrogative, negative, or positive form? "${userAnswer}". answer with yes or no.`;

                const simplePresentResponse = await fetchOpenAI(simplePresentPrompt);
                const simplePresentData = await simplePresentResponse.json();
                const simplePresentAnswer = await simplePresentData.choices[0].text.trim().toLowerCase();
                let imageFred;
                let prompt;
                if (simplePresentAnswer === 'yes') {
                    const negativeAnswerPrompt =
                        `If on "${userAnswer}" there is "${currentQuestion.negativeAnswer}" then the answer is negative if not the answer is not negative. Is "${userAnswer}" considered a negative answer? Answer with yes or no.`;
                    const negativeAnswerResponse = await fetchOpenAI(negativeAnswerPrompt);
                    const negativeAnswerData = await negativeAnswerResponse.json();
                    const negativeAnswer = negativeAnswerData.choices[0].text.trim().toLowerCase();

                    if (negativeAnswer === 'yes') {
                        prompt =
                            `What should Fred response for "${userAnswer}" based on "${currentQuestion.negativeAnswer}" ? Response only Fred should say without any command. Fred response angry because answer is negative`;
                        karma += 1;
                        imageFred = currentQuestion.imageWrong;
                    } else {
                        prompt =
                        `What should Fred response for "${userAnswer}" based on "${currentQuestion.correctAnswer}"?  Response only Fred should say without any command. Fred response happy because ${userAnswer} using simple present tenses. Fred answer must based on context ${questions}`;
                        imageFred = currentQuestion.imageCorrect;
                    }
                } else {
                    const negativeAnswerPrompt =
                        `If on "${userAnswer}" there is "${currentQuestion.negativeAnswer}" then the answer is negative. Is "${userAnswer}" considered a negative answer? Answer with yes or no.`;
                    const negativeAnswerResponse = await fetchOpenAI(negativeAnswerPrompt);
                    const negativeAnswerData = await negativeAnswerResponse.json();
                    const negativeAnswer = negativeAnswerData.choices[0].text.trim().toLowerCase();

                    if (negativeAnswer === 'yes') {
                        prompt =
                            `What should Fred response for "${userAnswer}" based on "${currentQuestion.negativeAnswer}" ? Response only Fred should say without any command. Fred response angry because answer is negative`;
                        karma += 1;
                        imageFred = currentQuestion.imageWrong;
                    } else {
                        prompt =
                            `What should Fred response for "${userAnswer}" based on "${currentQuestion.correctAnswer}" ? Response only Fred should say without any command. Fred response confused because ${userAnswer} not using simple present tenses. feeling sad and confused. Fred answer must based on context ${questions}`;
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

        async function fetchOpenAI(prompt) {
            const response = await fetch('https://api.openai.com/v1/completions', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer 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'
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
            document.getElementById('result').innerHTML = `Final Score: ${karma}`;
            document.getElementById('checkBtn').style.display = 'none';
            document.getElementById('nextBtn').style.display = 'none';
            document.getElementById('backmenu').style.display = 'block';
        }

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function dragStart(ev) {
            ev.dataTransfer.setData("text", ev.target.textContent);
        }

        function drop(ev) {
            ev.preventDefault();
            const data = ev.dataTransfer.getData("text");
            sentence += data + ' ';
            ev.target.innerHTML += data + ' ';
        }

        function touchStart(ev) {
            ev.preventDefault();
            currentTouchTarget = ev.target;
        }

        function touchMove(ev) {
            ev.preventDefault();
        }

        function touchEnd(ev) {
            ev.preventDefault();
            if (currentTouchTarget) {
                sentence += currentTouchTarget.textContent + ' ';
                document.getElementById('droppable').innerHTML += currentTouchTarget.textContent + ' ';
                currentTouchTarget = null;
            }
        }

        // document.getElementById('backmenu').addEventListener('click', function(event) {
        //     updateProgress(event);
        // });

        function updateProgress(event) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajax({
                type: "POST",
                url: "{{ route('updateprogress1Q3') }}",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    karmaValue: karma / 2
                },
                success: function(response) {
                    addExp(event);
                    window.location.href = "{{ route('simple-present') }}";
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
            event.preventDefault();
        }

        function addExp(event) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajax({
                type: "POST",
                url: "{{ route('addexp') }}",
                data: {
                    exp: 50,
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
