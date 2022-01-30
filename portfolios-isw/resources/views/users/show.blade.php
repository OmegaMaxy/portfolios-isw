@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $user->fullname() }} aka {{ $user->username }} | {{ $user->role->name }}</h2>
        <section>
            {{ $markdown_portfolio }}
        </section>
    </div>
@endsection
