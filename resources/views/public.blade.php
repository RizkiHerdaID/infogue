<!doctype html>
<html class="no-js" lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Info Gue @yield('title')</title>
    <meta name="description" content="{{ $site_settings['Description'] }}">
    <meta name="keywords" content="{{ $site_settings['Keywords'] }}">
    <meta name="author" content="{{ $site_settings['Owner'] }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Info Gue @yield('title')" />
    <meta property="og:description" content="{{ $site_settings['Description'] }}" />
    <meta property="og:image" content="/tile.png" />

    <link rel="apple-touch-icon" href="{{ asset('/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset($site_settings['Favicon']) }}">

    <link rel="stylesheet" href="{{ asset('/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/library/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body id="top">

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<header>
    <div class="header">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <i class="fa fa-navicon visible-xs toggle-nav"></i>
                    <h1><a href="{{ url('/') }}">InfoGue</a></h1>
                </div>
                <div class="header-section">
                    <section class="control-wrapper">
                        <ul class="featured-link hidden-xs">
                            <li><a href="{{ route('article.latest') }}">LATEST</a></li>
                            <li><a href="{{ route('article.headline') }}">HEADLINE</a></li>
                            <li><a href="{{ route('article.trending') }}">TRENDING</a></li>
                            <li><a href="{{ route('article.random') }}">RANDOM</a></li>
                        </ul>
                        <div class="user-control">
                            <ul class="hidden-xs">
                                @if(!Auth::check())
                                <li><a href="{{ route('login.form') }}"><span class="hidden-sm">Hello Guest! &nbsp; </span>LOGIN</a></li>
                                <li><a href="{{ route('register.form') }}">REGISTER</a></li>
                                @endif
                            </ul>

                            <div class="user-menu">
                                <a href="#" class="mobile-search"><i class="fa fa-search"></i></a>

                                @if(Auth::check())
                                <a href="#" class="user-dropdown" data-contributor-id="{{ Auth::user()->id }}"><i class="glyphicon glyphicon-user"></i><span class="hidden-xs">HI, <strong>{{ Auth::user()->name }}</strong></span></a>
                                <ul class="list-menu">
                                    <li class="menu-label">ACCOUNT</li>
                                    <li><a href="{{ route('account.stream') }}"><i class="glyphicon glyphicon-user"></i>Profile</a></li>
                                    <li><a href="{{ route('account.article.index') }}"><i class="glyphicon glyphicon-file"></i>Article</a></li>
                                    <li><a href="{{ route('account.message.list') }}"><i class="glyphicon glyphicon-envelope"></i>Message</a></li>
                                    <li><a href="{{ route('account.follower') }}"><i class="glyphicon glyphicon-arrow-right"></i>Followers</a></li>
                                    <li><a href="{{ route('account.following') }}"><i class="glyphicon glyphicon-arrow-left"></i>Following</a></li>
                                    <li class="menu-label">CONTROL</li>
                                    <li><a href="{{ route('account.setting') }}"><i class="glyphicon glyphicon-cog"></i>Setting</a></li>
                                    <li><a href="{{ route('login.destroy') }}"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
                                </ul>
                                @endif
                            </div>
                        </div>
                    </section>
                    <section class="search-wrapper">
                        <div class="search">
                            <form action="{{ route('search') }}" method="get">
                                <input type="hidden" value="all" name="filter">
                                <div class="input-search">
                                    <input class="form-control" id="search" type="search" name="query" value="@if(\Illuminate\Support\Facades\Input::get('query')){{ \Illuminate\Support\Facades\Input::get('query') }}@endif" placeholder="Type a keywords" required/>
                                    <i class="fa fa-search"></i>
                                </div>
                                <div class="btn-group filter dropdown select hidden-xs">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if(\Illuminate\Support\Facades\Input::has('filter') && \Illuminate\Support\Facades\Input::get('filter') != 'all')
                                            {{ ucwords(\Illuminate\Support\Facades\Input::get('filter')) }}
                                        @else
                                            {{ "All Data" }}
                                        @endif <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" data-filter="all">All Data</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#" data-filter="contributor">Contributor</a></li>
                                        <li><a href="#" data-filter="article">Article</a></li>
                                    </ul>
                                </div>
                                <button type="submit" class="btn btn-primary">SEARCH</button>
                                {!! csrf_field() !!}
                            </form>
                        </div>
                        <ul class="social hidden-xs">
                            <li><a href="{{ $site_settings['Facebook'] }}" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="{{ $site_settings['Twitter'] }}" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="{{ $site_settings['Google Plus'] }}" class="googleplus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </section>
                </div>
            </div>
            <nav class="navigation">
                <div class="overlay"></div>
                <div class="breadcrumb-wrapper visible-sm">
                    <ol class="breadcrumb">
                        <li><a href="#" class="navigation-toggle"><i class="fa fa-navicon"></i>NAVIGATION</a></li>
                        <li class="level-1 blank"></li>
                        <li class="level-2 blank"></li>
                        <li class="level-dummy blank invisible"></li>
                    </ol>
                </div>
                <div class="sidebar-profile visible-xs">
                    <a href="contributor_stream.html" class="hidden">
                        <img src="{{ asset('images/contributors/avatar_1.jpg') }}"/>
                        <div class="info">
                            <p class="name">Angga Ari Wijaya</p>
                            <p class="location">Jakarta, Indonesia</p>
                        </div>
                    </a>
                    <div class="unauthorized">
                        <a href="register.html" class="btn btn-outline btn-light">CREATE ARTICLE</a>
                        <div class="link-text" style="display: none">
                            <a href="login.html" class="link-login">Welcome, Sign In</a>
                            <a href="register.html" class="link-register">Don't have an account? Register</a>
                        </div>
                    </div>
                </div>
                <ul class="sf-menu" id="navigation" role="menu">
                    <li><a href="{{ url('/') }}">Home</a></li>

                    @foreach($site_menus as $category)

                        <li>
                            <a href="{{ route('article.category', [str_slug($category->category)]) }}">{{ $category->category }}</a>

                            @if(!$category->subcategories->isEmpty())

                                <div class="sf-mega">

                                <?php $counter = 1; $section = 0; $last_label = ""; $is_first = true; ?>

                                @foreach($category->subcategories as $subcategory)

                                    @if($last_label != $subcategory->label || $section == 5)

                                        <?php $last_label = $subcategory->label; $section = 0; ?>

                                        @if($is_first)
                                            <?php $is_first = false; ?>
                                        @else

                                        {!! "</ul> </div>"  !!}

                                        @endif

                                        <div class="sf-mega-section">
                                            <h2>{{ $subcategory->label }}</h2>
                                            <ul>

                                    @endif

                                            <li>
                                                <a href="{{ route('article.subcategory', [str_slug($category->category), str_slug($subcategory->subcategory)]) }}">
                                                    {{ $subcategory->subcategory }}
                                                </a>
                                            </li>

                                    @if($counter == $subcategory->count())

                                            </ul>
                                        </div>

                                    @endif

                                    <?php $counter++; $section++ ?>

                                @endforeach

                                </div>

                            @endif

                        </li>

                    @endforeach

                </ul>
            </nav>
        </div>
    </div>
