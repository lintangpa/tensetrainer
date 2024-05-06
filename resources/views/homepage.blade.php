@extends('layout.homelayout')
@section('konten')
    <section class="bg-slate-900 text-white body-font">
        <div class="container mx-auto flex flex-col px-5 py-24 md:flex-row items-center justify-center">
            <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 text-amber-500 font-bold">
                    Turn Your Grammar Learning into a Magical Adventure
                </h1>
                <p class="mb-8 leading-relaxed">Adelsten is an application that transforms learning tenses into a magical game. Every step you take in understanding tenses brings you closer to achieving your goals. With experience points you earn, you will embark on a journey that takes you to a world full of wonders and new knowledge.</p>
                <div class="flex justify-center items-center"> 
                    <a href="{{ route('login') }}">
                        <button class="text-white bg-amber-500 border-0 py-2 px-6 focus:outline-none hover:bg-amber-600 rounded text-lg">Play Now</button>
                    </a>
                </div>
            </div>
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                <img class="object-cover object-center rounded" alt="hero" src="{{URL::asset('/image/School1.png')}}">
            </div>
        </div>
        <div class="container mx-auto flex flex-col px-5 py-6 md:flex-row items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-6 h-6">
                <path fill-rule="evenodd" d="M11.47 13.28a.75.75 0 0 0 1.06 0l7.5-7.5a.75.75 0 0 0-1.06-1.06L12 11.69 5.03 4.72a.75.75 0 0 0-1.06 1.06l7.5 7.5Z" clip-rule="evenodd" stroke="rgb(234 179 8)" stroke-width="2" />
                <path fill-rule="evenodd" d="M11.47 19.28a.75.75 0 0 0 1.06 0l7.5-7.5a.75.75 0 1 0-1.06-1.06L12 17.69l-6.97-6.97a.75.75 0 0 0-1.06 1.06l7.5 7.5Z" clip-rule="evenodd" stroke="rgb(234 179 8)" stroke-width="2" />
            </svg>            
        </div>
        <div class="container mx-auto flex flex-col px-5 py-6 items-center text-center justify-center">
            <div>
                <h1 class="text-3xl text-amber-500 font-bold mb-4">Explore, learn, and master the 5 tenses with Adelsten!</h1>
                <p class="">Join this magical journey and let's make grammar learning an exciting adventure!</p>
            </div>
            <div class="flex justify-center flex-wrap mt-8">
                <img src="{{URL::asset('/image/Simple Present.png')}}" alt="" class="mx-2 w-56 h-auto object-contain">
                <img src="{{URL::asset('/image/Present Continuous.png')}}" alt="" class="mx-2 w-64 h-auto object-contain">
                <img src="{{URL::asset('/image/Simple Past.png')}}" alt="" class="mx-2 w-44 h-auto object-contain">
                <img src="{{URL::asset('/image/Past Continuous.png')}}" alt="" class="mx-2 w-52 h-auto object-contain">
                <img src="{{URL::asset('/image/Simple Future.png')}}" alt="" class="mx-2 w-52 h-auto object-contain">
            </div>                       
        </div>
    </section>
@endsection
