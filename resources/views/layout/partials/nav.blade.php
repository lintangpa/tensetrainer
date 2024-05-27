<header class="bg-slate-900 text-white body-font">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center justify-center relative">
        <image src="{{URL::asset('/image/logo.png')}}" class="mx-auto my-4 w-40 md:w-60 lg:w-80 xl:w-96 block" alt="Logo">
        <a href="{{ route('login') }}">
            <button class="inline-flex items-center bg-amber-500 text-white border-0 py-1 px-3 focus:outline-none hover:bg-amber-600 rounded text-lg font-medium mt-4 md:mt-0 fixed top-8 right-8">
                Play Now
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </button>
        </a>
        <div class="inline-flex items-center fixed top-8 left-8">
            <a id="languageSwitch">
                <img id="flagImage" src="{{URL::asset('uk.png')}}" alt="Switch Language" width="48px" height="48px">
            </a>
        </div>
    </div>
    
</header>
