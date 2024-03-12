@extends('layout.userlayout')
@section('konten')
    <div class="max-w-md mx-auto mt-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-lg font-semibold mb-4">Edit Profil</h1>

            <div class="max-w-md mx-auto mt-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h1 class="text-lg font-semibold mb-4">Profil Pengguna</h1>
        
                    <p><strong>Nama:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>EXP:</strong> {{ $user->exp }}</p>
        
                    <h2 class="text-lg font-semibold mb-2 mt-4">Pencapaian</h2>
                    @foreach ($achievementInfo as $achievement)
                        <div class="mb-2">
                            <p><strong>Nama Achievement:</strong> {{ $achievement->nama }}</p>
                            <p><strong>Deskripsi Achievement:</strong> {{ $achievement->deskripsi }}</p>
                            <img src="{{ $achievement->icon }}" alt="Icon Achievement" class="w-10 h-10">
                        </div>
                    @endforeach
                </div>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block font-medium mb-1">Nama</label>
                    <input type="text" name="name" id="name" value="{{ auth()->user()->name }}"
                        class="form-input w-full">
                </div>

                <div class="mb-4">
                    <label for="email" class="block font-medium mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ auth()->user()->email }}"
                        class="form-input w-full">
                </div>

                <div class="mb-4 relative">
                    <label for="password" class="block font-medium mb-1">Password</label>
                    <input type="password" name="password" id="password" class="form-input w-full pr-10"
                        placeholder="********" value="">
                    <button type="button" onclick="togglePasswordVisibility()"
                        class="absolute inset-y-0 right-0 flex items-center px-3 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 cursor-pointer" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.93 4.93a9 9 0 0112.74 0M19.07 19.07a9 9 0 01-12.74 0M6.36 6.36a4 4 0 015.28 5.28" />
                        </svg>
                    </button>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block font-medium mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input w-full"
                        placeholder="********">
                </div>

                <div class="mb-4">
                    <label for="profile_picture" class="block font-medium mb-1">Foto Profil</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-input w-full">
                </div>

                <div>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var icon = document.querySelector("#password + button svg");
    
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove("text-gray-400");
                icon.classList.add("text-blue-500");
            } else {
                passwordInput.type = "password";
                icon.classList.remove("text-blue-500");
                icon.classList.add("text-gray-400");
            }
        }
    </script>
    
@endsection
