@extends('public')

@section('title', '- Confirmation Request')

@section('content')

    <div class="confirmation" data-stellar-background-ratio="0.7" data-stellar-vertical-offset="220">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <i class="fa fa-envelope-o"></i>
                    <h1 class="mbm text-primary">{{ Session::get('status') }}</h1>
                    <p class="lead subtitle">Please check your email and click activation link to confirm your account</p>
                    <p class="text-muted">doesn't receive the email? Please <a href="{{ route('register.resend', [$token]) }}">Resend</a> or just <a href="{{ route('login.form') }}">Sign In</a></p>
                </div>
            </div>
        </section>
    </div>
    <?php Session::forget('status') ?>
@endsection