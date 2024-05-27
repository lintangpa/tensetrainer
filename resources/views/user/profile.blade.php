@extends('layout.userlayout')
@section('konten')
    <div class="mt-4 p-4 sm:ml-64">
        <div class="grid grid-cols-2 gap-0">
            <h1 class="text-amber-500 font-bold text-2xl p-4">PROFILE MENU</h1>
            <div class="">
                <button id="profilBtn"
                    class="bg-amber-500 text-white px-4 py-2 rounded mt-4 hover:bg-amber-600 focus:outline-none focus:bg-amber-600 mx-auto">Profile</button>
                <button id="achievementBtn"
                    class="bg-amber-500 text-white px-4 py-2 rounded mt-4 hover:bg-amber-600 focus:outline-none focus:bg-amber-600 mx-auto">Achievement</button>
                <button id="editBtn"
                    class="bg-amber-500 text-white px-4 py-2 rounded mt-4 hover:bg-amber-600 focus:outline-none focus:bg-amber-600 mx-auto">Edit
                    Profile</button>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md mt-4" id="profileBlock">
            <h1 class="font-semibold mb-4 text-3xl">Profile</h1>
            <p class="mt-2"><strong>Name <br>
                    <div class="mt-2 border-2 border-slate-300 p-2 rounded-md">
                </strong> {{ $user->name }}
        </div>
        </p>
        <p class="mt-2"><strong>Email <br>
                <div class="mt-2 border-2 border-slate-300 p-2 rounded-md">
            </strong> {{ $user->email }}
        </div>
        </p>
        <p class="mt-2"><strong>Point <br>
                <div class="mt-2 border-2 border-slate-300 p-2 rounded-md">
            </strong> {{ $user->exp }}</div>
        </p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md mt-4" id="achievementBlock" style="display:none;">
        <h2 class="font-semibold mb-4 text-3xl">Achievement</h2>
        @foreach ($achievementInfo as $achievement)
            <div class="bg-slate-100 p-6 rounded-lg shadow-md mb-2">
                <img src="{{ asset('storage/images/' . $achievement->icon) }}" alt="Icon Achievement" class="w-10 h-10">
                <p><strong>{{ $achievement->nama }}</strong></p>
                <p><strong>Description:</strong> {{ $achievement->deskripsi }}</p>
            </div>
        @endforeach
    </div>
    <div class="bg-white p-6 rounded-lg shadow-md mt-4" id="editBlock" style="display:none;">
        <h1 class="text-lg font-semibold mb-4">Edit Profil</h1>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-medium mb-1">Name</label>
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
                <input type="password" name="password" id="password" class="form-input w-full pr-10" placeholder="********"
                    value="">
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block font-medium mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-input w-full"
                    placeholder="********">
            </div>

            <div>
                <button type="submit"
                    class="bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-4 rounded">Save</button>
            </div>
        </form>
    </div>
    </div>

    <script>
        document.getElementById('achievementBtn').addEventListener('click', function() {
            document.getElementById('profileBlock').style.display = 'none';
            document.getElementById('achievementBlock').style.display = 'block';
            document.getElementById('editBlock').style.display = 'none';
        });

        document.getElementById('profilBtn').addEventListener('click', function() {
            document.getElementById('profileBlock').style.display = 'block';
            document.getElementById('achievementBlock').style.display = 'none';
            document.getElementById('editBlock').style.display = 'none';
        });

        document.getElementById('editBtn').addEventListener('click', function() {
            document.getElementById('profileBlock').style.display = 'none';
            document.getElementById('achievementBlock').style.display = 'none';
            document.getElementById('editBlock').style.display = 'block';
        });
    </script>
@endsection
