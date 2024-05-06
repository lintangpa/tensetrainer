    @extends('layout.adminlayout')
    @section('konten')
        <div class="p-4 sm:ml-64">
            <div class="py-6">
                <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
                    <h1 class="text-amber-500 text-center font-bold text-2xl p-4">Kelola Akun</h1>
                    <div class="flex justify-end mb-4">
                        <button id="tambahBtn"
                            class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">Tambah
                            Data</button>
                    </div>
                    <div class="bg-white rounded-md p-4 overflow-x-auto">
                        <table id="leaderboardTable" class="">
                            <thead class="">
                                <tr class="bg-white text-xs font-medium text-gray-500 uppercase">
                                    <th class="">Nama</th>
                                    <th class="">Deskripsi</th>
                                    <th class="">Requirement</th>
                                    <th class="">Icon</th>
                                    <th class="">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-left text-black">
                                @foreach ($achievement as $achievement)
                                    <tr>
                                        <td>{{ $achievement->nama }}</td>
                                        <td>{{ $achievement->deskripsi }}</td>
                                        <td>{{ $achievement->requirement }}</td>
                                        <td>{{ $achievement->icon }}</td>
                                        <td>
                                            <button
                                                class="bg-amber-500 text-white p-1 rounded hover:bg-amber-600 focus:outline-none focus:bg-amber-600 mx-auto aksiBtn"
                                                data-achievement-id="{{ $achievement->id }}">Aksi</button>
                                            <button
                                                class="bg-red-500 text-white p-1 rounded hover:bg-red-600 focus:outline-none focus:bg-red-600 mx-auto deleteBtn"
                                                data-achievement-id="{{ $achievement->id }}">Delete</button>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <h1 class="text-lg font-bold mb-4">Update Achievement</h1>
                    <form id="updateAksiForm" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="nama" id="nama"
                                class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-amber-500 focus:ring focus:ring-amber-200"
                                required value="{{ $achievement->nama }}">
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <input type="text" name="deskripsi" id="deskripsi"
                                class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-amber-500 focus:ring focus:ring-amber-200"
                                required value="{{ $achievement->deskripsi }}">
                        </div>
                        <div class="mb-4">
                            <label for="requirement" class="block text-sm font-medium text-gray-700">Requirement</label>
                            <input type="text" name="requirement" id="requirement"
                                class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-amber-500 focus:ring focus:ring-amber-200"
                                required value="{{ $achievement->requirement }}">
                        </div>
                        <div class="mb-4">
                            <label for="icon" class="block text-sm font-medium text-gray-700">Icon</label>
                            <input type="text" name="icon" id="icon"
                                class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-amber-500 focus:ring focus:ring-amber-200"
                                required value="{{ $achievement->icon }}">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-amber-500 text-white py-2 px-4 rounded-md hover:bg-amber-600 focus:outline-none focus:bg-amber-600">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Data -->
        <div id="tambahModal" class="fixed inset-0 z-10 overflow-y-auto hidden">
            <div class="flex items-center justify-center min-h-screen">
                <div class="relative bg-white rounded-lg w-1/2 sm:w-1/3 px-8 py-6">
                    <div class="absolute top-0 right-0 pt-2 pr-2">
                        <button id="closeTambahModal" class="text-gray-500 hover:text-gray-800 focus:outline-none">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <h1 class="text-lg font-bold mb-4">Tambah Data Achievement</h1>
                    <form id="tambahForm" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                            <input type="text" name="nama" id="nama"
                                class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-amber-500 focus:ring focus:ring-amber-200"
                                required value="nama Achievement">
                        </div>
                        <div class="mb-4">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                            <input type="text" name="deskripsi" id="deskripsi"
                                class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-amber-500 focus:ring focus:ring-amber-200"
                                required value="Deskripsi Achievement">
                        </div>
                        <div class="mb-4">
                            <label for="requirement" class="block text-sm font-medium text-gray-700">Requirement</label>
                            <input type="text" name="requirement" id="requirement"
                                class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-amber-500 focus:ring focus:ring-amber-200"
                                required value="{{ json_encode(['simple_present' => ['quest_3' => 1]]) }}">
                        </div>
                        <div class="mb-4">
                            <label for="icon" class="block text-sm font-medium text-gray-700">Icon</label>
                            <input type="text" name="icon" id="icon"
                                class="mt-1 p-2 block w-full rounded-md border-gray-300 focus:border-amber-500 focus:ring focus:ring-amber-200"
                                required value="tensetrainer.png">
                        </div>
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-green-700 text-white py-2 px-4 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">Tambah</button>
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

                var achievementId;

                $('.aksiBtn').click(function() {
                    achievementId = $(this).data('achievement-id');
                    $.ajax({
                        url: '/achievement/' + achievementId,
                        type: 'GET',
                        success: function(response) {
                            $('#nama').val(response.nama);
                            $('#deskripsi').val(response.deskripsi);
                            $('#requirement').val(response.requirement);
                            $('#icon').val(response.icon);
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
                        url: '/achievementDetail/' + achievementId,
                        type: "POST",
                        data: form.serialize(),
                        success: function(response) {
                            window.location.href = "{{ route('admin-kelola-achievement') }}";
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });

                $('.deleteBtn').click(function() {
                    var achievementId = $(this).data('achievement-id');
                    if (confirm("Are you sure you want to delete this achievement?")) {
                        $.ajax({
                            url: '/achievementDelete/' + achievementId,
                            type: 'DELETE',
                            data: {
                                _token: token
                            },
                            success: function(response) {
                                window.location.href = "{{ route('admin-kelola-achievement') }}";
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });

                $('#tambahBtn').click(function() {
                    $('#tambahModal').removeClass('hidden');
                });

                $('#closeTambahModal').click(function() {
                    $('#tambahModal').addClass('hidden');
                });

                $('#tambahForm').submit(function(event) {
                    event.preventDefault();

                    var form = $(this);

                    $.ajax({
                        url: '/achievementTambah',
                        type: "POST",
                        data: form.serialize(),
                        success: function(response) {
                            window.location.href = "{{ route('admin-kelola-achievement') }}";
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });

            });
        </script>
    @endsection
