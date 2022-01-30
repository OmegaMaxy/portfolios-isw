@extends('layouts.app')

@section('content')
    <section class="container-fluid mt-3">
        <section>
            <h3>Role Overview</h3>
        </section>
        <section>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Amount of users</th>
                        <th>Hierarchy</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}<a href="{{ $role->linkPath() }}" class="ml-2 badge badge-primary">Details</a></td>
                            <td>{{ $role->userAmount() }} users</td>
                            <td>{{ $role->role_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ url('/roles/create') }}" class="btn btn-primary">Add role</a>
        </section>
    </section>
@endsection
