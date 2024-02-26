@extends('layout.userlayout')
@section('konten')
    <style>
        .select-box.hide {
            opacity: 0;
            pointer-events: none;
        }

        .play-board.show {
            opacity: 1;
            pointer-events: auto;
            transform: translate(-50%, -50%) scale(1);
        }

        .players span {
            position: relative;
            z-index: 2;
            color: #eab308;
            font-size: 20px;
            font-weight: 500;
            padding: 10px 0;
            width: 100%;
            text-align: center;
            cursor: default;
            user-select: none;
            transition: all 0.3 ease;
        }

        .play-board .players {
            width: 100%;
            display: flex;
            position: relative;
            justify-content: space-between;
        }

        .players.active span:first-child {
            color: #fff;
        }

        .players.active span:last-child {
            color: #eab308;
        }

        .players span:first-child {
            color: #fff;
        }

        .players.active .slider {
            left: 50%;
        }

        .players.active span:first-child {
            color: #eab308;
        }

        .players.active span:nth-child(2) {
            color: #fff;
        }

        .players.active .slider {
            left: 50%;
        }

        .play-area section span {
            display: block;
            height: 90px;
            width: 90px;
            margin: 2px;
            font-size: 40px;
            line-height: 80px;
            text-align: center;
            border-radius: 5px;
            background: #fff;
        }

        .result-box.show {
            opacity: 1;
            pointer-events: auto;
            transform: translate(-50%, -50%) scale(1);
        }
    </style>

    <div
        class="select-box flex justify-center items-center fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 transition-opacity duration-300 sm:ml-36 h-screen">
        <div class="bg-white p-6 rounded-lg">
            <header class="text-3xl font-semibold pb-4 border-b border-gray-300">Tic Tac Toe</header>
            <div class="content">
                <div class="title text-lg font-semibold my-5">Select which you want to be?</div>
                <div class="options flex">
                    <button
                        class="playerX w-full text-lg font-semibold py-2 rounded bg-yellow-500 text-white focus:outline-none transition duration-300 hover:scale-95 mr-2">Player
                        (X)</button>
                    <button
                        class="playerO w-full text-lg font-semibold py-2 rounded bg-yellow-500 text-white focus:outline-none transition duration-300 hover:scale-95 ml-2">Player
                        (O)</button>
                </div>
            </div>
        </div>
    </div>

    <div
        class="play-board opacity-0 pointer-events-none fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 scale-90 transition-all duration-300 p-6 sm:ml-36">
        <div class="details bg-white p-4 rounded">
            <div class="players flex justify-between relative">
                <span class="Xturn text-yellow-500 font-semibold text-lg">X's Turn</span>
                <span class="Oturn text-yellow-500 font-semibold text-lg">O's Turn</span>
                <div class="slider absolute top-0 left-0 w-1/2 h-full bg-yellow-500 rounded transition-all duration-300">
                </div>
            </div>
        </div>
        <div class="play-area mt-4">
            <section class="flex">
                <span
                    class="box1 flex items-center justify-center h-16 w-16 mx-1 text-yellow-500 text-4xl font-bold rounded bg-white"></span>
                <span
                    class="box2 flex items-center justify-center h-16 w-16 mx-1 text-yellow-500 text-4xl font-bold rounded bg-white"></span>
                <span
                    class="box3 flex items-center justify-center h-16 w-16 mx-1 text-yellow-500 text-4xl font-bold rounded bg-white"></span>
            </section>
            <section class="flex">
                <span
                    class="box4 flex items-center justify-center h-16 w-16 mx-1 text-yellow-500 text-4xl font-bold rounded bg-white"></span>
                <span
                    class="box5 flex items-center justify-center h-16 w-16 mx-1 text-yellow-500 text-4xl font-bold rounded bg-white"></span>
                <span
                    class="box6 flex items-center justify-center h-16 w-16 mx-1 text-yellow-500 text-4xl font-bold rounded bg-white"></span>
            </section>
            <section class="flex">
                <span
                    class="box7 flex items-center justify-center h-16 w-16 mx-1 text-yellow-500 text-4xl font-bold rounded bg-white"></span>
                <span
                    class="box8 flex items-center justify-center h-16 w-16 mx-1 text-yellow-500 text-4xl font-bold rounded bg-white"></span>
                <span
                    class="box9 flex items-center justify-center h-16 w-16 mx-1 text-yellow-500 text-4xl font-bold rounded bg-white"></span>
            </section>
        </div>
    </div>

    <div
        class="result-box p-6 sm:ml-36 opacity-0 pointer-events-none fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 scale-90 transition-all duration-300 bg-white rounded text-center">
        <div class="won-text text-lg font-semibold"></div>
        <div class="btn mt-4"><button
                class="text-lg font-semibold py-2 px-6 rounded bg-yellow-500 text-white focus:outline-none transition duration-300 hover:scale-95">Replay</button>
            <a href="{{ route('simple-present') }}">
                <button
                    class="text-lg font-semibold py-2 px-6 rounded bg-yellow-500 text-white focus:outline-none transition duration-300 hover:scale-95">Back
                    to
                    Menu</button>
            </a>
        </div>
    </div>

    <script>
        const selectBox = document.querySelector(".select-box"),
            selectBtnX = selectBox.querySelector(".options .playerX"),
            selectBtnO = selectBox.querySelector(".options .playerO"),
            playBoard = document.querySelector(".play-board"),
            players = document.querySelector(".players"),
            resultBox = document.querySelector(".result-box"),
            wonText = resultBox.querySelector(".won-text"),
            replayBtn = resultBox.querySelector("button");

        // Ambil elemen-elemen kotak permainan dari DOM
        const allBox = document.querySelectorAll(".play-area section span");

        window.onload = () => {
            for (let i = 0; i < allBox.length; i++) {
                allBox[i].setAttribute("onclick", "clickedBox(this)");
            }
        }

        selectBtnX.onclick = () => {
            selectBox.classList.add("hide");
            playBoard.classList.add("show");
        }

        selectBtnO.onclick = () => {
            selectBox.classList.add("hide");
            playBoard.classList.add("show");
            players.setAttribute("class", "players active player");
            playerSign = "O"; // Tetapkan pemain ke tanda "O" jika memilih menjadi pemain "O"
        }


        let playerXIcon = "fas fa-times",
            playerOIcon = "far fa-circle",
            playerSign = "X",
            runBot = true;

        function clickedBox(element) {
            if (players.classList.contains("player")) {
                playerSign = "O";
                element.innerHTML = `<i class="${playerOIcon}"></i>`;
                players.classList.remove("active");
                element.setAttribute("id", playerSign);
            } else {
                element.innerHTML = `<i class="${playerXIcon}"></i>`;
                element.setAttribute("id", playerSign);
                players.classList.add("active");
            }
            selectWinner();
            element.style.pointerEvents = "none";
            playBoard.style.pointerEvents = "none"; // Atur pointer-events ke "none" setelah pemain memilih
            if (runBot)
                bot();
            playBoard.style.pointerEvents = "auto"; // Kembalikan pointer-events ke "auto" setelah bot memilih
        }

        function minimax(board, depth, isMaximizing) {
            let result = checkWinner(board, 'O') ? 1 :
                checkWinner(board, 'X') ? -1 :
                isBoardFull(board) ? 0 : null;

            if (result !== null) {
                return result;
            }

            if (isMaximizing) {
                let bestScore = -Infinity;
                for (let i = 0; i < board.length; i++) {
                    if (!board[i].id) {
                        board[i].innerHTML = `<i class="${playerOIcon}"></i>`;
                        let score = minimax(board, depth + 1, false);
                        board[i].innerHTML = '';
                        bestScore = Math.max(score, bestScore);
                    }
                }
                return bestScore;
            } else {
                let bestScore = Infinity;
                for (let i = 0; i < board.length; i++) {
                    if (!board[i].id) {
                        board[i].innerHTML = `<i class="${playerXIcon}"></i>`;
                        let score = minimax(board, depth + 1, true);
                        board[i].innerHTML = '';
                        bestScore = Math.min(score, bestScore);
                    }
                }
                return bestScore;
            }
        }

        function bot() {
            let bestScore = -Infinity;
            let bestMove;
            for (let i = 0; i < allBox.length; i++) {
                if (!allBox[i].id) {
                    allBox[i].innerHTML = `<i class="${playerOIcon}"></i>`;
                    let score = minimax(allBox, 0, false);
                    allBox[i].innerHTML = '';
                    if (score > bestScore) {
                        bestScore = score;
                        bestMove = i;
                    }
                }
            }
            if (bestMove !== undefined) {
                allBox[bestMove].innerHTML = `<i class="${playerOIcon}"></i>`;
                allBox[bestMove].setAttribute("id", "O");
                players.classList.add("active");
                selectWinner();
            }
        }

        function checkWinner(board, player) {
            const winningCombos = [
                [0, 1, 2],
                [3, 4, 5],
                [6, 7, 8], // Rows
                [0, 3, 6],
                [1, 4, 7],
                [2, 5, 8], // Columns
                [0, 4, 8],
                [2, 4, 6] // Diagonals
            ];

            for (let combo of winningCombos) {
                if (board[combo[0]].id === player && board[combo[1]].id === player && board[combo[2]].id === player) {
                    return true;
                }
            }
            return false;
        }

        function isBoardFull(board) {
            for (let cell of board) {
                if (!cell.textContent.trim()) {
                    return false; // Ada setidaknya satu sel yang masih kosong
                }
            }
            return true; // Semua sel telah diisi
        }

        function selectWinner() {
            if (checkWinner(allBox, 'X')) {
                runBot = false;
                setTimeout(() => {
                    resultBox.classList.add("show");
                    playBoard.classList.remove("show");
                }, 700);
                wonText.innerHTML = `Player <p>X</p> won the game!`;
            } else if (checkWinner(allBox, 'O')) {
                runBot = false;
                setTimeout(() => {
                    resultBox.classList.add("show");
                    playBoard.classList.remove("show");
                }, 700);
                wonText.innerHTML = `Player <p>O</p> won the game!`;
            } else if (isBoardFull(allBox)) {
                runBot = false;
                setTimeout(() => {
                    resultBox.classList.add("show");
                    playBoard.classList.remove("show");
                }, 700);
                wonText.textContent = "Match has been drawn!";
            }
        }

        replayBtn.onclick = () => {
            window.location.reload();
        }
    </script>
@endsection
