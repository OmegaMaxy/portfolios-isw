@extends('layouts.admin')

@section('content')
    <section class="container-fluid mt-3">
        <section>
            <h3>Users</h3>
        </section>
        <section>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Page url</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->username }}<a href="{{ $user->linkPathAdmin() }}" class="ml-2 badge badge-primary">Details</a></td>
                            <td>{{ $user->fullname() }}</td>
                            <td>{{ $user->role->name }}</td>
                            @if ($user->activePage() != null)
                                <td><span class="ot-dot ot-green-dot"></span> <a href="/profile/{{ $user->username }}" target="_blank">profile/{{ $user->username }}</a></td>
                            @else
                                <td><span class="ot-dot ot-red-dot"></span> User has no active page.</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ url('/users/create') }}" class="btn btn-primary">Add user</a>
        </section>
    </section>
@endsection
