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
        <div id="Header" class="mb-4">
            <div class="w-full mx-auto bg-cover bg-center bg-no-repeat rounded p-6 shadow-md text-center"
                style="background-image: url('{{ asset('image/sekolah 1.jpg') }}');">
                <!-- Tambahkan Header di sini -->
                <h2 class="text-xl font-bold text-white mb-4">Quiz Simple Present Tense</h2>
            </div>
        </div>
        <!-- Bagian cerita -->
        <div id="cerita">
            <div class="relative bg-cover bg-bottom w-full mx-auto" style="background-image: url('image/sekolah 1.jpg');">
                <div class="absolute inset-0 bg-gradient-to-t from-transparent to-white"></div>
                <div class="w-full mx-auto rounded p-6 shadow-md text-center relative z-10">
                    <p id="ceritaContent"></p>
                    <button id="lanjutCeritaBtn"
                        class="bg-indigo-500 text-white px-4 py-2 rounded mt-4 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600 mx-auto"
                        style="display:none;">Next</button>
                </div>
            </div>
        </div>
        <div id="pertanyaan" style="display: none;">
            <div class="w-full mx-auto bg-white rounded p-6 shadow-md">
                <div id="isipertanyaan">
                    <h2 class="text-xl font-semibold mb-4">Drag and Drop Kalimat Rumpang</h2>
                    <div class="mb-4">
                        <div class="question-container">
                            <p></p>
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
                            class="flex-1 bg-indigo-500 text-white px-4 py-2 rounded mt-4 mr-2 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Check Answer</button>
                        <button id="nextBtn"
                            class="flex-1 bg-indigo-500 text-white px-4 py-2 rounded mt-4 mr-2 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600" style="display: none;">Next
                        </button>
                    </div>
                </div>
                <div id="result" class="mt-4"></div>
                <a id="backmenu" href="{{ route('simple-present') }} " onclick="updateProgress(event)"
                    style="display: none;">
                    <button class="mb-6 w-full h-16 bg-indigo-500 text-white px-4 py-2 rounded mt-4 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600 mx-auto text-lg font-semibold">Back to
                        Menu</button>
                </a>
            </div>
        </div>
    </div>

    <script>
        //Script Cerita
        let ceritaIndex = 0;
        const ceritaContent = [
            "Ini adalah kalimat pertama dalam cerita.",
            "Ini adalah kalimat kedua dalam cerita.",
            "Ini adalah kalimat ketiga dalam cerita."
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

        typeWriter();;

        lanjutCeritaBtn.addEventListener('click', function() {
            ceritaIndex++;
            if (ceritaIndex < ceritaContent.length) {
                const currentCerita = ceritaContent[ceritaIndex];
                clearInterval(typingInterval);
                displayCerita(currentCerita);
                lanjutCeritaBtn.style.display = 'none';
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
                question: "Isi kalimat rumpang dengan men-drag dan drop kata-kata di bawah ini:",
                draggableWords: ["I", "usually", "eat", "breakfast", "at", "7", "o'clock", "in", "the", "morning"],
                correctAnswer: ["I", "usually", "eat", "breakfast", "at", "7", "o'clock", "in", "the", "morning"]
            },
            {
                question: "Susunlah kalimat dengan benar berdasarkan rumus simple present:",
                draggableWords: ["They", "work", "hard", "every", "day"],
                correctAnswer: ["They", "work", "hard", "every", "day"]
            }
        ];

        let currentQuestionIndex = 0;
        initializeQuestion(currentQuestionIndex);
        let correctAnswersCount = 0;

        function initializeQuestion(index) {
            const question = questions[index];
            const questionElement = document.querySelector('.question-container');
            const wordsContainer = document.querySelector('.draggable-container');
            const questionTitleElement = document.querySelector('.question-container p');
            questionTitleElement.textContent = question.question;
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
                if (currentQuestionIndex === questions.length - 1) {
                    document.getElementById('checkBtn').style.display = 'block';
                    document.getElementById('nextBtn').style.display = 'none';
                }
            } else {
                document.getElementById('isipertanyaan').style.display = 'none';
                showResult();
            }
        });

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
                resultElement.innerHTML = "<p class='text-green-500'>Kalimat tersusun dengan benar!</p>";
                document.getElementById('resetBtn').style.display = 'none';
                document.getElementById('checkBtn').style.display = 'none';
                document.getElementById('nextBtn').style.display = 'block';
                correctAnswersCount++;
            } else {
                resultElement.innerHTML = "<p class='text-red-500'>Kalimat tidak tersusun dengan benar!</p>";
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
                audio.volume = 0.0;
            } else {
                console.error("Audio element not found");
            }
        });
    </script>

    {{-- <audio id="bgMusic" loop autoplay>
        <source src="{{ asset('303PM.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio> --}}
@endsection
