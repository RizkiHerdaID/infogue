@extends('public')

@section('title', '- Imelda Agustine')

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
                                                <p class="location hidden-xs"><i class="fa fa-map-marker"></i> Gresik, Indonesia</p>
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
                                <h3 class="title">STREAM</h3>
                                <div class="content">
                                    <div class="article-preview landscape mini">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-5">
                                                <div class="featured-image">
                                                    <img src="images/misc/preloader.gif" alt="Featured 8" data-echo="images/featured/image8.jpg"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-7">
                                                <div class="title-wrapper">
                                                    <p class="category hidden-xs"><a href="category.html">Sport</a></p>
                                                    <h1 class="title">
                                                        <a href="article.html">
                                                            Bicyclist recommend warming up before exercising
                                                        </a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>By <a href="profile.html">Wanda</a></li>
                                                        <li>28 April 2016</li>
                                                        <li class="hidden-xs">48 Views</li>
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
                                                    <img src="images/misc/preloader.gif" alt="Featured 9" data-echo="images/featured/image9.jpg"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-7">
                                                <div class="title-wrapper">
                                                    <p class="category hidden-xs"><a href="category.html">Sport</a></p>
                                                    <h1 class="title">
                                                        <a href="article.html">
                                                            Extreme sport now more popular lately
                                                        </a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>By <a href="profile.html">Merry<span class="hidden-xs"> Go Raound</span></a></li>
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
                                                        <li>By <a href="profile.html">Vina<span class="hidden-xs"> Panduwinata</span></a></li>
                                                        <li>11 March 2016</li>
                                                        <li class="hidden-xs">734 Views</li>
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
                                                    <img src="images/misc/preloader.gif" alt="Featured 11" data-echo="images/featured/image11.jpg"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-7">
                                                <div class="title-wrapper">
                                                    <p class="category hidden-xs"><a href="category.html">Science</a></p>
                                                    <h1 class="title">
                                                        <a href="article.html">
                                                            New reality and old one blend to the nature
                                                        </a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>By <a href="profile.html">Dewi<span class="hidden-xs"> Ariyani</span></a></li>
                                                        <li>11 February 2016</li>
                                                        <li class="hidden-xs">34 Views</li>
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
                                                    <img src="images/misc/preloader.gif" alt="Featured 12" data-echo="images/featured/image12.jpg"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-7">
                                                <div class="title-wrapper">
                                                    <p class="category hidden-xs"><a href="category.html">Economic</a></p>
                                                    <h1 class="title">
                                                        <a href="article.html">
                                                            Grand opening new coffee shop at corner of the city of light
                                                        </a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>By <a href="profile.html">Angga<span class="hidden-xs"> Ari Wijaya</span></a></li>
                                                        <li>25 January 2016</li>
                                                        <li class="hidden-xs">941 Views</li>
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