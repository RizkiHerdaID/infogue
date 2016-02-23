<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Info Gue @yield('title')</title>
    <meta name="description" content="Social news portal gives the most update information">
    <meta name="keywords" content="article, blog, news, portal, technology, health, science, economic, entertainment">
    <meta name="author" content="Angga Ari Wijaya">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Info Gue @yield('title')" />
    <meta property="og:description" content="Social news portal gives the most update information" />
    <meta property="og:image" content="/tile.png" />

    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="icon" href="favicon.ico">

    <link rel="stylesheet" href="/library/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/library/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">
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
                    <h1><a href="index.html">InfoGue</a></h1>
                </div>
                <div class="header-section">
                    <section class="control-wrapper">
                        <ul class="featured-link hidden-xs">
                            <li><a href="archive.html">HEADLINE</a></li>
                            <li><a href="archive.html">LATEST</a></li>
                            <li><a href="archive.html">TRENDING</a></li>
                            <li><a href="archive.html">RANDOM</a></li>
                        </ul>
                        <div class="user-control">
                            <ul class="hidden-xs">
                                <li><a href="login.html"><span class="hidden-sm">Hello Guest! &nbsp; </span>LOGIN</a></li>
                                <li><a href="register.html">REGISTER</a></li>
                            </ul>

                            <div class="user-menu">
                                <a href="#" class="mobile-search"><i class="fa fa-search"></i></a>
                                <a href="#" class="user-dropdown hidden"><i class="glyphicon glyphicon-user"></i><span class="hidden-xs">HI, <strong>ANGGA ARI WIJAYA</strong></span></a>
                                <ul class="list-menu">
                                    <li class="menu-label">ACCOUNT</li>
                                    <li><a href="contributor_stream.html"><i class="glyphicon glyphicon-user"></i>Profile</a></li>
                                    <li><a href="contributor_article.html"><i class="glyphicon glyphicon-file"></i>Article</a></li>
                                    <li><a href="contributor_message.html"><i class="glyphicon glyphicon-envelope"></i>Message</a></li>
                                    <li><a href="contributor_followers.html"><i class="glyphicon glyphicon-arrow-right"></i>Followers</a></li>
                                    <li><a href="contributor_following.html"><i class="glyphicon glyphicon-arrow-left"></i>Following</a></li>
                                    <li class="menu-label">CONTROL</li>
                                    <li><a href="contributor_setting.html"><i class="glyphicon glyphicon-cog"></i>Setting</a></li>
                                    <li><a href="login.html"><i class="glyphicon glyphicon-log-out"></i>Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </section>
                    <section class="search-wrapper">
                        <div class="search">
                            <form action="result.html">
                                <div class="input-search">
                                    <input class="form-control" id="search" type="search" name="search" placeholder="Type a keywords"/>
                                    <i class="fa fa-search"></i>
                                </div>
                                <div class="btn-group filter  hidden-xs">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        All Data <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">All Data</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="#">Contributor</a></li>
                                        <li><a href="#">Article</a></li>
                                    </ul>
                                </div>
                                <button type="submit" class="btn btn-primary">SEARCH</button>
                            </form>
                        </div>
                        <ul class="social hidden-xs">
                            <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
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
                        <img src="images/contributors/cici.png"/>
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
                    <li><a href="index.html">Home</a></li>
                    <li><a href="#">News</a>
                        <div class="sf-mega">
                            <div class="sf-mega-section">
                                <h2>Main Feature</h2>
                                <ul>
                                    <li><a href="category.html">Politic</a></li>
                                    <li><a href="category.html">World</a></li>
                                    <li><a href="category.html">Issues</a></li>
                                    <li><a href="category.html">Opinion</a></li>
                                    <li><a href="category.html">Hot</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Light News</h2>
                                <ul>
                                    <li><a href="category.html">Regional</a></li>
                                    <li><a href="category.html">Profile</a></li>
                                    <li><a href="category.html">Debate</a></li>
                                    <li><a href="category.html">Interview</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Headline</h2>
                                <ul>
                                    <li><a href="category.html">Latest</a></li>
                                    <li><a href="category.html">Trending</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li><a href="#">Economy</a>
                        <div class="sf-mega">
                            <div class="sf-mega-section">
                                <h2>Business</h2>
                                <ul>
                                    <li><a href="category.html">Finance</a></li>
                                    <li><a href="category.html">Stock</a></li>
                                    <li><a href="category.html">Micro Business</a></li>
                                    <li><a href="category.html">Management</a></li>
                                    <li><a href="category.html">Strategy</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>National</h2>
                                <ul>
                                    <li><a href="category.html">Government</a></li>
                                    <li><a href="category.html">Market</a></li>
                                    <li><a href="category.html">Exchange</a></li>
                                    <li><a href="category.html">Import</a></li>
                                    <li><a href="category.html">Export</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Academic</h2>
                                <ul>
                                    <li><a href="category.html">Accounting</a></li>
                                    <li><a href="category.html">Policy</a></li>
                                    <li><a href="category.html">Book</a></li>
                                    <li><a href="category.html">Startup</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li><a href="#">Entertainment</a>
                        <div class="sf-mega">
                            <div class="sf-mega-section">
                                <h2>Extravaganza</h2>
                                <ul>
                                    <li><a href="category.html">International</a></li>
                                    <li><a href="category.html">Celebrities</a></li>
                                    <li><a href="category.html">Film</a></li>
                                    <li><a href="category.html">Music</a></li>
                                    <li><a href="category.html">Game</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Daily</h2>
                                <ul>
                                    <li><a href="category.html">Jokes</a></li>
                                    <li><a href="category.html">Lifestyle</a></li>
                                    <li><a href="category.html">Vacation</a></li>
                                    <li><a href="category.html">Festival</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Hobby</h2>
                                <ul>
                                    <li><a href="category.html">Anime</a></li>
                                    <li><a href="category.html">Handicraft</a></li>
                                    <li><a href="category.html">Outdoor</a></li>
                                    <li><a href="category.html">Collector</a></li>
                                    <li><a href="category.html">Arts</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Others</h2>
                                <ul>
                                    <li><a href="category.html">K-pop</a></li>
                                    <li><a href="category.html">J-pop</a></li>
                                    <li><a href="category.html">Trend</a></li>
                                    <li><a href="category.html">Party</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li><a href="#">Sport</a>
                        <div class="sf-mega">
                            <div class="sf-mega-section">
                                <h2>Popular</h2>
                                <ul>
                                    <li><a href="category.html">Soccer</a></li>
                                    <li><a href="category.html">Tennis</a></li>
                                    <li><a href="category.html">MotoGP</a></li>
                                    <li><a href="category.html">Formula 1</a></li>
                                    <li><a href="category.html">Basket</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Popular</h2>
                                <ul>
                                    <li><a href="category.html">Badminton</a></li>
                                    <li><a href="category.html">Volley</a></li>
                                    <li><a href="category.html">Athletic</a></li>
                                    <li><a href="category.html">Rally</a></li>
                                    <li><a href="category.html">Bicycle</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Popular</h2>
                                <ul>
                                    <li><a href="category.html">Extreme Sport</a></li>
                                    <li><a href="category.html">Freestyle</a></li>
                                    <li><a href="category.html">Chess</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Event</h2>
                                <ul>
                                    <li><a href="category.html">World cup</a></li>
                                    <li><a href="category.html">Olympic</a></li>
                                    <li><a href="category.html">Champion</a></li>
                                    <li><a href="category.html">Schedule</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li><a href="#">Health</a>
                        <div class="sf-mega">
                            <div class="sf-mega-section">
                                <h2>Medic</h2>
                                <ul>
                                    <li><a href="category.html">Medication</a></li>
                                    <li><a href="category.html">Disease</a></li>
                                    <li><a href="category.html">Symptom</a></li>
                                    <li><a href="category.html">Knowledge</a></li>
                                    <li><a href="category.html">Drug</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Life</h2>
                                <ul>
                                    <li><a href="category.html">Lifestyle</a></li>
                                    <li><a href="category.html">Exercise</a></li>
                                    <li><a href="category.html">Food</a></li>
                                    <li><a href="category.html">Diet</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Doctor</h2>
                                <ul>
                                    <li><a href="category.html">Ask Doctor</a></li>
                                    <li><a href="category.html">Medical Journal</a></li>
                                    <li><a href="category.html">Hospital</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li><a href="#">Science</a>
                        <div class="sf-mega">
                            <div class="sf-mega-section">
                                <h2>Knowledge</h2>
                                <ul>
                                    <li><a href="category.html">Discovery</a></li>
                                    <li><a href="category.html">Research</a></li>
                                    <li><a href="category.html">Astronomy</a></li>
                                    <li><a href="category.html">Human</a></li>
                                    <li><a href="category.html">Earth</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Knowledge</h2>
                                <ul>
                                    <li><a href="category.html">Language</a></li>
                                    <li><a href="category.html">Chemistry</a></li>
                                    <li><a href="category.html">Biology</a></li>
                                    <li><a href="category.html">Physic</a></li>
                                    <li><a href="category.html">History</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Engineering</h2>
                                <ul>
                                    <li><a href="category.html">Communication</a></li>
                                    <li><a href="category.html">Construction</a></li>
                                    <li><a href="category.html">Electrical</a></li>
                                    <li><a href="category.html">Otomotive</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li><a href="#">Technology</a>
                        <div class="sf-mega">
                            <div class="sf-mega-section">
                                <h2>Computer</h2>
                                <ul>
                                    <li><a href="category.html">IT</a></li>
                                    <li><a href="category.html">Gadget</a></li>
                                    <li><a href="category.html">Software</a></li>
                                    <li><a href="category.html">Hardware</a></li>
                                    <li><a href="category.html">Internet</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Concept</h2>
                                <ul>
                                    <li><a href="category.html">Future</a></li>
                                    <li><a href="category.html">Programming</a></li>
                                    <li><a href="category.html">Cyber Security</a></li>
                                    <li><a href="category.html">UI Interaction</a></li>
                                    <li><a href="category.html">Social Network</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Handheld</h2>
                                <ul>
                                    <li><a href="category.html">Blackberry</a></li>
                                    <li><a href="category.html">Android</a></li>
                                    <li><a href="category.html">iOS</a></li>
                                    <li><a href="category.html">Windows Phone</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li><a href="#">Photo</a></li>
                    <li><a href="#">Video</a></li>
                    <li><a href="#">Others</a>
                        <div class="sf-mega">
                            <div class="sf-mega-section">
                                <h2>Life</h2>
                                <ul>
                                    <li><a href="category.html">Motivation</a></li>
                                    <li><a href="category.html">Family</a></li>
                                    <li><a href="category.html">Career</a></li>
                                    <li><a href="category.html">Couple</a></li>
                                    <li><a href="category.html">Relationship</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Miscellaneous</h2>
                                <ul>
                                    <li><a href="category.html">Life Hack</a></li>
                                    <li><a href="category.html">The Lounge</a></li>
                                    <li><a href="category.html">Opinion</a></li>
                                    <li><a href="category.html">Society</a></li>
                                    <li><a href="category.html">Education</a></li>
                                </ul>
                            </div>
                            <div class="sf-mega-section">
                                <h2>Miscellaneous</h2>
                                <ul>
                                    <li><a href="category.html">Idea</a></li>
                                    <li><a href="category.html">Sharing</a></li>
                                    <li><a href="category.html">Other</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
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
                        <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                    <img src="images/misc/logo.png" alt="Logo InfoGue" class="img-responsive logo"/>
                    <p class="hidden-xs">The most update web portal news. We always provide latest article and information with high
                        integrity and truth. Knowledge is beyond among us to share with you.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 hidden-xs clearfix">
                <h3>QUICK LINKS</h3>
                <ul class="quick-links">
                    <li><a href="category.html">HEADLINE</a></li>
                    <li><a href="category.html">TRENDING</a></li>
                    <li><a href="category.html">POPULAR</a></li>
                    <li><a href="category.html">RANDOM</a></li>
                    <li><a href="category.html">COMMENTED</a></li>
                    <li><a href="category.html">SIGN IN</a></li>
                </ul>
                <ul class="quick-links">
                    <li><a href="category.html">ENTERTAINMENT</a></li>
                    <li><a href="category.html">TECHNOLOGY</a></li>
                    <li><a href="category.html">SPORT</a></li>
                    <li><a href="category.html">NEWS</a></li>
                    <li><a href="category.html">HEALTH</a></li>
                    <li><a href="category.html">SCIENCE</a></li>
                </ul>
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
                            <p>Avenue Street 34 - East Java, Indonesia</p>
                            <p><a href="tel:+628565547868">(+62) 8565547868</a></p><br/>
                            <p><a href="mailto:editorial@infogue.com">editorial@infogue.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row bottom">
            <div class="col-sm-8">
                <ul class="featured-link hidden-xs">
                    <li><a href="/">Home</a></li>
                    <li><a href="/editorial">Editorial</a></li>
                    <li><a href="/privacy">Privacy</a></li>
                    <li><a href="/disclaimer">Disclaimer</a></li>
                    <li><a href="/faq">FAQ</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
                <div class="copyright">&copy; <span class="hidden-xs">Copyright</span> 2016 infogue.com All Rights Reserved.</div>
            </div>
            <div class="col-sm-4">
                <ul class="social hidden-xs">
                    <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<div class="to-top">
    <a href="#top"><i class="fa fa-arrow-up"></i></a>
</div>

<script src="/library/jquery/dist/jquery.min.js"></script>
<script src="/library/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/library/echojs/dist/echo.min.js"></script>
<script src="/library/equalize/js/equalize.min.js"></script>
<script src="/library/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/library/jquery.cycle2/index.js"></script>
<script src="/library/jquery.fitvids/jquery.fitvids.js"></script>
<script src="/library/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
<script src="/library/jquery.stellar/jquery.stellar.min.js"></script>
<script src="/library/superfish/dist/js/superfish.min.js"></script>
<script src="/library/superfish/dist/js/hoverIntent.js"></script>
<script src="/library/waypoints/lib/jquery.waypoints.min.js"></script>

<script src="/js/script.js"></script>

<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    if($('.newsletter').length){
        setTimeout(function(){
            $('.newsletter').modal('show');
        }, 3000);
    }

    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
</body>
</html>