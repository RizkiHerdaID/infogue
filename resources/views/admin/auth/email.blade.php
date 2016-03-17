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

    <title>Info Gue - Administrator Reset Request</title>

    <script src="{{ asset('library/modernizr/modernizr-custom.js') }}"></script>
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset($site_settings['Favicon']) }}">
    <link rel="stylesheet" href="{{ asset('/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/library/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
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
            <h3>FORGOT PASSWORD</h3>

            @include('errors.common')

            @if(Session::has('status'))
                <div class="alert alert-success" style="padding: 10px 5px; border-radius: 0">
                    {{ Session::get('status') }}
                </div>
            @endif

            <form action="{{ route('admin.forgot.email') }}" method="post" id="form-email">
                {!! csrf_field() !!}
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email address" required/>
                </div>
                <button class="btn btn-gradient btn-block">RESET MY PASSWORD</button>
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