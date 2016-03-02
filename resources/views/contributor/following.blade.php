@extends('public')

@section('title', '- Following')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="row">

                @include('contributor._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data">
                                <h3 class="title">FOLLOWING</h3>
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