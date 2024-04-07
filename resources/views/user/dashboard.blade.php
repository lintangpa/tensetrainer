@extends('layout.userlayout')
@section('konten')
    <section>
        <div class="p-4 sm:ml-64">
            <h1 class="text-white mx-6 font-bold text-2xl">Welcome {{ Auth::user()->name }}!</h1>
            <h1 class="text-white mx-6 font-bold text-2xl">Level {{ $user->level }}</h1>
            {{-- EXP Bar --}}
            <div class="bg-gray-200 rounded-full h-4 mx-6">
                <div class="bg-green-500 rounded-full h-full text-xs leading-none py-1 text-center text-white"
                    style="width: <?php echo $expPercentage; ?>%;">
                    <?php echo $expPercentage; ?>%
                </div>
            </div>
            {{-- End of EXP Bar --}}
            {{-- <div id="quoteContainer" class="mx-6">
            </div> --}}
            <div class="p-6 rounded-lg shadow bg-white border-amber-600 m-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-slate-900">Simple Present Tense</h5>
                </a>
                <p class="mb-3 font-normal text-neutral-900">Fred and Adelsten, two childhood friends, are preparing for a magic selection test to become level 3 wizards at a prestigious school in the city of Yden. They plan to practice together but ...</p>
                <a href="{{ route('simple-present') }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-amber-600 hover:bg-amber-900 focus:ring-amber-800">
                    Go
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>

            <div class="p-6 rounded-lg shadow bg-white border-amber-600 m-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-slate-900">Present Continuous Tense</h5>
                </a>
                <p class="mb-3 font-normal text-neutral-900">Fred and Adelsten embark on a journey to find a basic knowledge book for their magic practice at the library. Despite their efforts, the book proves elusive ...</p>
                <a href="{{ route('simple-present') }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-amber-600 hover:bg-amber-900 focus:ring-amber-800">
                    Go
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>

            <div class="p-6 rounded-lg shadow bg-white border-amber-600 m-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-slate-900">Simple Past Tense</h5>
                </a>
                <p class="mb-3 font-normal text-neutral-900">Adelsten, after studying the basic knowledge book at the library, begins practicing magic in the park daily. One day, he encounters his friend Rose, who is saddened by her inability to participate in the magic selection ...</p>
                <a href="{{ route('simple-present') }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-amber-600 hover:bg-amber-900 focus:ring-amber-800">
                    Go
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>

            <div class="p-6 rounded-lg shadow bg-white border-amber-600 m-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-slate-900">Past Continuous Tense</h5>
                </a>
                <p class="mb-3 font-normal text-neutral-900">
                    As the magic selection exam draws near, Adelsten practices diligently in his front yard. Fred pays him a visit, expressing a desire to practice together. Adelsten reveals that he met Rose the previous day at the park ...</p>
                <a href="{{ route('simple-present') }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-amber-600 hover:bg-amber-900 focus:ring-amber-800">
                    Go
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>

            <div class="p-6 rounded-lg shadow bg-white border-amber-600 m-5">
                <a href="#">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-slate-900">Simple Future Tense</h5>
                </a>
                <p class="mb-3 font-normal text-neutral-900">Adelsten faces the oral exam confidently, expressing his desire to help others and embark on an adventure if he becomes a level 3 wizard. Mrs. Elsker acknowledges his responses positively, hinting at his potential success ...</p>
                <a href="{{ route('simple-present') }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-amber-600 hover:bg-amber-900 focus:ring-amber-800">
                    Go
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // var category = 'happiness';
        // $.ajax({
        //     method: 'GET',
        //     url: 'https://api.api-ninjas.com/v1/quotes?category=' + category,
        //     headers: {
        //         'X-Api-Key': 'YgkGQ2OW5oLRI2I2PeS4pQ==z76QxVkUx0KkKGoq'
        //     },
        //     contentType: 'application/json',
        //     success: function(result) {
        //         // Update the HTML content with the quote
        //         var quoteContainer = document.getElementById('quoteContainer');
        //         quoteContainer.innerHTML =
        //             '<p class="font-light text-white">' + result[0].quote + '</p>';
        //     },
        //     error: function ajaxError(jqXHR) {
        //         console.error('Error: ', jqXHR.responseText);
        //     }
        // });
    </script>
@endsection
