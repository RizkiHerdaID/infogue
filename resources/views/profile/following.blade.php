@extends('public')

@section('title', '- Imelda Agustine\'s Following')

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
                                <h3 class="title">FOLLOWING <a href="profile.html">BACK TO PROFILE</a></h3>
                                <div class="content">
                                    <div role="list">
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/bita.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Bita Diflia</a>
                                                <p class="location">Surabaya, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/cindy.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Cindy Sriani</a>
                                                <p class="location">Situbondo, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/eta.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Margareta Ester</a>
                                                <p class="location">Jember, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/hadi.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Hadi Subroto</a>
                                                <p class="location">Jember, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/lisna.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Lisna Wardiantika</a>
                                                <p class="location">Lumajang, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/pras.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Risha Preasetya</a>
                                                <p class="location">Malang, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/vivi.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Vivi Rachkmawati</a>
                                                <p class="location">Lumajang, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/ratna.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Ratna Agustin</a>
                                                <p class="location">Probolinggo, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/zizi.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Nur Azizi</a>
                                                <p class="location">Bondowoso, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/angga.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Angga Ari Wijaya</a>
                                                <p class="location">Gresik, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
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