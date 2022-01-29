@extends('layouts.app')

@section('content')
    <section class="container-fluid mt-3">
        <section>
            <h3>Viewing a User's Page</h3>
        </section>
        <section class="mt-4 mb-3">
            <div class="card">
                <div class="card-body"> <!-- max-width: 60%; on PC, leave default on mobile-->
                    <h3>{{ $page->user->fullname() }} <div class="btn btn-default">Role: <span class="badge badge-light">{{ $page->user->role->name }}</span></div></h3>

                    <p>Page is {{ $page->statusToText() }}</p>
                    <a href="{{ $page->page_url }}" target="_blank">View this page</a>
                </div>

            </div>


        </section>
        <!-- for owner of the page -->
        <!--<form action="{{ url($page->linkPath()) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete page</button>
        </form> -->
    </section>
@endsection
