@extends('public')

@section('title', '- Account Activation')

@section('content')

    <div class="activate" data-stellar-background-ratio="0.7" data-stellar-vertical-offset="220">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <i class="fa fa-check-square-o"></i>
                    <p class="lead">Hi, {{ $contributor->username }}</p>
                    <h1 class="mbm text-primary">Your Account is Activated</h1>
                    <p class="lead subtitle">Thanks for registering to InfoGue.id, please <a href="{{ route('login.form') }}">Login</a> to write awesome article</p>
                    <p class="text-muted">does the activation fail? Try to <a href="{{ route('register.resend', [$contributor->token]) }}">Resend</a> the confirmation email or <a href="{{ route('register.form') }}">Create</a> the new one</p>
                </div>
            </div>
        </section>
    </div>

@endsection