@extends('layouts.app')

@section('content')

    <section class="container-fluid mt-3">
        <section>
            <h3>Viewing a user</h3>
        </section>
        <section class="mt-4 mb-3">
            <div class="card">
                <div class="card-body"> <!-- max-width: 60%; on PC, leave default on mobile-->
                    <h3>{{ $user->fullname() }} <div class="btn btn-default">Role: <span class="badge badge-primary">{{ $user->role->name }}</span></div></h3>
                    <p>{{ $user->email_address }}</p>
                    <hr/>
                    @if ( $user->activePage() != null )
                        <a href="{{ $user->activePage()->page_url }}" target="_blank" class="btn btn-primary">Visit user's page</a>
                    @else
                        <a href="#" class="btn btn-outline-danger">User has no active page</a>
                    @endif
                    <table class="table table-striped table-dark mt-4">
                        <thead>
                            <tr>
                                <th>URL</th>
                                <th>Status</th>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ url($user->linkPath()) }}/page/add" class="btn btn-primary">Add page</a>
                </div>
            </div>

        </section>
        <form action="{{ url($user->linkPath()) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete user</button>
        </form>
    </section>
@endsection
