@extends('public')

@section('title', '- Imelda Agustine\'s Article')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="breadcrumb-wrapper hidden-xs">
                <ol class="breadcrumb mtn">
                    <li><a href="archive.html">Archive</a></li>
                    <li><a href="contributor.html">Contributor</a></li>
                    <li class="active">Imelda Agustine</li>
                </ol>
            </div>

            <div class="row">

                @include('profile.sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="cover" style="background: url('/images/backgrounds/beach.jpg') no-repeat center / cover"></div>
                        <div class="profile-wrapper">
                            <section class="profile">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src="images/contributors/team03.jpg" class="avatar img-circle"/>
                                        <div class="text-center hidden-sm hidden-xs">
                                            <a class="btn btn-primary btn-outline mtm" href="profile_detail.html">MORE INFO</a>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row mts">
                                            <div class="col-md-7">
                                                <h2 class="name"><a href="profile.html">Diah Ayu Permata</a></h2>
                                            </div>
                                            <div class="col-md-5">
                                                <a class="btn btn-primary btn-outline more-info" href="profile_detail.html">MORE INFO</a>
                                                <a class="btn btn-primary btn-outline" href="#">FOLLOW</a>
                                                <a class="btn btn-primary btn-outline" href="#" data-target="#send-message" data-toggle="modal"><i class="fa fa-envelope-o"></i></a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="about">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum harum, itaque. Culpa
                                                    dolorum illo nesciunt nobis tenetur ullam veniam voluptate!.<a href="profile_detail.html">More</a></p>
                                                <p class="location"><i class="fa fa-map-marker"></i> Gresik, Indonesia</p>
                                            </div>
                                            <div class="col-md-12">
                                                <ul class="statistic nav-justified">
                                                    <li><a href="profile_following.html"><strong>13</strong>FOLLOWING</a></li>
                                                    <li><a href="profile_article.html"><strong>54</strong>ARTICLES</a></li>
                                                    <li><a href="profile_follower.html"><strong>63</strong>FOLLOWERS</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="list-data">
                                <h3 class="title">ARTICLES</h3>
                                <div class="content">
                                    <div class="article-preview landscape mini">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-5">
                                                <div class="featured-image">
                                                    <img src="images/misc/preloader.gif" alt="Featured 10" data-echo="images/featured/image10.jpg"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-7">
                                                <div class="title-wrapper">
                                                    <p class="category hidden-xs"><a href="category.html">Health</a></p>
                                                    <h1 class="title">
                                                        <a href="article.html">
                                                            Young people in Indonesia introduce importance of exercise
                                                        </a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>By <a href="profile.html">Diah Ayu Permata</a></li>
                                                        <li>11 March 2016</li>
                                                        <li class="hidden-xs">734 Views</li>
                                                    </ul>
                                                </div>
                                                <div class="rating-wrapper" data-rating="3"></div>
                                                <ul class="social text-right">
                                                    <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="article-preview landscape mini">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-5">
                                                <div class="featured-image">
                                                    <img src="images/misc/preloader.gif" alt="Featured 18" data-echo="images/featured/image18.jpg"/>
                                                </div>
                                            </div>
                                            <div class="col-xs-8 col-xs-7">
                                                <div class="title-wrapper">
                                                    <p class="category hidden-xs"><a href="category.html">Technology</a></p>
                                                    <h1 class="title">
                                                        <a href="article.html">
                                                            Google has release new concept od User Interface design
                                                        </a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>By <a href="profile.html">Diah Ayu Permata</a></li>
                                                        <li>28 April 2016</li>
                                                        <li class="hidden-xs">48 Views</li>
                                                    </ul>
                                                </div>
                                                <div class="rating-wrapper" data-rating="1"></div>
                                                <ul class="social text-right">
                                                    <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="article-preview landscape mini">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-5">
                                                <div class="featured-image">
                                                    <img src="images/misc/preloader.gif" alt="Featured 19" data-echo="images/featured/image19.jpg"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-7">
                                                <div class="title-wrapper">
                                                    <p class="category hidden-xs"><a href="category.html">Health</a></p>
                                                    <h1 class="title">
                                                        <a href="article.html">
                                                            People grow old and dying like always
                                                        </a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>By <a href="profile.html">Diah Ayu Permata</a></li>
                                                        <li>22 April 2016</li>
                                                        <li class="hidden-xs">78 Views</li>
                                                    </ul>
                                                </div>
                                                <div class="rating-wrapper" data-rating="2"></div>
                                                <ul class="social text-right">
                                                    <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="article-preview landscape mini">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-5">
                                                <div class="featured-image">
                                                    <img src="images/misc/preloader.gif" alt="Featured 20" data-echo="images/featured/image20.jpg"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-7">
                                                <div class="title-wrapper">
                                                    <p class="category hidden-xs"><a href="category.html">Economic</a></p>
                                                    <h1 class="title">
                                                        <a href="article.html">
                                                            Electronic get expensive everyday
                                                        </a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>By <a href="profile.html">Diah Ayu Permata</a></li>
                                                        <li>25 January 2016</li>
                                                        <li class="hidden-xs">941 Views</li>
                                                    </ul>
                                                </div>
                                                <div class="rating-wrapper" data-rating="4"></div>
                                                <ul class="social text-right">
                                                    <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="article-preview landscape mini">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-5">
                                                <div class="featured-image">
                                                    <img src="images/misc/preloader.gif" alt="Featured 21" data-echo="images/featured/image21.jpg"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-7">
                                                <div class="title-wrapper">
                                                    <p class="category hidden-xs"><a href="category.html">Health</a></p>
                                                    <h1 class="title">
                                                        <a href="article.html">
                                                            Now doctor consultation can be accessed at home
                                                        </a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>By <a href="profile.html">Diah Ayu Permata</a></li>
                                                        <li>11 February 2016</li>
                                                        <li>34 Views</li>
                                                    </ul>
                                                </div>
                                                <div class="rating-wrapper" data-rating="3"></div>
                                                <ul class="social text-right">
                                                    <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                                    <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                                    <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center pm">
                                    <div class="loading"></div>
                                    <a href="#" class="btn btn-primary btn-load-more">LOAD MORE</a>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection