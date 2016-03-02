@extends('public')

@section('title', '- Followers')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="row">

                @include('contributor._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data">
                                <h3 class="title">FOLLOWERS</h3>
                                <div class="content">
                                    <div role="list">
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/team01.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Shanon Rean</a>
                                                <p class="location">Surabaya, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow" data-toggle="button" aria-pressed="false" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">FOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/angga.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Angga Ari Wijaya</a>
                                                <p class="location">Jakarta, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/team04.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Wendi Aditya Wijaya</a>
                                                <p class="location">Jember, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/cici.png" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Imelda Agustine</a>
                                                <p class="location">Jakarta, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/profile.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Brian Vhirdrict</a>
                                                <p class="location">Boston, USA</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow" data-toggle="button" aria-pressed="false" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">FOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/team02.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Rendi Beat</a>
                                                <p class="location">Malang, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/iyan.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Iyan Budiman</a>
                                                <p class="location">Banyuwangi, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/lukman.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Lukman Hidayatullah</a>
                                                <p class="location">Jember, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow active" data-toggle="button" aria-pressed="true" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">UNFOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/vivi.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Vivi Rachkmawati</a>
                                                <p class="location">Lumajang, Indonesia</p>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-follow" data-toggle="button" aria-pressed="false" autocomplete="off"><i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">FOLLOW</span></button>
                                        </div>
                                        <div class="contributor-profile mini">
                                            <img src="images/contributors/desi.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="profile.html" class="name">Desi Wulandari</a>
                                                <p class="location">Surabaya, Indonesia</p>
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