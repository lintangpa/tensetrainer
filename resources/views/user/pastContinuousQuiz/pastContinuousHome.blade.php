@extends('layout.userlayout')
@section('konten')
    <section>
        <div class="p-4 sm:ml-64">
            <div class=" p-6 rounded-lg shadow bg-white bg-opacity-15 backdrop-blur-lg">
                @if ($userProgress['simple_past']['quest_3'] == 0)
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
                        style="background-image: url('{{ asset('image/rumahAdelsten.jpg') }}');">
                        <div class="absolute inset-0 bg-gradient-to-t from-transparent to-slate-900"></div>
                        <div class="relative z-10">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">Past Continuous - 1</h5>
                            </a>
                            <p class="mb-3 font-normal  text-white">The next day, Adelsten comes to Fred's house to practice together...</p>
                            <a href="{{ route('past-continuous-quest1') }}"
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

                @if ($userProgress['past_continuous']['quest_1'] == 0)
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
                        style="background-image: url('{{ asset('image/rumahAdelsten2.jpg') }}');">
                        <div class="absolute inset-0 bg-gradient-to-t from-transparent to-slate-900"></div>
                        <div class="relative z-10">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">Past Continuous - 2</h5>
                            </a>
                            <p class="mb-3 font-normal  text-white">The next day, Adelsten comes to Fred's house to practice together...</p>
                            <a href="{{ route('past-continuous-quest2') }}"
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

                @if ($userProgress['past_continuous']['quest_2'] == 0)
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
                        style="background-image: url('{{ asset('image/rumahAdelsten3.jpg') }}');">
                        <div class="absolute inset-0 bg-gradient-to-t from-transparent to-slate-900"></div>
                        <div class="relative z-10">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">Past Continuous - 3</h5>
                            </a>
                            <p class="mb-3 font-normal  text-white">there is bad news brought by Adelsten. What bad news does Adelsten convey?...</p>
                            <a href="{{ route('past-continuous-quest3') }}"
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
                        showConfirmButton: false,
                        timer: 5000
                    });
                </script>
            @endif
    </section>
@endsection
