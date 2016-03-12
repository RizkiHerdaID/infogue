@extends('public')

@section('title', '- Login')

@section('content')

    <div class="login" data-stellar-background-ratio="0.3" data-stellar-vertical-offset="150">
        <section class="container">
            <div class="row">
                <div class="col-md-4 col-md-push-1 col-sm-5">
                    <h2 class="form-title">Sign In</h2>
                    <p class="form-subtitle">Login into Contributor profile</p>
                    <form action="{{ route('login.attempt') }}" method="post" id="form-login">
                        {!! csrf_field() !!}
                        <div class="mbm">
                            <div class="btn-group btn-group-justified" role="group">
                                <a class="btn btn-facebook" href="{{ url('auth/facebook') }}">
                                    <i class="fa fa-facebook"></i> FACEBOOK
                                </a>
                                <a class="btn btn-twitter" href="{{ url('auth/twitter') }}">
                                    <i class="fa fa-twitter"></i> TWITTER
                                </a>
                            </div>
                        </div>

                        @if(Session::has('status'))
                            <div class="form-group">
                                <div class="alert alert-danger">
                                    {{ Session::get('status') }}
                                </div>
                            </div>
                        @endif

                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Email Address or Username" required>
                            {!! $errors->first('username', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group clearfix">
                            <div class="checkbox pull-left mtn">
                                <input type="checkbox" id="remember" name="remember" class="css-checkbox" @if(old('remember', 0)) checked @endif>
                                <label for="remember" class="css-label">Remember Me</label>
                            </div>
                            <a href="{{ route('login.forgot') }}" class="forgot-link clearfix pull-right">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
                    </form>
                    <p class="mtm text-center visible-xs">Don't have an account?, <a href="{{ route('register.form') }}">Register here!</a></p>
                </div>
                <div class="col-md-6 col-md-push-2 col-sm-6 col-sm-push-1 hidden-xs">
                    <h1 class="caption">WELCOME BACK</h1>
                    <p class="lead mbs">Never stop writing, makes your brain sharp</p>
                    <p>Figure out about InfoGue features, <a href="{{ route('page.faq') }}">Learn More</a></p>
                    <p class="mbm mtl">Don't have an account?, <a href="{{ route('register.form') }}">Register here!</a></p>
                </div>
            </div>
        </section>
    </div>

@endsection