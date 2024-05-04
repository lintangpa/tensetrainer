@extends(Auth::user()->isAdmin() ? 'layout.adminlayout' : 'layout.userlayout')
@section('konten')
    <div class="p-4 sm:ml-64">
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-4 lg:px-8">
                <h1 class="text-amber-500 text-center font-bold text-2xl p-4">LEADERBOARD</h1>
                <div class="bg-white rounded-md p-4">
                    <table id="leaderboardTable" class="">
                        <thead class="">
                            <tr class="bg-white text-xs font-medium text-gray-500 uppercase">
                                <th class="">
                                    Rank</th>
                                <th class="">
                                    Name</th>
                                <th class="">
                                    Exp</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-left" >
                            @foreach ($users as $user)
                                <tr>
                                    <td class=" text-black">{{ $user->rank }}</td>
                                    <td class=" text-black">{{ $user->name }}</td>
                                    <td class=" text-black">{{ $user->exp }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#leaderboardTable').DataTable({
                "paging": true, 
                "lengthChange": true, 
                "searching": true,
                "ordering": false, 
                "info": true,
            });
        });
    </script>
@endsection
