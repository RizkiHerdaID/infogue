<!doctype html>
<html class="no-js" lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="{{ $site_settings['Description'] }}">
    <meta name="keywords" content="{{ $site_settings['Keywords'] }}">
    <meta name="author" content="{{ $site_settings['Owner'] }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ route('index') }}">
    <meta name="theme-color" content="#4dc4d2">

    <meta property="og:url" content="{{ Request::url() }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Info Gue @yield('title')"/>
    <meta property="og:description" content="@if(isset($article)){{ strip_tags(str_limit($article->content, 160)) }}@else{{ $site_settings['Description'] }}@endif"/>
    <meta property="og:image" content="@if(isset($article)){{ asset('images/featured/'.$article->featured) }}@else{{ asset('tile.png') }}@endif"/>

    <title>Info Gue @yield('title')</title>

    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset($site_settings['Favicon']) }}">

    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput-typeahead.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body id="top">

    <!--[if lt IE 8]>
    <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser.
        Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.
    </p>
    <![endif]-->

    <header>
        <!-- header content -->
        <div class="header">
            <div class="container">
                <!-- header wrapper -->
                <div class="header-wrapper">
                    <div class="logo">
                        <i class="fa fa-navicon visible-xs toggle-nav"></i>
                        <h1><a href="{{ route('index') }}">InfoGue</a></h1>
                    </div>
                    <!-- header section -->
                    <div class="header-section">
                        <!-- top section -->
                        <section class="control-wrapper">
                            <ul class="featured-link hidden-xs">
                                <li><a href="{{ route('article.latest') }}">LATEST</a></li>
                                <li><a href="{{ route('article.headline') }}">HEADLINE</a></li>
                                <li><a href="{{ route('article.trending') }}">TRENDING</a></li>
                                <li><a href="{{ route('article.random') }}">RANDOM</a></li>
                            </ul>
                            <div class="user-control">
                                @if(!Auth::check())
                                    <ul class="hidden-xs">
                                        <li>
                                            <a href="{{ route('login.form') }}">
                                                <span class="hidden-sm">Hello Guest!, &nbsp; </span>LOGIN
                                            </a>
                                        </li>
                                        <li><a href="{{ route('register.form') }}">REGISTER</a></li>
                                    </ul>
                                @endif

                                <div class="user-menu">
                                    <a href="#" class="mobile-search"><i class="fa fa-search"></i></a>

                                    @if(Auth::check())
                                        <a href="#" class="user-dropdown" data-contributor-id="{{ Auth::user()->id }}">
                                            <i class="glyphicon glyphicon-user"></i>
                                            <span class="hidden-xs">HI, <strong>{{ Auth::user()->name }}</strong></span>
                                        </a>

                                        <!-- begin of user's dropdown menu -->
                                        <ul class="list-menu">
                                            <li class="menu-label">ACCOUNT</li>
                                            <li>
                                                <a href="{{ route('account.stream') }}">
                                                    <i class="glyphicon glyphicon-user"></i>Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('account.article.index') }}">
                                                    <i class="glyphicon glyphicon-file"></i>Article
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('account.message.list') }}">
                                                    <i class="glyphicon glyphicon-envelope"></i>Message
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('account.follower') }}">
                                                    <i class="glyphicon glyphicon-arrow-right"></i>Followers
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('account.following') }}">
                                                    <i class="glyphicon glyphicon-arrow-left"></i>Following
                                                </a>
                                            </li>
                                            <li class="menu-label">CONTROL</li>
                                            <li>
                                                <a href="{{ route('account.setting') }}">
                                                    <i class="glyphicon glyphicon-cog"></i>Setting
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('login.destroy') }}">
                                                    <i class="glyphicon glyphicon-log-out"></i>Logout
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- end of user's dropdown menu -->
                                    @endif
                                </div>
                            </div>
                        </section>
                        <!-- end of top section -->

                        <!-- search wrapper -->
                        <section class="search-wrapper">
                            <!-- search box -->
                            <div class="search">
                                <form action="{{ route('search') }}" method="get">
                                    <input type="hidden" value="all" name="filter">

                                    <div class="input-search">
                                        <input class="form-control" id="search" type="search" name="query"
                                               value="@if(Input::get('query')){{ Input::get('query') }}@endif"
                                               placeholder="Type a keywords" required/>
                                        <i class="fa fa-search"></i>
                                    </div>
                                    <div class="btn-group filter dropdown select hidden-xs">
                                        <button type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            @if(Input::has('filter') && Input::get('filter') != 'all')
                                                {{ ucwords(Input::get('filter')) }}
                                            @else
                                                {{ "All Data" }}
                                            @endif
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="list">
                                            <li><a href="#" data-filter="all">All Data</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#" data-filter="contributor">Contributor</a></li>
                                            <li><a href="#" data-filter="article">Article</a></li>
                                        </ul>
                                    </div>
                                    <button type="submit" class="btn btn-primary">SEARCH</button>
                                </form>
                            </div>
                            <!-- end of search box -->

                            <!-- header social -->
                            <ul class="social hidden-xs">
                                <li>
                                    <a href="{{ $site_settings['Facebook'] }}" class="facebook" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $site_settings['Twitter'] }}" class="twitter" target="_blank">
                                        <i class="fa fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ $site_settings['Google Plus'] }}" class="googleplus" target="_blank">
                                        <i class="fa fa-google-plus"></i>
                                    </a>
                                </li>
                            </ul>
                            <!-- end of header social -->
                        </section>
                        <!-- end of search wrapper -->
                    </div>
                    <!-- end of header section -->
                </div>
                <!-- end of header wrapper -->

                <!-- main navigation -->
                <nav class="navigation">
                    <div class="overlay"></div>

                    <!-- navigation breadcrumb on tablet -->
                    <div class="breadcrumb-wrapper visible-sm">
                        <ol class="breadcrumb">
                            <li><a href="#" class="navigation-toggle"><i class="fa fa-navicon"></i>NAVIGATION</a></li>
                            <li class="level-1 blank"></li>
                            <li class="level-2 blank"></li>
                            <li class="level-dummy blank invisible"></li>
                        </ol>
                    </div>
                    <!-- end of navigation breadcrumb on tablet -->

                    <div class="sidebar-profile visible-xs">
                        @if(Auth::check())
                            <a href="{{ route('contributor.stream', [Auth::user()->username]) }}">
                                <img src="{{ asset('images/contributors/'.Auth::user()->avatar) }}"/>
                                <div class="info">
                                    <p class="name">{{ Auth::user()->name }}</p>
                                    <p class="location">{{ Auth::user()->location }}</p>
                                </div>
                            </a>
                        @else
                            <div class="unauthorized">
                                <a href="{{ route('login.form') }}" class="btn btn-outline btn-light">CREATE ARTICLE</a>
                                <div class="link-text" style="display: none">
                                    <a href="{{ route('login.form') }}" class="link-login">Welcome, Sign In</a>
                                    <a href="{{ route('register.form') }}" class="link-register">Don't have account? Register here</a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <ul class="sf-menu" id="navigation" role="menu">
                        <li><a href="{{ route('index') }}">Home</a></li>

                        @foreach($site_menus as $category)
                            <!-- {{ $category->category }} -->
                            <li>
                                <a href="{{ route('article.category', [str_slug($category->category)]) }}" class="menu-category">
                                    {{ $category->category }}
                                </a>

                                @if(!$category->subcategories->isEmpty())
                                    <div class="sf-mega">

                                        <?php $counter = 1; $section = 0; $lastLabel = ""; $isFirst = true; ?>

                                        @foreach($category->subcategories as $subcategory)

                                            @if($lastLabel != $subcategory->label || $section == 5)

                                                <?php $lastLabel = $subcategory->label; $section = 0; ?>

                                                @if($isFirst)
                                                    <?php $isFirst = false; ?>
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
                            <!-- end of {{ $category->category }} -->
                        @endforeach
                    </ul>
                </nav>
                <!-- end of main navigation -->
            </div>
        </div>
        <!-- end of header content -->
    </header>

    @yield('content')

    <footer>
        <div class="container">
            <!-- top footer -->
            <div class="row">
                <!-- about -->
                <div class="col-md-4 col-sm-6 hidden-sm">
                    <div class="about">
                        <ul class="social pull-right visible-xs">
                            <li>
                                <a href="{{ $site_settings['Facebook'] }}" class="facebook" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $site_settings['Twitter'] }}" class="twitter" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $site_settings['Google Plus'] }}" class="googleplus" target="_blank">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                        </ul>
                        <img src="{{ asset('images/misc/logo.png') }}" alt="Logo InfoGue" class="img-responsive logo"/>
                        <p class="hidden-xs">{{ $site_settings['Description'] }}</p>
                    </div>
                </div>
                <!-- end of about -->

                <!-- quick links -->
                <div class="col-md-4 col-sm-6 hidden-xs clearfix">
                    <h3>QUICK LINKS</h3>
                    <?php $counter = 0; $isFirst = true; ?>
                    @foreach($site_menus as $category)
                        @if($counter < 12)
                            @if($counter > 0 && $counter % 6 == 0)
                                {!! "</ul>" !!}
                            @endif
                            @if($counter == 0 || $counter % 6 == 0)
                                {!! '<ul class="quick-links">' !!}
                            @endif
                            @if($isFirst)
                                <li><a href="{{ route('article.headline') }}">HEADLINE</a></li>
                                <li><a href="{{ route('article.trending') }}">TRENDING</a></li>
                                <?php $isFirst = false; $counter += 2; ?>
                            @endif
                            <li><a href="{{ route('article.category', [str_slug($category->category)]) }}">{{ $category->category }}</a></li>
                        @endif
                        <?php $counter++ ?>
                    @endforeach
                </div>
                <!-- end of quick links -->

                <!-- subscribe -->
                <div class="col-md-4 col-sm-6 hidden-xs">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>SUBSCRIBE</h3>
                            <p>Get our latest updates, we don't spam</p>
                            <form action="{{ route('subscribe.register') }}" method="post" id="form-subscribe">
                                {!! csrf_field() !!}
                                <div class="form-group subscribe-email">
                                    <input type="email" name="email" class="form-control" placeholder="Email address" required/>
                                    <button type="submit"><i class="fa fa-envelope-o"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <h3>CONTACT</h3>
                            <div class="contact">
                                <p>{{ $site_settings['Address'] }}</p>
                                <p><a href="tel:{{ $site_settings['Contact'] }}">{{ $site_settings['Contact'] }}</a></p> <br/>
                                <p><a href="mailto:{{ $site_settings['Email'] }}">{{ $site_settings['Email'] }}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of subscribe -->
            </div>
            <!-- end of top footer -->

            <!-- bottom footer -->
            <div class="row bottom">
                <div class="col-sm-8">
                    <ul class="featured-link hidden-xs">
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li><a href="{{ route('page.editorial') }}">Editorial</a></li>
                        <li><a href="{{ route('page.privacy') }}">Privacy</a></li>
                        <li><a href="{{ route('page.disclaimer') }}">Disclaimer</a></li>
                        <li><a href="{{ route('page.faq') }}">FAQ</a></li>
                        <li><a href="{{ route('page.contact') }}">Contact</a></li>
                    </ul>
                    <div class="copyright">
                        &copy; <span class="hidden-xs"> Copyright</span> 2016 infogue.com All Rights Reserved.
                    </div>
                </div>
                <div class="col-sm-4">
                    <ul class="social hidden-xs">
                        <li>
                            <a href="{{ $site_settings['Facebook'] }}" class="facebook" target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $site_settings['Twitter'] }}" class="twitter" target="_blank">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $site_settings['Google Plus'] }}" class="googleplus" target="_blank">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end of bottom footer -->
        </div>
    </footer>

    <div class="modal fade no-line" id="modal-info" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
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

    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('library/echojs/dist/echo.min.js') }}"></script>
    <script src="{{ asset('library/equalize/js/equalize.min.js') }}"></script>
    <script src="{{ asset('library/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('library/jquery.fitvids/jquery.fitvids.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/jquery.stellar/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('library/jquery.timeago/jquery.timeago.js') }}"></script>
    <script src="{{ asset('library/superfish/dist/js/superfish.min.js') }}"></script>
    <script src="{{ asset('library/superfish/dist/js/hoverIntent.js') }}"></script>
    <script src="{{ asset('library/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('library/mustache/mustache.min.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="//info-gue.disqus.com/count.js" id="dsq-count-scr" async></script>

    <script>
        (function (b, o, i, l, e, r) {
            b.GoogleAnalyticsObject = l;
            b[l] || (b[l] = function () { (b[l].q = b[l].q || []).push(arguments) });
            b[l].l = +new Date;
            e = o.createElement(i);
            r = o.getElementsByTagName(i)[0];
            e.src = 'https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e, r)
        }(window, document, 'script', 'ga'));
        ga('create', 'UA-74498739-1', 'auto');
        ga('send', 'pageview');

        window.fbAsyncInit = function () {
            FB.init({
                appId: '577855965712128',
                xfbml: true,
                version: 'v2.5'
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
</body>
</html>