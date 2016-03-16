<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,800,600,700">
</head>
<body style="font-family: 'Open Sans', sans-serif; color: #555; margin: 0; padding: 0;">

<div style="display: block; padding: 20px; border-top: 3px solid #4dc4d2">
    <div style="margin-bottom: 30px; text-align: center">
        <img src="{{ asset('images/misc/logo-color.png') }}" alt="Infogue Logo">
        <h2 style="margin-top: 0; color: #4dc4d2">RESET PASSWORD ACTION</h2>
    </div>


    <div style="text-align: center">
        <h2>Hi, {{ $name }}</h2>
        <p style="margin-bottom: 5px">We recently received a request to change the password,
            if you don't remember make this request or you think it's a mistake please contact our support to suspend your account temporarily by clicking link below.</p>
        <a href="{{ url('contact') }}" style="color: #00aced; text-decoration: none; font-size: 16px">PLEASE SUSPEND MY ACCOUNT</a>

        <p style="margin-bottom: 50px">
            You can safely ignore and delete this email if you take this action. Proceed with careful, in case hacking attempt or suspicious action.
        </p>

        <div style="text-align: center; font-size: 12px; color: #aaa">
            <hr style="margin-top: 10px; margin-bottom: 20px; border: 0; border-top: 1px solid #ededed;">

            <ul style="list-style: none; margin-bottom: 20px; font-size: 20px; padding: 0">
                <li style="display: inline-block; margin-left: 0;">
                    <a href="{{ $site_settings['Facebook'] }}" style="color: #3b5998; text-decoration: none">
                        <img src="{{ asset('images/misc/social-facebook.png') }}" width="30" height="30" alt="Facebook" title="Facebook">
                    </a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ $site_settings['Twitter'] }}" style="color: #00aced; text-decoration: none">
                        <img src="{{ asset('images/misc/social-twitter.png') }}" width="30" height="30" alt="Twitter" title="Twitter">
                    </a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ $site_settings['Google Plus'] }}" style="color: #dd4b39; text-decoration: none">
                        <img src="{{ asset('images/misc/social-google.png') }}" width="30" height="30" alt="Google Plus" title="Google Plus">
                    </a>
                </li>
            </ul>

            <ul style="list-style: none; margin-bottom: 20px; padding: 0">
                <li style="display: inline-block; margin-left: 0;"><a href="{{ url('/') }}" style="color: #4dc4d2; text-decoration: none">Home</a> &nbsp;&nbsp; |</li>
                <li style="display: inline-block;"><a href="{{ url('editorial') }}" style="color: #4dc4d2; text-decoration: none">Editorial</a> &nbsp;&nbsp; |</li>
                <li style="display: inline-block;"><a href="{{ url('privacy') }}" style="color: #4dc4d2; text-decoration: none">Privacy</a> &nbsp;&nbsp; |</li>
                <li style="display: inline-block;"><a href="{{ url('disclaimer') }}" style="color: #4dc4d2; text-decoration: none">Disclaimer</a> &nbsp;&nbsp; |</li>
                <li style="display: inline-block;"><a href="{{ url('faq') }}" style="color: #4dc4d2; text-decoration: none">FAQ</a> &nbsp;&nbsp; |</li>
                <li style="display: inline-block;"><a href="{{ url('contact') }}" style="color: #4dc4d2; text-decoration: none">Contact</a></li>
            </ul>
            <p>
                &copy; {{ date('Y') }} Infogue All rights reserved. Infogue, the Infogue logo, and this Newsletter are registered trademarks of
                Infogue Publisher in Java, Indonesia. You are receiving Endorsements emails.
                You receive this email because you intended for reset your password. <a href="{{ url('faq') }}" style="color: #4dc4d2;">Learn why we included this</a>.</p>

            <p style="margin: 0;">{{ $site_settings['Address'] }}
                contact: <a href="tel:{{ $site_settings['Contact'] }}" style="color: #4dc4d2;">{{ $site_settings['Contact'] }}</a>
                email: <a href="tel:{{ $site_settings['Email'] }}" style="color: #4dc4d2;">{{ $site_settings['Email'] }}</a>
                Infogue is a registered business name of Infogue Public Portal. Registered in Indonesia as a private limited company.
            </p>
        </div>

    </div>
</div>
</body>
</html>