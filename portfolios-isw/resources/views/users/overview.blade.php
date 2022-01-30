@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Our members</h1>
            <section>
                @forelse ($users as $user)
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUHNoKb6n8cRAjyputJ9vn4OPdujzLJr52OQ&usqp=CAU" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->fullname() }}</h5>
                            <p class="card-text">{{ $user->username }} <label class="badge badge-primary">{{ $user->role->name }}</label></p>

                            <a href="#their-page" class="btn btn-primary">View</a>
                        </div>
                    </div>
                @empty
                    <p>There are no members.</p>
                @endforelse
            </section>
        </div>
    </div>
</div>
@endsection
