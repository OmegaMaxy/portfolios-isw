@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="mt-4 mb-4">
            <h2>{{ $user->fullname() }} aka {{ $user->username }} | {{ $user->role->name }}</h2>
        </section>
        <hr>
        <section class="mt-4">
            @parsedown($markdown_portfolio)
        </section>
    </div>
@endsection
