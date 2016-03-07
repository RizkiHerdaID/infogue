<!DOCTYPE html>
<html class="no-js">
<head lang="en">
    <meta charset="UTF-8">
    <title>Info Gue - Administrator Login</title>
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="description" content="{{ $site_settings['Description'] }}">
    <meta name="keywords" content="{{ $site_settings['Keywords'] }}">
    <meta name="author" content="{{ $site_settings['Owner'] }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="url" content="{{ route('index') }}" />

    <link rel="apple-touch-icon" href="{{ asset('/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset($site_settings['Favicon']) }}">

    <script src="{{ asset('/library/modernizr/modernizr-custom.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/library/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
</head>
<body>

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div class="login text-center">
    <div class="login-wrapper">
        <img src="{{ asset('images/misc/logo-color.png') }}"/>
        <h3>ADMINISTRATOR</h3>

        @include('errors.common')

        <form action="{{ route('admin.login.attempt') }}" method="post">
            {!! csrf_field() !!}
            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Username or Email"/>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
            </div>
            <div class="form-group clearfix">
                <div class="checkbox pull-left mtn">
                    <input type="checkbox" id="remember" name="remember" class="css-checkbox" @if(old('remember', 0)) checked @endif>
                    <label for="remember" class="css-label">Remember Me</label>
                </div>
                <a href="{{ route('admin.forgot.form') }}" class="forgot-link clearfix pull-right">Forgot Password?</a>
            </div>
            <button class="btn btn-gradient btn-block">SIGN IN</button>
        </form>
    </div>
    <div class="login-footer">
        <ul class="list-separated hidden-xs">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li><a href="{{ url('editorial') }}">Editorial</a></li>
            <li><a href="{{ url('privacy') }}">Privacy</a></li>
            <li><a href="{{ url('disclaimer') }}">Disclaimer</a></li>
            <li><a href="{{ url('terms') }}">Term</a></li>
            <li><a href="{{ url('career') }}">Career</a></li>
            <li><a href="{{ url('faq') }}">FAQ</a></li>
            <li><a href="{{ url('contact') }}">Contact</a></li>
        </ul>
        <div class="copyright">&copy; Copyright {{ date('Y') }} infogue.com All Rights Reserved.</div>
    </div>
</div>

<script src="{{ asset('/library/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/library/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('/library/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('/js/admin.js') }}"></script>

</body>
</html>