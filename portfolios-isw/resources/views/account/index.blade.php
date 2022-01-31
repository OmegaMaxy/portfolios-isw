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

                    <form method="POST" action="{{ url('/account/upload-image') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="pf" class="">{{ __('Profile Picture') }}</label>

                            <div class="">
                                <input id="pf" type="file" class="form-control-file @error('pf') is-invalid @enderror" name="pf">
                                @error('pf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <div class="">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Upload') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @if (!empty(auth()->user()->profile_picture))
                        <form method="POST" action="{{ url('/account/delete-image') }}">
                            @csrf
                            <img src="{{ auth()->user()->pf() }}" alt="Your profile picture" class="mb-3 mt-3" style="height: 5rem;border:2px solid black;display: block;">
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete profile picture</button>
                        </form>
                    @endif
                </div>
            </div>
        </section>
    </section>
@endsection
