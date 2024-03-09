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
        <!-- Bagian pertanyaan -->
        <div id="pertanyaan" style="display: none;">
            <!-- Tambahkan konten pertanyaan di sini -->
            <div class="w-full mx-auto bg-white rounded p-6 shadow-md">
                <div id="isipertanyaan">
                    {{-- <h2 class="text-xl font-semibold mb-4">Quiz Simple Present Tense</h2> --}}
                    <div class="mb-4">
                        <p>Drag your answer in to the box</p>
                        <div class="mt-4" id="droppable" ondrop="drop(event)" ondragover="allowDrop(event)">
                            <p id="question"></p>
                            <div class="mt-4" id="dropzone" ondrop="drop(event)" ondragover="allowDrop(event)">
                                <!-- Tempat drop di sini -->
                            </div>
                        </div>
                        <ul id="options"></ul>
                        <div id="explanation" class="">
                        </div>
                    </div>
                    <div class="flex mt-4">
                        <button id="checkBtn"
                            class="flex-1 bg-indigo-500 text-white px-4 py-2 rounded mr-2 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Cek
                            Jawaban</button>
                        <button id="nextBtn"
                            class="flex-1 bg-indigo-500 text-white px-4 py-2 rounded mr-2 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600"
                            style="display:none;">Next Question</button>
                    </div>
                </div>
                <div id="result" class="mt-4"></div>
                <a id="backmenu" href="{{ route('simple-present') }} " onclick="addExp(event)" style="display: none;">
                    <button class="mb-6 w-full h-16 bg-blue-600 rounded-md text-white text-lg font-semibold">Back to
                        Menu</button>
                </a>
            </div>
        </div>
    </div>

    <script>
        let currentTouchTarget = null;
        let sentence = '';
        let correctAnswersCount = 0; // Menyimpan jumlah jawaban yang benar
        let currentQuestionIndex = 0; // Indeks pertanyaan saat ini
        let ceritaIndex = 0; // Indeks cerita saat ini
        const ceritaContent = [
            "Ini adalah kalimat pertama dalam cerita.",
            "Ini adalah kalimat kedua dalam cerita.",
            "Ini adalah kalimat ketiga dalam cerita."
            // Tambahkan kalimat cerita selanjutnya di sini
        ];

        // Data pertanyaan
        const questions = [{
                "question": "What is the formula for Simple Present Tense for singular subjects ___?",
                "correct_answer": "Subject + Verb + -s/-es",
                "incorrect_answers": ["Subject + Verb-ing", "Subject + Verb + -ed", "Subject + Verb + have/has"],
                "explanation": "Dalam Simple Present Tense, untuk subjek tunggal seperti 'he', 'she', dan 'it', kata kerja (verb) ditambahkan dengan -s/-es di akhir kata."
            },
            {
                "question": "What is the formula ___ for Simple Present Tense for plural subjects?",
                "correct_answer": "Subject + Verb + -s/-es",
                "incorrect_answers": ["Subject + Verb-ing", "Subject + Verb + -ed", "Subject + Verb + have/has"],
                "explanation": "Untuk subjek jamak seperti 'we', 'you', dan 'they', kata kerja (verb) juga ditambahkan dengan -s/-es di akhir kata dalam Simple Present Tense."
            }
        ];

        // Menyimpan referensi ke div cerita dan pertanyaan
        const ceritaDiv = document.getElementById('cerita');
        const pertanyaanDiv = document.getElementById('pertanyaan');
        // Tombol untuk melanjutkan ke pertanyaan
        const lanjutCeritaBtn = document.getElementById('lanjutCeritaBtn')
        // Mendapatkan teks cerita
        const ceritaText = ceritaContent[ceritaIndex];
        // Mendapatkan elemen tempat cerita akan ditampilkan
        const ceritaElement = document.getElementById('ceritaContent');
        // Mendefinisikan variabel untuk menghitung karakter yang telah ditampilkan
        let charIndex = 0;

        // Mendefinisikan fungsi untuk menampilkan cerita dengan efek mengetik
        function typeWriter() {
            if (charIndex < ceritaText.length) {
                ceritaElement.textContent += ceritaText.charAt(charIndex);
                charIndex++;
                setTimeout(typeWriter, 20); // Menjalankan fungsi typeWriter setiap 50 milidetik
            } else {
                // Setelah semua karakter ditampilkan, tampilkan tombol "Lanjutkan ke Pertanyaan"
                lanjutCeritaBtn.style.display = 'block';
            }
        }

        // Memanggil fungsi typeWriter untuk memulai animasi mengetik
        typeWriter();;

        lanjutCeritaBtn.addEventListener('click', function() {
            // Menampilkan kalimat cerita selanjutnya
            ceritaIndex++;
            if (ceritaIndex < ceritaContent.length) {
                // Ambil konten cerita saat ini
                const currentCerita = ceritaContent[ceritaIndex];
                // Hentikan animasi sebelumnya jika ada
                clearInterval(typingInterval);
                // Perbarui tampilan dengan animasi mengetik
                displayCerita(currentCerita);
                // Sembunyikan tombol lanjut sementara animasi berlangsung
                lanjutCeritaBtn.style.display = 'none';
            } else {
                // Sembunyikan div cerita
                ceritaDiv.style.display = 'none';
                // Tampilkan div pertanyaan
                pertanyaanDiv.style.display = 'block';
            }
        });

        let typingInterval; // variabel untuk menyimpan interval animasi mengetik

        function displayCerita(cerita) {
            // Ambil elemen yang menampilkan cerita
            const ceritaElement = document.getElementById('ceritaContent');
            ceritaElement.textContent = ''; // Mengosongkan teks cerita sebelumnya
            // Buat variabel untuk menyimpan indeks karakter
            let charIndex = 0;
            // Memulai animasi mengetik
            typingInterval = setInterval(function() {
                // Tambahkan karakter ke ceritaElement satu per satu
                ceritaElement.textContent += cerita[charIndex];
                // Periksa apakah sudah mencapai akhir cerita
                if (charIndex === cerita.length - 1) {
                    // Hentikan interval jika sudah mencapai akhir cerita
                    clearInterval(typingInterval);
                    // Setelah animasi selesai, tampilkan tombol lanjut
                    lanjutCeritaBtn.style.display = 'block';
                }
                // Tambahkan indeks karakter untuk mengambil karakter berikutnya di iterasi berikutnya
                charIndex++;
            }, 20); // makin kecil makin cepet
        }

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
                document.getElementById('dropzone').innerHTML = '';
                document.getElementById('checkBtn').style.display = 'block';
                document.getElementById('nextBtn').style.display = 'none';
            } else {
                // Jika tidak ada pertanyaan lagi, tampilkan hasil
                document.getElementById('isipertanyaan').style.display = 'none';
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
            document.getElementById('nextBtn').style.display = 'none';
            document.getElementById('backmenu').style.display = 'block';
        }

        // Fungsi untuk memeriksa jawaban
        function checkAnswer() {
            const resultElement = document.getElementById('result');
            const explanationElement = document.getElementById('explanation');
            if (sentence.trim() === '') {
                resultElement.innerHTML = "<p class='text-red-500'>Kalimat tidak boleh kosong!</p>";
            } else {
                // Jawaban yang diharapkan
                const expectedAnswer = questions[currentQuestionIndex].correct_answer;
                const explanation = questions[currentQuestionIndex].explanation;
                // Memeriksa apakah jawaban pengguna benar
                if (isEquivalent(sentence, expectedAnswer)) {
                    resultElement.innerHTML = "<p class='text-green-500'>Jawaban Anda benar!</p>";
                    document.getElementById('checkBtn').style.display = 'none';
                    document.getElementById('nextBtn').style.display = 'block';
                    explanationElement.innerHTML = `<p class='text-blue-500'> ${explanation}</p>`;
                    // Menambahkan jumlah jawaban yang benar
                    correctAnswersCount++;
                } else {
                    resultElement.innerHTML = "<p class='text-red-500'>Jawaban Anda salah!</p>";
                    document.getElementById('checkBtn').style.display = 'none';
                    document.getElementById('nextBtn').style.display = 'block';
                    explanationElement.innerHTML = `<p class='text-blue-500'> ${explanation}</p>`;
                }
            }
        }

        // Memulai kuis
        function startQuiz() {
            const questionElement = document.getElementById('question');
            const optionsElement = document.getElementById('options');
            const currentQuestion = questions[currentQuestionIndex];

            questionElement.textContent = currentQuestion.question;
            // Clear any previous dropzone
            document.getElementById('dropzone').innerHTML = '';
            document.getElementById('result').innerHTML = '';
            document.getElementById('explanation').innerHTML = '';

            // Inject the question text with dropzone
            questionElement.innerHTML = currentQuestion.question.replace("___",
                "<span id='dropzone' class='droppable' ondrop='drop(event)' ondragover='allowDrop(event)'>___</span>");

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
            document.getElementById('dropzone').innerHTML = data + ' '; // Menambahkan jawaban baru ke dropzone
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
                document.getElementById('dropzone').innerHTML = currentTouchTarget.textContent + ' ';
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

        function addExp(event) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $.ajax({
                type: "POST",
                url: "{{ route('addexp') }}",
                data: {
                    exp: 50 + (10 * correctAnswersCount),
                    _token: csrfToken
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

        //kontrol musik
        document.addEventListener("DOMContentLoaded", function() {
            // Mengatur volume audio
            var audio = document.getElementById("bgMusic");
            if (audio) {
                audio.volume = 0.2; // Atur volume ke 50%
            } else {
                console.error("Audio element not found");
            }
        });
    </script>

    <audio id="bgMusic" loop autoplay>
        <source src="{{ asset('303PM.mp3') }}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
@endsection
