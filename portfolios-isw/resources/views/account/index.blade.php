@extends('layouts.app')

@section('content')
    <section class="container-fluid mt-3">
        <section>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h3>Account Overview <a href="/profile/{{ auth()->user()->username }}" class="btn btn-success">View portfolio</a></h3>

                    @if($errors->any())
                        {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                    @endif

                    <p>Reset password here etc.</p>
                </div>
            </div>
        </section>
    </section>
@endsection
