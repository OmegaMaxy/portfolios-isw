@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <section class="container" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUHNoKb6n8cRAjyputJ9vn4OPdujzLJr52OQ&usqp=CAU');background-repeat: no-repeat;background-size: cover;">
                <div class="jumbotron" style="background: none;">
                    <h1 class="display-4">Welcome to ISW Portfolios</h1>
                    <p class="lead">A simple website to view our member's portfolios.</p>
                    <hr class="my-4">
                    <p>If you're a member, be sure join below and add your portfolio!</p>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="/register" role="button">Join</a>
                    </p>
                </div>
            </section>
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
            @endif
            <p>Big background image here.</p>
            <h1>Title here - ISW Portfolios</h1>
            <p>Scroll a bit further for an overview</p>
            <section class="d-flex" style="flex-wrap: wrap;justify-content: center;">
                @forelse ($users as $user)
                    <x-user-tile :user="$user"/>
                @empty
                    <p>There are no portfolios to view right now.</p>
                @endforelse
            </section>
        </div>
    </div>
</div>
@endsection
