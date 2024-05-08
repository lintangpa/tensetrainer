@extends('layout.userlayout')
@section('konten')
    @if ($userProgress['simple_present']['quest_1'] == 0)
        <div id="tutorialPopup"
            class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold mb-4 text-center">Hey!! Welcome to Adelste:Re Memories</h2>
                <div id="tutorialSteps">
                    <div class="tutorial-step" style="display: none">
                        <p class="text-gray-700 mb-4">Here you can learn how to navigate our website and make the most out of
                            your experience.</p>
                    </div>
                    <div class="tutorial-step flex flex-col items-center justify-center" style="display: none">
                        <img src="{{ URL::asset('/image/dragAndDrop.gif') }}" class="h-auto w-72 mb-4 mx-auto"
                            alt="">
                        <p class="text-center">Drag and drop words from the options provided into the conversation box.</p>
                    </div>
                    <div class="tutorial-step flex flex-col items-center justify-center" style="display: none;">
                        <img src="{{ URL::asset('/image/resetButton.gif') }}" class="h-auto w-72 mb-4 mx-auto"
                            alt="">
                        <p class="text-center">If you make a mistake, use the "Reset" button to start over.</p>
                    </div>
                    <div class="tutorial-step flex flex-col items-center justify-center" style="display: none;">
                        <img src="{{ URL::asset('/image/checkAnswer.gif') }}" class="h-auto w-72 mb-4 mx-auto"
                            alt="">
                        <p class="text-center">Once you've arranged your response, click "Check Answer".</p>
                    </div>
                    <div class="tutorial-step flex flex-col items-center justify-center" style="display: none;">
                        <img src="{{ URL::asset('/image/chara/adelstenSmile.png') }}" class="h-auto w-24 mb-4 mx-auto"
                            alt="">
                        <p class="text-center p-2">Make sure your response adheres to the correct tense rules to proceed.
                        </p>
                    </div>
                </div>
                <button id="nextStepBtn"
                    class="mt-4 px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600 flex items-center justify-center mx-auto">Next</button>
                <button id="gotItBtn"
                    class="px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600 flex items-center justify-center mx-auto"
                    style="display: none;">Got it!</button>
            </div>
    @endif


    </div>
    <section>
        <div class="p-4 sm:ml-64">
            <div class=" p-6 rounded-lg shadow bg-white bg-opacity-15 backdrop-blur-lg">
                <div class="relative w-full bg-center mx-auto bg-cover bg-no-repeat rounded p-6 shadow-md text-center"
                    style="background-image: url('{{ asset('image/rumahFred.jpg') }}');">
                    <div class="absolute inset-0 bg-gradient-to-t from-transparent to-slate-900"></div>
                    <div class="relative z-10">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">Simple Present - 1</h5>
                        </a>
                        <p class="mb-3 font-normal  text-white">At a renowned school in the city of Yden, a selection test
                            for magic is being held....</p>
                        <a href="{{ route('simple-present-quest1') }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-700">
                            Go
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>

                @if ($userProgress['simple_present']['quest_1'] == 0)
                    <div class="locked-div">
                        <div
                            class="relative w-full bg-center mx-auto bg-cover bg-no-repeat rounded-lg p-6 shadow-md text-center m-5">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-500 to-slate-600"></div>
                            <div class="relative z-10">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6 inline-block align-middle">
                                            <path fill-rule="evenodd"
                                                d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </h5>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="relative w-full bg-center mx-auto bg-cover bg-no-repeat rounded p-6 shadow-md text-center m-5"
                        style="background-image: url('{{ asset('image/rumahFred2.jpg') }}');">
                        <div class="absolute inset-0 bg-gradient-to-t from-transparent to-slate-900"></div>
                        <div class="relative z-10">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">Simple Present - 2</h5>
                            </a>
                            <p class="mb-3 font-normal  text-white">The next day, Adelsten comes to Fred's house to practice
                                together...</p>
                            <a href="{{ route('simple-present-quest2') }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-700">
                                Go
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif

                @if ($userProgress['simple_present']['quest_2'] == 0)
                    <div class="locked-div">
                        <div
                            class="relative w-full bg-center mx-auto bg-cover bg-no-repeat rounded-lg p-6 shadow-md text-center m-5">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-500 to-slate-600"></div>
                            <div class="relative z-10">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-6 h-6 inline-block align-middle">
                                            <path fill-rule="evenodd"
                                                d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </h5>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="relative w-full bg-center mx-auto bg-cover bg-no-repeat rounded p-6 shadow-md text-center m-5"
                        style="background-image: url('{{ asset('image/rumahFred3.jpg') }}');">
                        <div class="absolute inset-0 bg-gradient-to-t from-transparent to-slate-900"></div>
                        <div class="relative z-10">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">Simple Present - 3</h5>
                            </a>
                            <p class="mb-3 font-normal  text-white">there is bad news brought by Adelsten. What bad news
                                does Adelsten convey?...</p>
                            <a href="{{ route('simple-present-quest3') }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-700">
                                Go
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif

            </div>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            @if (isset($notifications) && count($notifications) > 0)
                <script>
                    var notificationsMessage = "";
                    @foreach ($notifications as $notification)
                        notificationsMessage += "{{ $notification }} !<br>";
                    @endforeach

                    Swal.fire({
                        icon: 'success',
                        title: 'Unlocked new achievement',
                        html: notificationsMessage,
                        showConfirmButton: true,
                        // timer: 5000
                    });
                </script>
            @endif
            <script>
                var currentStep = 0;
                var tutorialSteps = document.querySelectorAll(".tutorial-step");
                var nextStepBtn = document.getElementById("nextStepBtn");
                var gotItBtn = document.getElementById("gotItBtn");

                function showStep(stepIndex) {
                    tutorialSteps.forEach(function(step, index) {
                        if (index === stepIndex) {
                            step.style.display = "block";
                        } else {
                            step.style.display = "none";
                        }
                    });
                }

                function updateButtons() {
                    if (currentStep === tutorialSteps.length - 1) {
                        nextStepBtn.style.display = "none";
                        gotItBtn.style.display = "block";
                    } else {
                        nextStepBtn.style.display = "block";
                        gotItBtn.style.display = "none";
                    }
                }

                nextStepBtn.addEventListener("click", function() {
                    currentStep++;
                    showStep(currentStep);
                    updateButtons();
                });

                document.addEventListener("DOMContentLoaded", function() {
                    var popup = document.getElementById('tutorialPopup');
                    var gotItButton = document.getElementById('gotItBtn');
                    gotItButton.addEventListener('click', function() {
                        popup.classList.add('hidden');
                    });
                    popup.classList.remove('hidden');
                });

                showStep(currentStep);
                updateButtons();
            </script>
    </section>
@endsection
