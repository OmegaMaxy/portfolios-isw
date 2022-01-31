@extends('layouts.admin')

@section('content')
    <section class="container-fluid mt-3">
        <section>
            <h3>Viewing a Role</h3>
        </section>
        <section class="mt-4 mb-3">
            <div class="card">
                <div class="card-body"> <!-- max-width: 60%; on PC, leave default on mobile-->
                    <h3>{{ $role->name }} <div class="btn btn-default" title="Level {{ $role->role_number }} in hierarchy">Level <span class="badge badge-danger">{{ $role->role_number }}</span></div></h3>
                    <p>{{ $role->description }}</p>
                    <p>{{ $role->userAmount() }} users with this role.</p>
                </div>
                <form class="ml-3 mb-2" action="{{ url($role->linkPath()) }}" method="POST" style="max-width: 15rem;">
                    @csrf

                    @if($errors->any())
                        {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                    @endif

                    <div class="form-group">
                        <label for="name" class="">{{ __('Role Name') }}</label>

                        <div class="">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name }}" required placeholder="Members" autocomplete="off" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @if ($role->role_number != 1)
                        <div class="form-group">
                            <label for="role_number" class="">{{ __('Role number') }}</label>

                            <div class="">
                                <input id="role_number" type="number" class="form-control @error('role_number') is-invalid @enderror" name="role_number" value="{{ $role->role_number }}">
                                <p class="text-secondary">Number in hierarchy, top starts at 1.</p>
                                @error('role_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="description" class="">{{ __('Description') }}</label>

                        <div class="">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $role->description }}" autocomplete="off">
                            <p class="text-secondary">Optional</p>
                            @error('description')
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


        </section>
        @if ($role->role_number != 1)
            <form action="{{ url($role->linkPath()) }}" method="POST">
                @csrf

                @if($errors->any()) {{ /* TODO: HAS TO BE MORE SPECIFIC */ }}
                    {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                @endif

                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete role</button>
            </form>
        @endif
    </section>
@endsection
