@extends('public')

@section('title', '- Account Activation')

@section('content')

    <div class="activate" data-stellar-background-ratio="0.7" data-stellar-vertical-offset="220">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <i class="fa fa-check-square-o"></i>
                    <p class="lead">Hi, Angga Ari Wijaya,</p>
                    <h1 class="mbm text-primary">Your Account is Activated</h1>
                    <p class="lead subtitle">Thanks for registering to InfoGue.id, please <a href="login.html">Login</a> to write awesome article</p>
                    <p class="text-muted">does the activation fail? Try to <a href="confirmation.html">Resend</a> the confirmation email or <a href="reset.html">Create</a> the new one</p>
                </div>
            </div>
            <div class="row hidden">
                <div class="col-md-12">
                    <i class="fa fa-remove"></i>
                    <p class="lead">We sorry, Angga Ari Wijaya,</p>
                    <h1 class="mbm text-primary">Something is getting wrong</h1>
                    <p class="lead subtitle">Please try again or <a href="confirmation.html">Resend</a> the confirmation email</p>
                    <p class="text-muted">If you are not sure about this, Try to <a href="register.html">Register</a> or <a href="login.html">Login</a></p>
                </div>
            </div>
        </section>
    </div>

@endsection