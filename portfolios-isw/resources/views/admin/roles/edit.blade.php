@extends('layouts.admin')

@section('content')
    <section class="container-fluid mt-3">
        <section>
            <h3>Role Overview</h3>
        </section>
        <section>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Amount of users</th>
                        <th>Hierarchy</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            <td>{{ $role->userAmount() }}</td>
                            <td>{{ $role->role_number }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </section>
@endsection
