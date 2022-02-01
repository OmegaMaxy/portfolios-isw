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
                        @if (session('result'))
                            <div class="alert alert-success">
                                {{ session('result') }}
                            </div>
                        @endif

                        @if(!empty($warnings))
                            @foreach ($warnings as $warning)
                                <div class="alert alert-warning" role="alert">{{ $warning }}</div>
                            @endforeach
                        @endif

                        <div class="card mb-3">
                            <div class="card-body">
                                <h3>Change colors</h3>
                                <form class="mb-2" action="{{ url('/profile/customize/change-colors') }}" method="POST" style="max-width: 15rem;">
                                    @csrf

                                    @if($errors->any())
                                        {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                                    @endif

                                    <div class="form-group">
                                        <label for="background_color" class="">{{ __('Background Color') }}</label>

                                        <div class="d-flex">
                                            <div style="background: {{ auth()->user()->background_color }};width: 50px;margin-right: 1rem;border-radius: 4px;"></div>
                                            <input id="colorpicker" type="text" class="form-control @error('background_color') is-invalid @enderror" style="color: {{ auth()->user()->background_color }}" name="background_color" value="{{ auth()->user()->background_color }}" placeholder="#39f" autocomplete="off">

                                            @error('background_color')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="foreground_color" class="">{{ __('Foreground Color') }}</label>

                                        <div class="d-flex">
                                            <div style="background: {{ auth()->user()->foreground_color }};width: 50px;margin-right: 1rem;border-radius: 4px;"></div>
                                            <input id="colorpicker2" type="text" class="form-control @error('foreground_color') is-invalid @enderror" style="color: {{ auth()->user()->foreground_color }}" name="foreground_color" value="{{ auth()->user()->foreground_color }}" placeholder="#39f" autocomplete="off">

                                            @error('foreground_color')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    @method('PATCH')
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <form class="mb-2" method="POST" action="{{ url('/profile/customize/upload-image') }}" enctype="multipart/form-data">
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
                                    <form method="POST" action="{{ url('/profile/customize/delete-image') }}">
                                        @csrf
                                        <img src="{{ auth()->user()->pf() }}" alt="Your profile picture" class="mb-3 mt-3" style="height: 5rem;border:2px solid gray;display: block;">
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete profile picture</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </section>
                    <section class="mt-5">
                        <h1>Your social handles: </h1>
                        <form class="mb-2" action="{{ url('/profile/customize/handle/twitter') }}" method="POST" style="max-width: 15rem;">
                            @csrf

                            @method('PATCH')
                            @if($errors->any())
                                {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                            @endif

                            <div class="form-group">
                                <label for="handle" class="">{{ __('Twitter') }}</label>

                                <div class="">
                                    <input id="handle" type="text" class="form-control @error('handle') is-invalid @enderror" name="handle" value="{{ $handles['twitter_handle'] }}" required placeholder="donaldtrump" autocomplete="off">

                                    @error('handle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                        <form class="mb-2" action="{{ url('/profile/customize/handle/github') }}" method="POST" style="max-width: 15rem;">
                            @csrf

                            @method('PATCH')
                            @if($errors->any())
                                {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                            @endif

                            <div class="form-group">
                                <label for="handle" class="">{{ __('Github') }}</label>

                                <div class="">
                                    <input id="handle" type="text" class="form-control @error('handle') is-invalid @enderror" name="handle" value="{{ $handles['github_handle'] }}" required placeholder="omegamaxy" autocomplete="off">

                                    @error('handle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                        <form class="mb-2" action="{{ url('/profile/customize/handle/linkedin') }}" method="POST" style="max-width: 15rem;">
                            @csrf

                            @method('PATCH')
                            @if($errors->any())
                                {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                            @endif

                            <div class="form-group">
                                <label for="handle" class="">{{ __('Linkedin') }}</label>

                                <div class="">
                                    <input id="handle" type="text" class="form-control @error('handle') is-invalid @enderror" name="handle" value="{{ $handles['linkedin_handle'] }}" required placeholder="omegamaxy" autocomplete="off">
                                    <p class="text-secondary">Visit your profile and copy the part after <b>/in/</b> => www.linkedin.com/in/your-username-here</p>
                                    @error('handle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                        <p class="text-secondary">More options coming soon..</p>
                    </section>
                </div>
            </div>
        </section>
    </section>
    @section('javascript')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
        <script>
            $('#colorpicker').colorpicker();
            $('#colorpicker2').colorpicker();
        </script>
    @stop
@endsection
