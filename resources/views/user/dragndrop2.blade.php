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
            transition: transform 0.2s ease; /* Animasi transform saat item diangkat */
        }

        .draggable:active {
            transform: scale(1.1); /* Perbesar item saat diangkat */
        }
    </style>
    <div class="p-4 sm:ml-64">
        <div class="max-w-md mx-auto bg-white rounded p-6 shadow-md">
            <h2 class="text-xl font-semibold mb-4">Drag and Drop Kalimat Rumpang</h2>
            <div class="mb-4">
                <p>Isi kalimat rumpang dengan men-drag dan drop kata-kata di bawah ini:</p>
                <div class="droppable mt-4" id="droppable" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
            </div>
            <div class="flex flex-wrap">
                <div class="draggable bg-gray-200 rounded p-2 m-1" draggable="true" ontouchstart="touchStart(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)" ondragstart="dragStart(event)">Saya</div>
                <div class="draggable bg-gray-200 rounded p-2 m-1" draggable="true" ontouchstart="touchStart(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)" ondragstart="dragStart(event)">sedang</div>
                <div class="draggable bg-gray-200 rounded p-2 m-1" draggable="true" ontouchstart="touchStart(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)" ondragstart="dragStart(event)">belajar</div>
                <div class="draggable bg-gray-200 rounded p-2 m-1" draggable="true" ontouchstart="touchStart(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)" ondragstart="dragStart(event)">membuat</div>
                <div class="draggable bg-gray-200 rounded p-2 m-1" draggable="true" ontouchstart="touchStart(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)" ondragstart="dragStart(event)">aplikasi</div>
            </div>
            <button id="checkBtn" class="bg-indigo-500 text-white px-4 py-2 rounded mt-4 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-600">Cek Kalimat</button>
            <div id="result" class="mt-4"></div>
        </div>

        <script>
            let currentTouchTarget = null;
            let sentence = '';

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

            document.getElementById('checkBtn').addEventListener('click', function() {
                const resultElement = document.getElementById('result');
                if (sentence.trim() === '') {
                    resultElement.innerHTML = "<p class='text-red-500'>Kalimat tidak boleh kosong!</p>";
                } else {
                    // Contoh sederhana pengecekan kalimat
                    if (sentence.includes('Saya') && sentence.includes('sedang') && sentence.includes('belajar') && sentence.includes('membuat') && sentence.includes('aplikasi')) {
                        resultElement.innerHTML = "<p class='text-green-500'>Kalimat tersusun dengan benar!</p>";
                    } else {
                        resultElement.innerHTML = "<p class='text-red-500'>Kalimat tidak tersusun dengan benar!</p>";
                    }
                }
            });
        </script>
    @endsection