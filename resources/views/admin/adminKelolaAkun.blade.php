@extends('layout.adminlayout')
@section('konten')
    <div class="p-4 sm:ml-64">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
                <h1 class="text-amber-500 text-center font-bold text-2xl p-4">Kelola Akun</h1>
                <div class="bg-white rounded-md p-4 overflow-x-auto">
                    <table id="leaderboardTable" class="">
                        <thead class="">
                            <tr class="bg-white text-xs font-medium text-gray-500 uppercase">
                                <th class="">Nama</th>
                                <th class="">Email</th>
                                <th class="">Role</th>
                                <th class="">Detail</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-left text-black">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <button
                                            class="bg-amber-500 text-white p-1 rounded hover:bg-amber-600 focus:outline-none focus:bg-amber-600 mx-auto aksiBtn"
                                            data-user-id="{{ $user->id }}">Aksi</button>
                                        <button
                                            class="bg-red-500 text-white p-1 rounded hover:bg-red-600 focus:outline-none focus:bg-red-600 mx-auto deleteBtn"
                                            data-user-id="{{ $user->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Aksi -->
    <div id="aksiModal" class="fixed inset-0 z-10 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="relative bg-white rounded-lg w-1/2 sm:w-1/3 px-8 py-6">
                <div class="absolute top-0 right-0 pt-2 pr-2">
                    <button id="closeAksiModal" class="text-gray-500 hover:text-gray-800 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>
                <h1 class="text-lg font-bold mb-4">Update User</h1>
                <form id="updateAksiForm" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-amber-500 focus:ring focus:ring-amber-200"
                            required data-user-id="{{ $user->name }}">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email"
                            class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-amber-500 focus:ring focus:ring-amber-200"
                            required data-user-id="{{ $user->id }}">
                    </div>
                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                        <select name="role" id="role"
                            class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-amber-500 focus:ring focus:ring-amber-200"
                            required>
                            <option value="student">Student</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="exp" class="block text-sm font-medium text-gray-700">Exp</label>
                        <input type="text" name="exp" id="exp"
                            class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-amber-500 focus:ring focus:ring-amber-200"
                            value="{{ $user->exp }}">
                    </div>
                    <div class="mb-4">
                        <label for="progress" class="block text-sm font-medium text-gray-700">Progress</label>
                        <input type="text" name="progress" id="progress"
                            class="mt-1 p-2 block w-full h-auto rounded-md border-gray-300 focus:border-amber-500 focus:ring focus:ring-amber-200"
                            data-user-id="{{ json_encode($user->progress) }}">
                    </div>

                    <div class="mb-4">
                        <label for="achievement" class="block text-sm font-medium text-gray-700">Achievement</label>
                        <input type="text" name="achievement" id="achievement"
                            class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-amber-500 focus:ring focus:ring-amber-200"
                            data-user-id="{{ json_encode($user->achievement) }}">
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-amber-500 text-white py-2 px-4 rounded-md hover:bg-amber-600 focus:outline-none focus:bg-amber-600">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script>
        var token = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('#leaderboardTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": true,
            });

            var userId;

            $(document).on('click', '.aksiBtn', function() {
                userId = $(this).data('user-id');
                console.log(userId);
                $('#user_id').val(userId);
                $.ajax({
                    url: '/users/' + userId,
                    type: 'GET',
                    success: function(response) {
                        $('#name').val(response.name);
                        $('#email').val(response.email);
                        $('#role').val(response.role);
                        var progressJson = JSON.stringify(response.progress);
                        var achievementJson = JSON.stringify(response.achievement);
                        $('#exp').val(response.exp);
                        $('#progress').val(progressJson);
                        $('#achievement').val(achievementJson);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
                $('#aksiModal').removeClass('hidden');
            });

            $('#closeAksiModal').click(function() {
                $('#aksiModal').addClass('hidden');
            });

            $('#updateAksiForm').submit(function(event) {
                event.preventDefault();
                var form = $(this);
                $.ajax({
                    url: '/usersDetail/' + userId,
                    type: "POST",
                    data: form.serialize(),
                    success: function(response) {
                        window.location.href = "{{ route('admin-kelola-akun') }}";
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $(document).on('click', '.deleteBtn', function() {
                var userId = $(this).data('user-id');
                if (confirm("Are you sure you want to delete this user?")) {
                    $.ajax({
                        url: '/usersDelete/' + userId,
                        type: 'DELETE',
                        data: {
                            _token: token
                        },
                        success: function(response) {
                            window.location.href = "{{ route('admin-kelola-akun') }}";
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
@endsection
