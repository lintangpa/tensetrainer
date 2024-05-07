@extends('layout.loginlayout')
@section('konten')
    <section class="p-2">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0 drop-shadow-xl">
            <a href="/" class="flex items-center mb-6 text-white  text-xl font-bold drop-shadow-lg">
                <img class="h-full mr-2 w-56" src="{{ URL::asset('/image/logo.png') }}" alt="">
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-center text-2xl font-semiboldleading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('login-proses') }}" method="POST">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="youremail@mail.com" required="">
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                required="">
                        </div>
                        <div class="flex items-center justify-end">
                            <a href="{{route('forgot-password')}}"
                                class=" text-sm font-light text-slate-600 hover:underline dark:text-slate-500">Forgot
                                password?</a>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-slate-400 hover:bg-slate-500 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-slate-500 dark:hover:bg-slate-600 dark:focus:ring-slate-800">Sign
                            in</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400 text-center">
                            Don’t have an account yet? <a href="{{route('register')}}"
                                class="font-medium text-slate-600 hover:underline dark:text-slate-500">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            @if ($message = Session::get('failed'))
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "{{ $message }}",
                });
            @endif
        </script>
    </section>
@endsection
