@extends('layouts.app')

@section('content')
    <section class="container-fluid mt-3">
        <section>
            <h3>Role Overview</h3>
        </section>
        <section class="mt-4 mb-3">
            <div class="card card-body">
                <h3>{{ $role->name }} <div class="btn btn-default">Level <span class="badge badge-light">{{ $role->role_number }}</span></div></h3>
                <p>{{ $role->description }}</p>
                <p>{{ $role->userAmount() }} users with this role.</p>
            </div>


        </section>
        <form action="{{ url($role->linkPath()) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete role</button>
        </form>
    </section>
@endsection
