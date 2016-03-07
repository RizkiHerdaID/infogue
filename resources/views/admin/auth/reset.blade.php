<!DOCTYPE html>
<html class="no-js">
<head lang="en">
    <meta charset="UTF-8">
    <title>Info Gue - Administrator Reset Password</title>
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
        <h3>RESET PASSWORD</h3>

        @include('errors.common')

        <form action="{{ route('admin.reset.attempt') }}" method="post">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="anggadarkprince@gmail.com" readonly/>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" class="form-control" id="password" name="password" placeholder="New password"/>
            </div>
            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-type password"/>
            </div>
            <button class="btn btn-gradient btn-block">CHANGE PASSWORD</button>
            <p class="mtm">Remember your credential? <a href="{{ route('admin.login.form') }}">Sign here!</a></p>
        </form>
    </div>
    <div class="login-footer">
        <ul class="list-separated hidden-xs">
            <li><a href="/">Home</a></li>
            <li><a href="/editorial">Editorial</a></li>
            <li><a href="/privacy">Privacy</a></li>
            <li><a href="/disclaimer">Disclaimer</a></li>
            <li><a href="/terms">Term</a></li>
            <li><a href="/career">Career</a></li>
            <li><a href="/faq">FAQ</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>
        <div class="copyright">&copy; Copyright 2016 infogue.com All Rights Reserved.</div>
    </div>
</div>

<script>
    Modernizr.on('backgroundcliptext', function( result ) {
        if (result) {
            // alert('on');
        } else {
            // alert('off');
        }
    });
</script>

<script src="/library/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/library/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/library/bower_components/echojs/dist/echo.min.js"></script>
<script src="/library/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/library/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
<script src="/library/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>

<script src="/js/admin.js"></script>

</body>
</html>