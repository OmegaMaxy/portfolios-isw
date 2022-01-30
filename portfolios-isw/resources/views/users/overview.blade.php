@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <section class="mt-4 mb-4">
                <h1>Our members</h1>
            </section>
            <section class="mt-4">
                @forelse ($users as $user)
                    <x-user-tile :user="$user"/>
                @empty
                    <p>There are no members.</p>
                @endforelse
            </section>
        </div>
    </div>
</div>
@endsection
