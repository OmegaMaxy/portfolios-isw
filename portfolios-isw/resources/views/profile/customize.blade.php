@extends('layouts.app')

@section('content')
    <section class="container-fluid mt-5">
        <section>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h3>Profile <a href="/profile/{{ auth()->user()->username }}" class="btn btn-success">View portfolio</a></h3>

                    <section class="mt-4">
                        @if($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                        @endif

                        @if(!empty($warnings))
                            @foreach ($warnings as $warning)
                                <div class="alert alert-warning" role="alert">{{ $warning }}</div>
                            @endforeach
                        @endif

                        <form class="mb-2" action="{{ url('/profile/customize/change-background') }}" method="POST" style="max-width: 15rem;">
                            @csrf

                            @if($errors->any())
                                {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                            @endif

                            <div class="form-group">
                                <label for="background_color" class="">{{ __('Background Color') }}</label>

                                <div class="">
                                    <input id="colorpicker" type="text" class="form-control @error('background_color') is-invalid @enderror" name="background_color" value="{{ auth()->user()->background_color }}" required placeholder="#39f" autocomplete="off">

                                    @error('background_color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            @method('PATCH')
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        <form class="mb-2" method="POST" action="{{ url('/account/upload-image') }}" enctype="multipart/form-data">
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
                    </section>
                </div>
            </div>
        </section>
    </section>
    @section('javascript')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
        <script>
            $('#colorpicker').colorpicker();
        </script>
    @stop
@endsection