</header>

@yield('content')

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 hidden-sm">
                <div class="about">
                    <ul class="social pull-right visible-xs">
                        <li><a href="{{ $site_settings['Facebook'] }}" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="{{ $site_settings['Twitter'] }}" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="{{ $site_settings['Google Plus'] }}" class="googleplus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                    <img src="{{ asset('images/misc/logo.png') }}" alt="Logo InfoGue" class="img-responsive logo"/>
                    <p class="hidden-xs">The most update web portal news. We always provide latest article and information with high
                        integrity and truth. Knowledge is beyond among us to share with you.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 hidden-xs clearfix">
                <h3>QUICK LINKS</h3>
                <?php $counter = 0; $is_first = true; ?>
                @foreach($site_menus as $category)
                    @if($counter <= 12)
                        @if($counter > 0 && $counter % 6 == 0)
                            {!! "</ul>" !!}
                        @endif
                        @if($counter == 0 || $counter % 6 == 0)
                            {!! '<ul class="quick-links">' !!}
                        @endif
                        @if($is_first)
                            <li><a href="{{ url('featured/headline') }}">HEADLINE</a></li>
                            <li><a href="{{ url('featured/trending') }}">TRENDING</a></li>
                            <?php $is_first = false; $counter+=2; ?>
                        @endif
                        <li><a href="{{ url('category/'.$category->category) }}">{{ $category->category }}</a></li>
                    @endif
                    <?php $counter++ ?>
                @endforeach
            </div>
            <div class="col-md-4 col-sm-6 hidden-xs">
                <div class="row">
                    <div class="col-md-12">
                        <h3>SUBSCRIBE</h3>
                        <p>Get our latest updates, we don't spam</p>

                        <form action="#" method="post">
                            <div class="subscribe-email">
                                <input type="email" class="form-control" placeholder="Email address"/>
                                <button type="submit"><i class="fa fa-envelope-o"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <h3>CONTACT</h3>
                        <div class="contact">
                            <p>{{ $site_settings['Address'] }}</p>
                            <p><a href="tel:{{ $site_settings['Contact'] }}">{{ $site_settings['Contact'] }}</a></p><br/>
                            <p><a href="mailto:{{ $site_settings['Email'] }}">{{ $site_settings['Email'] }}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bottom">
            <div class="col-sm-8">
                <ul class="featured-link hidden-xs">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ url('editorial') }}">Editorial</a></li>
                    <li><a href="{{ url('privacy') }}">Privacy</a></li>
                    <li><a href="{{ url('disclaimer') }}">Disclaimer</a></li>
                    <li><a href="{{ url('faq') }}">FAQ</a></li>
                    <li><a href="{{ url('contact') }}">Contact</a></li>
                </ul>
                <div class="copyright">&copy; <span class="hidden-xs">Copyright</span> 2016 infogue.com All Rights Reserved.</div>
            </div>
            <div class="col-sm-4">
                <ul class="social hidden-xs">
                    <li><a href="{{ $site_settings['Facebook'] }}" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="{{ $site_settings['Twitter'] }}" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="{{ $site_settings['Google Plus'] }}" class="googleplus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<div class="modal fade no-line" id="modal-info" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">TITLE</h4>
            </div>
            <div class="modal-body">
                <label class="mbn modal-message">MESSAGE</label>
                <p class="mbn"><small class="text-muted modal-submessage">SUB MESSAGE</small></p>
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn btn-primary">OK</a>
            </div>
        </div>
    </div>
