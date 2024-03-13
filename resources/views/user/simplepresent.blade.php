@extends('layout.userlayout')
@section('konten')
    <section>
        <div class="p-4 sm:ml-64">
            <div class=" p-6 rounded-lg shadow bg-white">
                <div class=" p-6 rounded-lg shadow bg-violet-500 border-violet-600 m-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">QUEST 1</h5>
                    </a>
                    <p class="mb-3 font-normal  text-white">Here are the biggest enterprise technology
                        acquisitions of 2021 so far, in reverse chronological order.</p>
                    <a href="{{ route('simple-present-quest1') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-700">
                        Go
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>

                <div class=" p-6 rounded-lg shadow bg-violet-500 border-violet-600 m-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">QUEST 2</h5>
                    </a>
                    <p class="mb-3 font-normal  text-white">Here are the biggest enterprise technology
                        acquisitions of 2021 so far, in reverse chronological order.</p>
                    <a href="{{ route('simple-present-quest2') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-700">
                        Go
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>

                <div class=" p-6 rounded-lg shadow bg-violet-500 border-violet-600 m-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">QUEST 3</h5>
                    </a>
                    <p class="mb-3 font-normal  text-white">Here are the biggest enterprise technology
                        acquisitions of 2021 so far, in reverse chronological order.</p>
                    <a href="{{ route('simple-present-quest3') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-700">
                        Go
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>

                <div class=" p-6 rounded-lg shadow bg-violet-500 border-violet-600 m-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-white">QUEST 4</h5>
                    </a>
                    <p class="mb-3 font-normal  text-white">Here are the biggest enterprise technology
                        acquisitions of 2021 so far, in reverse chronological order.</p>
                    <a href="{{ route('simple-present-quest1') }}"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-yellow-500 hover:bg-yellow-600 focus:ring-yellow-700">
                        Go
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            @if(isset($notifications) && count($notifications) > 0)
            <script>
                var notificationsMessage = "";
                @foreach($notifications as $notification)
                    notificationsMessage += "{{ $notification }} !<br>";
                @endforeach

                Swal.fire({
                    position: 'top-end',
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
