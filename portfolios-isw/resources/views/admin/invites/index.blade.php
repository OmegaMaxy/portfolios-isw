@extends('layouts.app')

@section('content')
    <section class="container-fluid mt-3">
        <section class="mb-4">
            <h3>Invites</h3>
            <form action="/admin/invites" method="post">
                @csrf

                <div class="form-group row">
                    <label for="valid_till" class="col-md-4 col-form-label text-md-right">{{ __('Expire after') }}</label>

                    <div class="col-md-6">
                        <input id="valid_till" type="date" class="form-control @error('valid_till') is-invalid @enderror" name="valid_till" value="{{ old('valid_till') }}" required autocomplete="off" autofocus>

                        @error('valid_till')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="max_uses" class="col-md-4 col-form-label text-md-right">{{ __('Max number of uses') }}</label>

                    <div class="col-md-6">
                        <input id="max_uses" type="number" class="form-control @error('max_uses') is-invalid @enderror" name="max_uses" placeholder="250">
                        <p class="text-secondary">Leave empty to set no limit</p>
                        @error('max_uses')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add invite') }}
                        </button>
                    </div>
                </div>
            </form>
        </section>
        <section>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Link</th>
                        <th>Valid Until</th>
                        <th>Uses left / Max Uses</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invites as $invite)
                        <tr>
                            <td><a href="{{ $invite->linkPath() }}" class="ml-2 badge badge-primary">{{ $invite->linkPath() }}</a></td>
                            <td>{{ $invite->valid_till }}</td>
                            @if ($invite->max_uses != null)
                                <td>{{ $invite->uses_left }} / {{ $invite->max_uses }}</td>
                            @else
                                <td title="unlimited">@svg('css-infinity') / @svg('css-infinity')</td>
                            @endif
                            <td>
                                <form action="/admin/invites/{{ $invite->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </section>
@endsection
