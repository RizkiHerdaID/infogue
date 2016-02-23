@extends('public')

@section('title', '- Imelda Agustine\'s Detail')

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
                    <div class="account-profile detail">
                        <div class="cover" style="background: url('/images/backgrounds/beach.jpg') no-repeat center / cover"></div>
                        <div class="profile-wrapper">
                            <section class="profile">
                                <img src="images/contributors/team03.jpg" class="avatar img-circle"/>
                                <h2 class="name"><a href="profile.html">Diah Ayu Permata</a></h2>

                                <p class="about">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum harum, itaque. Culpa
                                    dolorum illo nesciunt nobis tenetur ullam veniam voluptate!</p>

                                <ul class="statistic nav-justified">
                                    <li><a href="profile_following.html"><strong>13</strong>FOLLOWING</a></li>
                                    <li><a href="profile_article.html"><strong>54</strong>ARTICLES</a></li>
                                    <li><a href="profile_follower.html"><strong>63</strong>FOLLOWERS</a></li>
                                </ul>

                            </section>
                            <section class="list-data">
                                <h3 class="title">PROFILE DETAIL <a href="profile.html">BACK TO PROFILE</a></h3>
                                <div class="content">
                                    <ul class="list-group">
                                        <li class="list-group-item active">
                                            <strong>ACCOUNT</strong>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-user"></i>Full Name</strong>
                                            <span class="value">Diah Ayu Permata</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-heart"></i>Username</strong>
                                            <span class="value">diahayu</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-envelope"></i>Email</strong>
                                            <span class="value">diah@gmail.com</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-phone"></i>Contact</strong>
                                            <span class="value">(+62) 0856325426</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-birthday-cake"></i>Birthday</strong>
                                            <span class="value">26 of May 1992</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-female"></i>Gender</strong>
                                            <span class="value">Female</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-map-marker"></i>Location</strong>
                                            <span class="value">Gresik, Indonesia</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-check"></i>Member Since</strong>
                                            <span class="value">23 January 2016</span>
                                        </li>
                                        <li class="list-group-item active">
                                            <strong>ACHIEVEMENT</strong>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-file-text"></i>Article</strong>
                                            <span class="value">3432 Articles</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-users"></i>Followers</strong>
                                            <span class="value">734 People</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-users"></i>Following</strong>
                                            <span class="value">563 Contributors</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-trophy"></i>Popularity</strong>
                                            <span class="value">4.5 / 5</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-eye"></i>Article Viewed</strong>
                                            <span class="value">467K Views</span>
                                        </li>
                                        <li class="list-group-item active">
                                            <strong>SOCIAL</strong>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-twitter"></i>Twitter</strong>
                                            <span class="value">@diahayu</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-facebook"></i>Facebook</strong>
                                            <span class="value">diah.ayu</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-google-plus"></i>Google+</strong>
                                            <span class="value">+diah.ayu</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-instagram"></i>Instagram</strong>
                                            <span class="value">diahayu</span>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection