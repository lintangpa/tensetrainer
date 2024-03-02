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
            <button id="nextBtn"
                class="bg-indigo-500 text-white px-4 py-2 rounded mt-4 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600"
                style="display:none;">Next
                Question</button>
            <div id="result" class="mt-4"></div>
        </div>

        <script>
            let currentTouchTarget = null;
            let sentence = '';
            let correctAnswersCount = 0; // Menyimpan jumlah jawaban yang benar
            let currentQuestionIndex = 0; // Indeks pertanyaan saat ini

            // Data pertanyaan
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

            // Memulai kuis
            startQuiz();

            // Fungsi untuk memuat pertanyaan berikutnya
            function nextQuestion() {
                // Meningkatkan indeks pertanyaan saat ini
                currentQuestionIndex++;
                // Memeriksa apakah masih ada pertanyaan berikutnya
                if (currentQuestionIndex < questions.length) {
                    // Memuat pertanyaan berikutnya
                    startQuiz();
                } else {
                    // Jika tidak ada pertanyaan lagi, tampilkan hasil
                    showResult();
                }
            }

            // Fungsi untuk menampilkan hasil akhir
            function showResult() {
                // Menampilkan jumlah jawaban yang benar kepada pengguna
                document.getElementById('result').innerHTML = `Jumlah jawaban benar: ${correctAnswersCount}`;
                // Menyembunyikan tombol cek jawaban
                document.getElementById('checkBtn').style.display = 'none';
                // Menampilkan tombol next question
                document.getElementById('nextBtn').style.display = 'block';
            }

            // Fungsi untuk memeriksa jawaban
            function checkAnswer() {
                const resultElement = document.getElementById('result');
                if (sentence.trim() === '') {
                    resultElement.innerHTML = "<p class='text-red-500'>Kalimat tidak boleh kosong!</p>";
                } else {
                    // Jawaban yang diharapkan
                    const expectedAnswer = questions[currentQuestionIndex].correct_answer;
                    // Memeriksa apakah jawaban pengguna benar
                    if (isEquivalent(sentence, expectedAnswer)) {
                        resultElement.innerHTML = "<p class='text-green-500'>Jawaban Anda benar!</p>";
                        // Menambahkan jumlah jawaban yang benar
                        correctAnswersCount++;
                    } else {
                        resultElement.innerHTML = "<p class='text-red-500'>Jawaban Anda salah!</p>";
                    }
                    // Memanggil fungsi untuk menampilkan pertanyaan berikutnya
                    nextQuestion();
                }
            }

            // Memulai kuis
            function startQuiz() {
                const questionElement = document.getElementById('question');
                const optionsElement = document.getElementById('options');
                const currentQuestion = questions[currentQuestionIndex];

                questionElement.textContent = currentQuestion.question;

                // Menggabungkan jawaban yang benar dan yang salah untuk dibuat menjadi pilihan jawaban
                const allOptions = [...currentQuestion.incorrect_answers, currentQuestion.correct_answer];
                // Mengacak urutan pilihan jawaban
                const shuffledOptions = shuffleArray(allOptions);

                // Mengisi pilihan jawaban ke dalam elemen HTML
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

            // Fungsi untuk mengizinkan drop
            function allowDrop(ev) {
                ev.preventDefault();
            }

            // Fungsi untuk memulai drag
            function dragStart(ev) {
                ev.dataTransfer.setData("text", ev.target.textContent);
            }

            // Fungsi untuk men-drop item
            function drop(ev) {
                ev.preventDefault();
                const data = ev.dataTransfer.getData("text");
                sentence = data + ' ';
                document.getElementById('dropzone').innerHTML = ''; // Reset konten dropzone
                document.getElementById('dropzone').innerHTML += data + ' '; // Menambahkan jawaban baru ke dropzone
            }


            // Fungsi untuk menangani sentuhan saat dimulai
            function touchStart(ev) {
                ev.preventDefault();
                currentTouchTarget = ev.target;
            }

            // Fungsi untuk menangani sentuhan saat bergerak
            function touchMove(ev) {
                ev.preventDefault();
            }

            // Fungsi untuk menangani sentuhan saat berakhir
            function touchEnd(ev) {
                ev.preventDefault();
                if (currentTouchTarget) {
                    sentence += currentTouchTarget.textContent + ' ';
                    // Menambahkan data yang di-drop ke dalam elemen dengan id "dropzone"
                    document.getElementById('dropzone').innerHTML += currentTouchTarget.textContent + ' ';
                    currentTouchTarget = null;
                }
            }

            // Fungsi untuk memeriksa kesamaan arti antara dua string
            function isEquivalent(answer1, answer2) {
                // Menghapus spasi dan mengubah ke huruf kecil untuk memperhitungkan perbedaan dalam format
                answer1 = answer1.trim().toLowerCase();
                answer2 = answer2.trim().toLowerCase();
                // Memeriksa apakah dua string memiliki arti yang sama
                return answer1 === answer2;
            }

            // Event listener untuk tombol "Cek Jawaban"
            document.getElementById('checkBtn').addEventListener('click', checkAnswer);

            // Event listener untuk tombol "Next Question"
            document.getElementById('nextBtn').addEventListener('click', nextQuestion);
        </script>
    @endsection
