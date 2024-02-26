@extends('layout.homelayout')
@section('konten')
    <section class="bg-violet-600 text-white body-font">
        <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
            <div
                class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-yellow-500">
                    One Verb at a Time with TenseTrainer!
                </h1>
                <p class="mb-8 leading-relaxed">Mastery of tenses is the key to mastering a language, and TenseTrainer is
                    here to make this journey more engaging and effective for language learners.</p>
                <div class="flex justify-center">
                    <a href="{{ route('login') }}"><button
                            class="inline-flex text-white bg-yellow-500 border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded text-lg">Start
                            Now !</button>
                    </a>
                </div>
            </div>
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                <img class="object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
            </div>
        </div>
    </section>
@endsection
