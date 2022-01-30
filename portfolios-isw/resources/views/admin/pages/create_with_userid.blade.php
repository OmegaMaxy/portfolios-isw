@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ url('users/'.$userId) }}" class="btn btn-primary mt-5">Go back to user</a>
            <div class="card mt-2">
                <div class="card-header">{{ __('Add Page') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('pages') }}">
                        @csrf

                        <input type="hidden" name="user_id" value="{{ $userId }}">
                        <div class="form-group row">
                            <label for="page_url" class="col-md-4 col-form-label text-md-right">{{ __('Markdown URL') }}</label>

                            <div class="col-md-6">
                                <input id="page_url" type="text" class="form-control @error('page_url') is-invalid @enderror" name="page_url" value="{{ old('page_url') }}" required placeholder="https://github.com/OmegaMaxy" autocomplete="off" autofocus>

                                @error('page_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="1" id="statusEnabled">
                                    <label class="form-check-label" for="statusEnabled">
                                        Enabled
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="0" id="statusDisabled" checked>
                                    <label class="form-check-label" for="statusDisabled">
                                        Disabled
                                    </label>
                                </div>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
