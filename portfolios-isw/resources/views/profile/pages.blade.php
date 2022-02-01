@extends('layouts.app')

@section('content')
    <section class="container-fluid mt-3">
        <section>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h3>Profile <a href="/profile/{{ auth()->user()->username }}" class="btn btn-success">View portfolio</a></h3>

                    @if($errors->any())
                        {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                    @endif

                    @if(!empty($warnings))
                        @foreach ($warnings as $warning)
                            <div class="alert alert-warning" role="alert">{{ $warning }}</div>
                        @endforeach
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>URL</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pages as $page)
                                <tr>
                                    <td><a href="{{ $page->page_url }}" target="_blank">{{ $page->page_url }}</a></td>
                                    <td>
                                        <form action="/profile/pages/change-status" method="post">
                                            @csrf
                                            @if ($page->status == true)
                                                <span class="badge badge-success">Active</span>
                                                <input type="hidden" name="page_id" value="{{ $page->id }}">
                                                <input type="hidden" name="status" value="0">
                                                <button type="submit" style="color: #39f;border: none;">Disable</button>
                                            @else
                                                <span class="badge badge-danger">Hidden</span>
                                                <input type="hidden" name="page_id" value="{{ $page->id }}">
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit" style="color: #39f;border: none;">Enable</button>
                                            @endif
                                        </form>
                                    </td>
                                    <td>{{ $page->updated_at }}</td>
                                    <td>
                                        <form action="/profile/pages/{{ $page->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form method="POST" action="{{ url('/profile/pages') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="page_url" class="col-md-4 col-form-label text-md-right">{{ __('URL') }}</label>

                            <div class="col-md-6">
                                <input id="url" type="text" class="form-control @error('page_url') is-invalid @enderror" name="page_url" value="{{ old('page_url') }}" placeholder="Like: https://raw.githubusercontent.com/YourUsername/YourUsername/main/README.md">
                                @error('page_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox" name="status" value="{{ old('status') }}" id="status">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Status
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
                                    {{ __('Add page') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
@endsection
