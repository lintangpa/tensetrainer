@extends('layout.userlayout')
@section('konten')
<div class="mt-4 p-4 sm:ml-64">
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-lg font-semibold mb-4">Profil Pengguna</h1>

        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Point:</strong> {{ $user->exp }}</p>

        <h2 class="text-lg font-semibold mb-2 mt-4">Achievement</h2>
        @foreach ($achievementInfo as $achievement)
            <div class="mb-2">
                <p><strong>Achievement:</strong> {{ $achievement->nama }}</p>
                <p><strong>Description:</strong> {{ $achievement->deskripsi }}</p>
                <img src="{{URL::asset($achievement->icon)}}" alt="Icon Achievement" class="w-10 h-10">
            </div>
        @endforeach
    </div>
</div>
    <div class="p-4 sm:ml-64">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-lg font-semibold mb-4">Edit Profil</h1>

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
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block font-medium mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input w-full"
                        placeholder="********">
                </div>
{{-- 
                <div class="mb-4">
                    <label for="profile_picture" class="block font-medium mb-1">Foto Profil</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="form-input w-full">
                </div> --}}

                <div>
                    <button type="submit"
                        class="bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-4 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    </script>
    
@endsection
