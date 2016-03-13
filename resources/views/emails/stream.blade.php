<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=no;">
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,800,600,700">
</head>
<body style="font-family: 'Open Sans', sans-serif; color: #555; margin: 0; padding: 20px; background: #f5f5f5;">

<div style="display: block; max-width: 550px; padding: 25px; background: #ffffff; margin: auto; border-top: 3px solid #4dc4d2">
    <div style="margin-bottom: 30px; display: block">
        <img src="http://infogue.angga-ari.com/builds/production/images/misc/logo-color.png" alt="Infogue Logo">
    </div>

    <div style="display: block">
        <h2>Hi, {{ $receiverName }}</h2>
        <p style="font-size: 16px; margin-bottom: 0">You have new article feed from {{ $contributorName }}</p>
        <p style="margin-top: 0; margin-bottom: 20px">a little information about your new stream</p>
        <div style="display: block; margin-bottom: 30px">
            <div class="info">
                <h3 style="margin-bottom: 0"><a href="{{ route('contributor.stream', [$contributorUsername]) }}" style="color: #4dc4d2; text-decoration: none">{{ $contributorName }}</a></h3>
                <p style="margin-top: 0; margin-bottom: 5px">{{ $contributorLocation }}</p>
                <ul style="list-style: none; margin-bottom: 20px; padding: 0">
                    <li style="display: inline-block; margin-left: 0"><a href="{{ route('contributor.article', [$contributorUsername]) }}" style="color: #4dc4d2; text-decoration: none">{{ $contributorArticle }} Articles</a> &nbsp;&nbsp; |</li>
                    <li style="display: inline-block;"><a href="{{ route('contributor.follower', [$contributorUsername]) }}" style="color: #4dc4d2; text-decoration: none">{{ $contributorFollower }} Followers</a> &nbsp;&nbsp; |</li>
                    <li style="display: inline-block;"><a href="{{ route('contributor.following', [$contributorUsername]) }}" style="color: #4dc4d2; text-decoration: none">{{ $contributorFollowing }} Following</a></li>
                </ul>
            </div>
            <div style="clear: both"></div>
        </div>
        <div style="margin-bottom: 20px">
            <img src="{{ asset('images/featured/'.$article->featured) }}" width="80" style="float: left">
            <div class="info" style="padding-left: 100px">
                <h3 style="margin-bottom: 0"><a href="{{ route('article.show', [$article->slug]) }}" style="color: #4dc4d2; text-decoration: none">{{ $article->title }}</a></h3>
                <p style="margin-top: 0; margin-bottom: 5px">{{ $article->subcategory->category->category }}  |  {{ $article->subcategory->subcategory }}</p>
                <p>{{ str_limit(strip_tags($article->content), 160) }}</p>
            </div>
        </div>
        <div style="margin-bottom: 10px; margin-top: 20px; padding: 8px 15px; background: #f5f5f5;">
            <p style="float: left">Checkout your stream</p>
            <a href="{{ route('account.stream') }}" style="float: right; padding: 10px 15px; font-size: 14px; background: #4dc4d2; text-decoration: none; color: #ffffff; margin: 2px; display: inline-block; vertical-align: middle; font-weight: 600;">SEE MY STREAM</a>
            <div style="clear: both"></div>
        </div>
        <div style="text-align: center; font-size: 12px; color: #aaa">
            <hr style="margin-top: 10px; margin-bottom: 20px; border: 0; border-top: 1px solid #ededed;">

            <ul style="list-style: none; margin-bottom: 20px; font-size: 20px; padding: 0">
                <li style="display: inline-block; margin-left: 0;">
                    <a href="{{ $site_settings['Facebook'] }}" style="color: #3b5998; text-decoration: none">
                        <img src="http://jagamana.com/assets/img/layout/social-facebook.png" width="30" height="30" alt="Facebook" title="Facebook">
                    </a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ $site_settings['Twitter'] }}" style="color: #00aced; text-decoration: none">
                        <img src="http://jagamana.com/assets/img/layout/social-twitter.png" width="30" height="30" alt="Facebook" title="Facebook">
                    </a>
                </li>
                <li style="display: inline-block;">
                    <a href="{{ $site_settings['Google Plus'] }}" style="color: #dd4b39; text-decoration: none">
                        <img src="http://jagamana.com/assets/img/layout/social-google.png" width="30" height="30" alt="Facebook" title="Facebook">
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
                Infogue Publisher. <a href="{{ route('account.setting') }}" style="color: #4dc4d2;">Unsubscribe</a>
                This email was intended for {{ $receiverName }}. <a href="{{ url('faq') }}" style="color: #4dc4d2;">Learn why we included this</a>.</p>

            <p style="margin: 0;">{{ $site_settings['Address'] }},
                contact: <a href="tel:{{ $site_settings['Contact'] }}" style="color: #4dc4d2;">{{ $site_settings['Contact'] }}</a>
                email: <a href="tel:{{ $site_settings['Email'] }}" style="color: #4dc4d2;">{{ $site_settings['Email'] }}</a>
                Infogue is a registered business name of Infogue Public Portal.
            </p>
            <p style="margin: 0">Registered in Indonesia as a private limited company.</p>
        </div>

    </div>
</div>
</body>
</html>