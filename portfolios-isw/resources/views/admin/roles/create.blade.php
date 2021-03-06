@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">{{ __('Create Role') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/admin/roles') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Role Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="Members" autocomplete="off" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role_number" class="col-md-4 col-form-label text-md-right">{{ __('Role number') }}</label>

                            <div class="col-md-6">
                                <input id="role_number" type="number" class="form-control @error('role_number') is-invalid @enderror" name="role_number" value="{{ $last_role_number + 1 }}">
                                <p class="text-secondary">Number in hierarchy, top starts at 1.</p>
                                @error('role_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="off">
                                <p class="text-secondary">Optional</p>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="color" class="col-md-4 col-form-label text-md-right">{{ __('Role Color') }}</label>

                            <div class="d-flex col-md-6">
                                <div style="background: {{ \App\Models\Role::DEFAULT_COLOR }};width: 50px;margin-right: 1rem;border-radius: 4px;"></div>
                                <input id="colorpicker" type="text" class="form-control @error('color') is-invalid @enderror" style="color: {{  \App\Models\Role::DEFAULT_COLOR }}" name="color" placeholder="{{  \App\Models\Role::DEFAULT_COLOR }}" autocomplete="off">

                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
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
