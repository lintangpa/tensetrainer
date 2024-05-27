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
                        Buat Akun Baru
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('register-proses') }}" method="POST">
                        @csrf

                        <div>
                            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Nama</label>
                            <input type="name" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="your name" required="" value="{{ old('name') }}">
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                placeholder="youremail@mail.com" required="" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                required="">
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-slate-400 hover:bg-slate-500 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-slate-500 dark:hover:bg-slate-600 dark:focus:ring-slate-800">Daftar</button>
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
