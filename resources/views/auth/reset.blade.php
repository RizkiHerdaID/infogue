@extends('public')

@section('title', '- Reset Password')

@section('content')

    <div class="reset" style="background: url('/images/covers/231894.jpg') no-repeat center / cover">
        <section class="container">
            <div class="row">
                <div class="col-md-7 col-sm-7">
                    <div class="contributor-profile">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="images/contributors/cici.png" class="img-circle avatar"/>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="profile.html" class="name">Shangrilla Ayu Dewi</a>
                                        <p class="location">Jakarta, Indonesia</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="about hidden-xs">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut consectetur,
                                            cupiditate eligendi est expedita fugit in iusto labore minus numquam odit quae
                                            quam ratione. <a href="profile.html">MORE</a></p>
                                        <ul class="statistic list-separated">
                                            <li><a href="profile_article.html">54 ARTICLE</a></li>
                                            <li><a href="profile_following.html">13 FOLLOWING</a></li>
                                            <li><a href="profile_follower.html">63 FOLLOWERS</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-md-push-1 col-sm-5">
                    <h2 class="form-title">Reset Password</h2>
                    <p class="form-subtitle">Recovering your credential</p>

                    <form action="login.html">
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" readonly value="anggadarkprince@gmail.com" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="retype-password" placeholder="Retype Password">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">RESET MY PASSWORD</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection