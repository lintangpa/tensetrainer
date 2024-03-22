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
        <div class=" p-6 rounded-lg shadow bg-white bg-opacity-15 backdrop-blur-lg">
        <div id="Header" class="mb-4">
            <div class="relative w-full bg-center mx-auto bg-cover bg-no-repeat rounded p-6 shadow-md text-center" style="background-image: url('{{ asset('image/DepanSekolah.jpg') }}');">
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
        <div id="pertanyaan" style="display: none;">
            <div class="w-full mx-auto bg-white rounded p-6 shadow-md">
                <div id="isipertanyaan">
                    <div class="mb-4">
                        <div class="question-container flex items-center">
                            <p class="inline"></p>
                        </div>
                        <div class="droppable mt-4" id="droppable" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
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
    <script>
        //Script Cerita
        let ceritaIndex = 0;
        const ceritaContent = [
            "Fred and Adelsten are two young wizards attending the prestigious Magic Academy.",
            "Fred, a curious and adventurous soul, has always been fascinated by the wonders of magic and the mysteries of the world. ",
            "Adelsten, on the other hand, is known for his calm demeanor and his deep connection with nature.",
            "Despite their different personalities, Fred and Adelsten have been best friends since their first day at the academy.",
            "They share a mutual love for exploring the magical world around them and are always seeking new adventures together."
        ];

        const ceritaDiv = document.getElementById('cerita');
        const pertanyaanDiv = document.getElementById('pertanyaan');
        const lanjutCeritaBtn = document.getElementById('lanjutCeritaBtn')
        const ceritaText = ceritaContent[ceritaIndex];
        const ceritaElement = document.getElementById('ceritaContent');
        let charIndex = 0;


        function typeWriter() {
            if (charIndex < ceritaText.length) {
                ceritaElement.textContent += ceritaText.charAt(charIndex);
                charIndex++;
                setTimeout(typeWriter, 20);
            } else {
                lanjutCeritaBtn.style.display = 'block';
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

                // Cerita setelah berapa kalimat?
                // if (ceritaIndex === 2) {
                //     pertanyaanDiv.style.display = 'block';
                //     ceritaDiv.style.display = 'none';
                // }
            } else {
                ceritaDiv.style.display = 'none';
                pertanyaanDiv.style.display = 'block';
            }
        });


        let typingInterval;

        function displayCerita(cerita) {
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
                question: "Fred: Adelsten, do you know about the ancient magic of blooming flowers?",
                draggableWords: ["Yes,", "I", "do.", "It's", "fascinating", "how", "magic", "enhances", "the", "beauty",
                    "of", "nature.", "Apple", "table", "blue", "jump"
                ],
                correctAnswer: ["Yes,", "I", "do.", "It's", "fascinating", "how", "magic", "enhances", "the", "beauty",
                    "of", "nature."
                ],
                imagePath: "{{ asset('image/chara/Fred.png') }}",
                imageWrong: "{{ asset('image/chara/FredAngry.png') }}",
                imageCorrect: "{{ asset('image/chara/FredSmile.png') }}",
                wrongAnswer: "I don't understand what you say!?",
                correct: "*Smile*"
            },
            {
                question: "Fred: I practice a spell to make flowers bloom instantly.",
                draggableWords: ["That", "sounds", "incredible!", "Imagine", "walking", "through", "a", "garden", "and",
                    "seeing", "flowers.", "sky", "delicious", "joyful", "unexpected"
                ],
                correctAnswer: ["That", "sounds", "incredible!", "Imagine", "walking", "through", "a", "garden", "and",
                    "seeing", "flowers."
                ],
                imagePath: "{{ asset('image/chara/Fred.png') }}",
                imageWrong: "{{ asset('image/chara/FredAngry.png') }}",
                imageCorrect: "{{ asset('image/chara/FredSmile.png') }}",
                wrongAnswer: "I don't understand what you say!?",
                correct: "*Grint*"
            },
            {
                question: "Fred: It's like painting the world with colors and fragrance.",
                draggableWords: ["Exactly!", "We", "can", "create", "the", "most", "mesmerizing", "floral", "displays.",
                    "sky", "mountain", "garden"
                ],
                correctAnswer: ["Exactly!", "We", "can", "create", "the", "most", "mesmerizing", "floral", "displays."],
                imagePath: "{{ asset('image/chara/Fred.png') }}",
                imageWrong: "{{ asset('image/chara/FredAngry.png') }}",
                imageCorrect: "{{ asset('image/chara/FredSmile.png') }}",
                wrongAnswer: "I don't understand what you say!?",
                correct: "*Grint*"
            },
            {
                question: "Fred: I can't wait to master this spell and share it with others.",
                draggableWords: ["Let's", "practice", "together", "after", "school", "and", "see", "how", "many",
                    "flowers", "we", "can", "bloom.", "beautiful", "colorful", "blossom", "chair", "lamp", "book"
                ],
                correctAnswer: ["Let's", "practice", "together", "after", "school", "and", "see", "how", "many",
                    "flowers", "we", "can", "bloom."
                ],
                imagePath: "{{ asset('image/chara/Fred.png') }}",
                imageWrong: "{{ asset('image/chara/FredAngry.png') }}",
                imageCorrect: "{{ asset('image/chara/FredSmile.png') }}",
                wrongAnswer: "I don't understand what you say!?",
                correct: "*Grint*"
            }
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

        // Fungsi untuk mengacak 
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

        let answeredQuestionsCount = 0;

        document.getElementById('checkBtn').addEventListener('click', function() {
            const resultElement = document.getElementById('result');
            const currentQuestion = questions[currentQuestionIndex];
            const userAnswer = sentence.trim().split(" ");
            let isCorrect = true;

            if (sentence.trim() === '') {
                resultElement.innerHTML = "<p class='text-red-500'>Kalimat tidak boleh kosong!</p>";
                return;
            }
            for (let i = 0; i < currentQuestion.correctAnswer.length; i++) {
                if (userAnswer[i] !== currentQuestion.correctAnswer[i]) {
                    isCorrect = false;
                    break;
                }
            }
            if (isCorrect) {
                answeredQuestionsCount++;
                Swal.fire({
                    text: currentQuestion.correct,
                    imageUrl: currentQuestion.imageCorrect,
                    imageWidth: 100,
                    imageHeight: 100
                    // timer: 2000,
                    // showConfirmButton: false
                });
                document.getElementById('resetBtn').style.display = 'none';
                document.getElementById('checkBtn').style.display = 'none';
                document.getElementById('nextBtn').style.display = 'block';
                correctAnswersCount++;
            } else {
                answeredQuestionsCount++;
                Swal.fire({
                    text: currentQuestion.wrongAnswer,
                    imageUrl: currentQuestion.imageWrong,
                    imageWidth: 100,
                    imageHeight: 100
                    // timer: 2000,
                    // showConfirmButton: false
                });
                document.getElementById('resetBtn').style.display = 'none';
                document.getElementById('checkBtn').style.display = 'none';
                document.getElementById('nextBtn').style.display = 'block';
            }
        });

        function showResult() {
            document.getElementById('result').innerHTML = `Jumlah jawaban benar: ${correctAnswersCount}`;
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

        function updateProgress(event) {
            var correctPercentage = (correctAnswersCount / questions.length) * 100;
            if (correctPercentage >= 50) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                $.ajax({
                    type: "POST",
                    url: "{{ route('updateprogress1Q3') }}",
                    data: {
                        _token: csrfToken
                    },
                    success: function(response) {
                        addExp(event);
                        window.location.href = "{{ route('simple-present') }}";
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                addExp(event);
                window.location.href = "{{ route('simple-present') }}";
            }
            event.preventDefault();
        }


        function addExp(event) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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
        //batas script drag n drop 2

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

    <audio id="bgMusic" loop autoplay>
        <source src="{{ asset('Bloom.mp3') }}" type="audio/mpeg">
    </audio>
@endsection