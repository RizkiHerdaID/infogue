@extends('public')

@section('title', '- Register')

@section('content')

    <div class="register" data-stellar-background-ratio=".3" data-stellar-vertical-offset="160">
        <section class="container">
            <div class="row">
                <div class="col-md-7 col-md-push-1 col-sm-7 hidden-xs">
                    <h1 class="caption">JOIN WITH US</h1>
                    <p class="lead mbs">Spread the world with limitless information</p>
                    <p>Be a InfoGue Contributor, <a href="{{ url('faq') }}">Learn More</a></p>
                    <p class="mbm mtl">Have an account?, <a href="{{ route('login.form') }}">Sign In here!</a> or connect with</p>
                    <div>
                        <a class="btn btn-facebook mrs" href="http://www.facebook.com">
                            <i class="fa fa-facebook"></i> FACEBOOK
                        </a>
                        <a class="btn btn-twitter" href="http://www.twitter.com">
                            <i class="fa fa-twitter"></i> TWITTER
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-5">
                    <h2 class="form-title">Create an Account</h2>
                    <p class="form-subtitle">Registering yourself as Contributor</p>

                    <div class="mbm visible-xs">
                        <a class="btn btn-facebook mrs" href="http://www.facebook.com">
                            <i class="fa fa-facebook"></i> FACEBOOK
                        </a>
                        <a class="btn btn-twitter" href="http://www.twitter.com">
                            <i class="fa fa-twitter"></i> TWITTER
                        </a>
                    </div>

                    <form action="{{ route('register.attempt') }}" method="post">
                        {!! csrf_field() !!}

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address">
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Username">
                            {!! $errors->first('username', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Retype Password">
                            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="agree" name="agree" class="css-checkbox">
                            <label for="agree" class="css-label">I agree with all <a href="{{ url('terms') }}">terms</a> and <a href="{{ url('disclaimer') }}">conditions</a></label>
                        </div>
                        <div class="form-group {{ $errors->has('agree') ? 'has-error' : '' }}">
                            {!! $errors->first('agree', '<span class="help-block">:message</span>') !!}
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">REGISTER</button>
                    </form>
                    <p class="mtm visible-xs text-center">Have an account?, <a href="{{ route('login.form') }}">Sign In here!</a>
                </div>
            </div>
        </section>
    </div>

@endsection