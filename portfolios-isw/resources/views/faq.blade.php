@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <section class="container" style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSUHNoKb6n8cRAjyputJ9vn4OPdujzLJr52OQ&usqp=CAU');background-repeat: no-repeat;background-size: cover;">
                <div class="jumbotron" style="background: none;">
                    <h1 class="display-4">Welcome to ISW Portfolios</h1>
                    <p class="lead">A simple website to view our member's portfolios.</p>
                    <hr class="my-4">
                    <p>If you're a member, be sure join below and add your portfolio!</p>
                    <p class="lead">
                        <a class="btn btn-primary btn-lg" href="/register" role="button">Join</a>
                    </p>
                </div>
            </section>
           <section>
               <div class="mb-3">
                    <h1>I'm using my github page, why aren't my images loading?</h1>
                    <p>If the images don't load from github try replacing /blob to /raw like https://github.com/OmegaMaxy/OmegaMaxy/raw/main/img/wave.gif</p>
               </div>
           </section>
        </div>
    </div>
</div>
@endsection
