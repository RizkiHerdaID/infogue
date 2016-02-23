@extends('public')

@section('title', '- Login')

@section('content')

    <div class="login" data-stellar-background-ratio="0.3" data-stellar-vertical-offset="150">
        <section class="container">
            <div class="row">
                <div class="col-md-4 col-md-push-1 col-sm-5">
                    <h2 class="form-title">Sign In</h2>
                    <p class="form-subtitle">Login into Contributor profile</p>
                    <form action="contributor_stream.html">
                        <div class="mbm">
                            <div class="btn-group btn-group-justified" role="group">
                                <a class="btn btn-facebook" href="http://www.facebook.com">
                                    <i class="fa fa-facebook"></i> FACEBOOK
                                </a>
                                <a class="btn btn-twitter" href="http://www.twitter.com">
                                    <i class="fa fa-twitter"></i> TWITTER
                                </a>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Email Address or Username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="form-group clearfix">
                            <div class="checkbox pull-left mtn">
                                <input type="checkbox" id="agree" class="css-checkbox">
                                <label for="agree" class="css-label">Remember Me</label>
                            </div>
                            <a href="forgot.html" class="forgot-link clearfix pull-right">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
                    </form>
                    <p class="mtm text-center visible-xs">Don’t have an account?, <a href="register.html">Register here!</a></p>
                </div>
                <div class="col-md-6 col-md-push-2 col-sm-6 col-sm-push-1 hidden-xs">
                    <h1 class="caption">WELCOME BACK</h1>
                    <p class="lead mbs">Never stop writting, makes your brain sharp</p>
                    <p>Figure out about InfoGue’s feature, <a href="faq.html">Learn More</a></p>
                    <p class="mbm mtl">Don’t have an account?, <a href="register.html">Register here!</a></p>
                </div>
            </div>
        </section>
    </div>

@endsection