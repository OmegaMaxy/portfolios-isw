@extends('layouts.app')

@section('content')
    <section class="container-fluid mt-3">
        <section>
            <h3>This person has not enabled their page yet! [firstTimeNotEnabled]</h3>
        </section>
        <section class="mt-4 mb-3">
            <div class="card">
                <div class="card-body"> <!-- max-width: 60%; on PC, leave default on mobile-->
                    <!-- markdown here? -->
                    <p>If this is your page, log in and create a page at the given panel.</p>
                </div>
            </div>
        </section>
    </section>
@endsection

