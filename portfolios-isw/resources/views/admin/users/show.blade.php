@extends('layouts.app')

@section('content')

    <section class="container-fluid mt-3">
        <section>
            <h3>Viewing a user</h3>
        </section>
        <section class="mt-4 mb-3">
            <div class="card">
                <div class="card-body"> <!-- max-width: 60%; on PC, leave default on mobile-->
                    <h3>{{ $user->fullname() }} <a href="/admin/roles/{{ $user->role->id }}" class="btn btn-default">Role: <span class="badge badge-primary">{{ $user->role->name }}</span></a></h3>
                    <p>{{ $user->email_address }}</p>
                    <hr/>
                    <a href="/profile/{{ $user->username }}" target="_blank" class="btn btn-primary">Visit user's page</a>
                    <section class="mt-3">
                        @if($errors->any())
                            {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                        @endif
                    </section>
                    <table class="table table-striped table-dark mt-4">
                        <thead>
                            <tr>
                                <th>URL</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->pages as $page)
                                <tr>
                                    <td><a href='{{ $page->page_url }}' target='_blank'>{{ $page->page_url }}</a></td>
                                    <td>
                                        @if ($page->status)
                                            <span class="ot-dot ot-green-dot"></span> Enabled
                                        @else
                                            <span class="ot-dot ot-red-dot"></span> Disabled
                                        @endif
                                    </td>
                                    <td>
                                        <form action="/admin/users/{{ $user->id }}/page/change-status" method="post">
                                            @csrf

                                            @if ( $page->status == false )
                                                <input type="hidden" name="page_id" value="{{ $page->id }}">
                                                <input type="hidden" name="status" value="1">
                                                <button type="submit" class="btn btn-success">Enable</button>
                                            @else
                                                <input type="hidden" name="page_id" value="{{ $page->id }}">
                                                <input type="hidden" name="status" value="0">
                                                <button type="submit" class="btn btn-danger">Disable</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ url($user->linkPathAdmin()) }}/page/add" class="btn btn-primary">Add page</a>
                </div>
            </div>

        </section>
        <form action="{{ url($user->linkPathAdmin()) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete user</button>
        </form>
    </section>
@endsection
