@extends('layouts.app')

@section('content')
    <section class="container-fluid mt-3">
        <section>
            <h3>User Overview</h3>
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
                            <td>{{ $user->username }}<a href="{{ $user->linkPath() }}" class="ml-2 badge badge-primary">Details</a></td>
                            <td>{{ $user->fullname() }}</td>
                            <td>{{ $user->role->name }}</td>
                            @if ($user->activePage() != null)
                                <td><a href="{{ $user->activePage()->page_url }}" target="_blank">{{ $user->activePage()->page_url }}</a></td>
                            @else
                                <td>User has no active page.</td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ url('/users/create') }}" class="btn btn-primary">Add user</a>
        </section>
    </section>
@endsection
