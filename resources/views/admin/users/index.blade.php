@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">All Users</div>
        <div class="card-body">
            <table id="usersTable" class="table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Total Expenses</th>
                        <th>Registered At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->expenses->sum('amount') }}</td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });
        });
    </script>
@endsection