</div>

<div class="to-top">
    <a href="#top"><i class="fa fa-arrow-up"></i></a>
</div>

<script src="{{ asset('/library/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/library/echojs/dist/echo.min.js') }}"></script>
<script src="{{ asset('/library/equalize/js/equalize.min.js') }}"></script>
<script src="{{ asset('/library/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/library/jquery.cycle2/index.js') }}"></script>
<script src="{{ asset('/library/jquery.fitvids/jquery.fitvids.js') }}"></script>
<script src="{{ asset('/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('/library/jquery.stellar/jquery.stellar.min.js') }}"></script>
<script src="{{ asset('/library/superfish/dist/js/superfish.min.js') }}"></script>
<script src="{{ asset('/library/superfish/dist/js/hoverIntent.js') }}"></script>
<script src="{{ asset('/library/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('/library/mustache/mustache.min.js') }}" type="text/javascript"></script>
<script id="dsq-count-scr" src="//info-gue.disqus.com/count.js" async></script>

<script src="{{ asset('/js/script.js') }}"></script>

<script>
    /*
    if($('.newsletter').length){
        setTimeout(function(){
            $('.newsletter').modal('show');
        }, 3000);
    }
     */

    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-74498739-1','auto');ga('send','pageview');


    window.fbAsyncInit = function() {
        FB.init({
            appId      : '577855965712128',
            xfbml      : true,
            version    : 'v2.5'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>
