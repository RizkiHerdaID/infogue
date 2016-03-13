@extends('public')

@section('title', '- Subscription')

@section('content')

    <div class="activate" data-stellar-background-ratio="0.7" data-stellar-vertical-offset="220">
        <section class="container">
            <div class="row">
                <div class="col-md-12">
                    <i class="fa fa-envelope-o"></i>
                    <p class="lead">Hi, {{ $email }}</p>
                    @if(isset($unsubscribe))
                        @if($unsubscribe)
                            <h1 class="mbm text-primary">You unsubscribe email from Infogue.id</h1>
                            <p class="lead subtitle">Now you're stop following our newsletter, please tell me why via <a href="{{ route('page.contact') }}">contact</a> form</p>
                        @else
                            <h1 class="mbm text-primary">Ups!, something is getting wrong</h1>
                        @endif
                    @else
                        <h1 class="mbm text-primary">Your email address is subscribed</h1>
                        <p class="lead subtitle">Thanks for subscribe our newsletter, more advance please <a href="{{ route('register.form') }}">Register</a> to contribute article</p>
                        <p class="text-muted">has been registered before <a href="{{ route('login.form') }}">Login</a> to dashboard.</p>
                    @endif
                </div>
            </div>
        </section>
    </div>

@endsection