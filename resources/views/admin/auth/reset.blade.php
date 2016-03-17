<!DOCTYPE html>
<html class="no-js">
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="{{ $site_settings['Description'] }}">
    <meta name="keywords" content="{{ $site_settings['Keywords'] }}">
    <meta name="author" content="{{ $site_settings['Owner'] }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ route('index') }}">

    <title>Info Gue - Administrator Reset Password</title>

    <script src="{{ asset('library/modernizr/modernizr-custom.js') }}"></script>
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset($site_settings['Favicon']) }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <!--[if lt IE 8]>
    <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser.
        Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
    </p>
    <![endif]-->

    <div class="login text-center">
        <div class="login-wrapper">
            <img src="{{ asset('images/misc/logo-color.png') }}"/>
            <h3>RESET PASSWORD</h3>

            @include('errors.common')

            <form action="{{ route('admin.reset.attempt') }}" method="post" id="form-reset">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="{{ $user->email }}" readonly required/>
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" class="form-control" id="password" name="password" placeholder="New password" required pattern=".{6,20}"/>
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Re-type password" required pattern=".{6,20}"/>
                    {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                </div>
                <button class="btn btn-gradient btn-block">CHANGE PASSWORD</button>
                <p class="mtm">Remember your credential? <a href="{{ route('admin.login.form') }}">Sign here!</a></p>
            </form>
        </div>
        <div class="login-footer">
            <ul class="list-separated hidden-xs">
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('page.editorial') }}">Editorial</a></li>
                <li><a href="{{ route('page.privacy') }}">Privacy</a></li>
                <li><a href="{{ route('page.disclaimer') }}">Disclaimer</a></li>
                <li><a href="{{ route('page.terms') }}">Term</a></li>
                <li><a href="{{ route('page.career') }}">Career</a></li>
                <li><a href="{{ route('page.faq') }}">FAQ</a></li>
                <li><a href="{{ route('page.contact') }}">Contact</a></li>
            </ul>
            <div class="copyright">
                &copy; Copyright {{ date('Y') }} <a href="{{ route('index') }}">{{ Request::root() }}</a> All Rights Reserved.
            </div>
        </div>
    </div>

    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/jquery.timeago/jquery.timeago.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>