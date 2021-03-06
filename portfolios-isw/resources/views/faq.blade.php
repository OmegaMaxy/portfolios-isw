@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <section class="mt-4">
                <h1>FAQ</h1>
                <h4>If your issue cannot be resolved, please contact your administrator.</h4>
                <hr>
                <section class="mt-2">
                    <div class="mb-3">
                        <h1>I'm using my github page, why aren't my images loading?</h1>
                        <p>If the images don't load from github try replacing <b>/blob</b> to <b>/raw</b> like <a href="https://github.com/OmegaMaxy/OmegaMaxy/raw/main/img/wave.gif" target="_blank">https://github.com/OmegaMaxy/OmegaMaxy/raw/main/img/wave.gif</a></p>
                    </div>
                    <div class="mb-3">
                        <h1>How does Markdown work?</h1>
                        <p>You can visit a Markdown cheatsheet <a href="https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet" target="_blank">here</a>.</p>
                    </div>
                </section>
            </section>
        </div>
    </div>
</div>
@endsection
