@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <section>
                        <h1>Welcome to Portfolios!</h1>
                        <p>Description here..</p>
                    </section>
                    <section>
                        <a href="/admin/users/">Users</a>
                        <a href="/admin/roles/">Roles</a>
                        <a href="/admin/invites/">Invites</a>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
