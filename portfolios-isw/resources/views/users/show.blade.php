@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: {{ $user->background_color }};
            color: {{ $user->foreground_color }};
        }
        hr {
            background: {{ $user->foreground_color }};
        }
        .btn.btn-outline-primary:hover {
            color: inherit;
            background: inherit;
        }
    </style>
    <div class="container">
        <section class="mt-4 mb-4 d-flex">
            <div class="mr-5">
                <img src="{{ $user->pf() }}" class="img-thumbnail rounded" style="height: 150px;" alt="Profile Picture of {{ $user->username }}"/>
            </div>
            <div style="align-self: center;">
                <h2>{{ $user->fullname() }} aka {{ $user->username }}</h2>
                <p class="btn btn-outline-primary" style="color: {{ $user->role->color }}">{{ $user->role->name }}</p>
            </div>
        </section>
        <section>
            <h3>Social Handles</h3>
            <div class="btn-group">
                @foreach (auth()->user()->getHandles() as $handle)
                    @if ($handle['isEmpty'] == false)
                        <a href="{{ $handle['url'] }}" class="btn btn-primary mr-3" style="{{ $handle['style'] }}">@svg($handle['icon']) <span style="vertical-align: middle;">{{ $handle['handle'] }}</span></a>
                    @endif
                @endforeach
            </div>
        </section>
        <hr/>
        <section class="mt-4">
            @parsedown($markdown_portfolio)
        </section>
    </div>
@endsection
