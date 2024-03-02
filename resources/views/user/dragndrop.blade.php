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
            /* Animasi transform saat item diangkat */
        }

        .draggable:active {
            transform: scale(1.1);
            /* Perbesar item saat diangkat */
        }
    </style>
    <div class="p-4 sm:ml-64">
        <div class="max-w-md mx-auto bg-white rounded p-6 shadow-md">
            <h2 class="text-xl font-semibold mb-4">Quiz Simple Present Tense</h2>
            <div class="mb-4">
                <p>Isi kalimat rumpang dengan men-drag dan drop kata-kata di bawah ini:</p>
                <div class="droppable mt-4" id="droppable" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <p id="question"></p>
                    <div class="droppable mt-4" id="dropzone" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <!-- Tempat drop di sini -->
                    </div>
                </div>
                <ul id="options"></ul>
            </div>
            <button id="checkBtn"
                class="bg-indigo-500 text-white px-4 py-2 rounded mt-4 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Cek
                Jawaban</button>
            <div id="result" class="mt-4"></div>
        </div>
    </div>

    <script>
        let currentTouchTarget = null;
        let sentence = '';
        let currentQuestionIndex = 0;

        const questions = [{
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
            // Tambahkan pertanyaan lainnya di sini...
        ];

        // Memulai kuis
        function startQuiz() {
            const questionElement = document.getElementById('question');
            const optionsElement = document.getElementById('options');
            const currentQuestion = questions[currentQuestionIndex];

            questionElement.textContent = currentQuestion.question;

            const allOptions = [...currentQuestion.incorrect_answers, currentQuestion.correct_answer];
            const shuffledOptions = shuffleArray(allOptions);

            optionsElement.innerHTML = '';
            shuffledOptions.forEach(option => {
                const li = document.createElement('li');
                li.textContent = option;
                li.setAttribute('class', 'draggable bg-gray-200 rounded p-2 m-1');
                li.setAttribute('draggable', 'true');
                li.setAttribute('ontouchstart', 'touchStart(event)');
                li.setAttribute('ontouchmove', 'touchMove(event)');
                li.setAttribute('ontouchend', 'touchEnd(event)');
                li.setAttribute('ondragstart', 'dragStart(event)');
                optionsElement.appendChild(li);
            });
        }

        // Fungsi untuk mengacak urutan elemen dalam array
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        // Memanggil fungsi untuk memulai kuis
        startQuiz();

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
            document.getElementById('dropzone').innerHTML = ''; // Membersihkan dropzone
            document.getElementById('dropzone').innerHTML += data + ' ';
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
                document.getElementById('dropzone').innerHTML += currentTouchTarget.textContent + ' ';
                currentTouchTarget = null;
            }
        }

        // Fungsi untuk memeriksa kesamaan arti antara dua string
        function isEquivalent(answer1, answer2) {
            answer1 = answer1.trim().toLowerCase();
            answer2 = answer2.trim().toLowerCase();
            return answer1 === answer2;
        }

        // Fungsi untuk memeriksa jawaban
        function checkAnswer() {
            const resultElement = document.getElementById('result');
            if (sentence.trim() === '') {
                resultElement.innerHTML = "<p class='text-red-500'>Jawaban tidak boleh kosong!</p>";
            } else {
                const currentQuestion = questions[currentQuestionIndex];
                const expectedAnswer = currentQuestion.correct_answer;
                if (sentence.includes(expectedAnswer) || isEquivalent(sentence, expectedAnswer)) {
                    resultElement.innerHTML = "<p class='text-green-500'>Jawaban Anda benar!</p>";
                } else {
                    resultElement.innerHTML = "<p class='text-red-500'>Jawaban Anda salah!</p>";
                }
            }
        }

        document.getElementById('checkBtn').addEventListener('click', checkAnswer);
    </script>
@endsection
