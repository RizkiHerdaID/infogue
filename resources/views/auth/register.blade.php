@extends('public')

@section('title', '- Register')

@section('content')

    <div class="register" data-stellar-background-ratio=".3" data-stellar-vertical-offset="160">
        <section class="container">
            <div class="row">
                <div class="col-md-7 col-md-push-1 col-sm-7 hidden-xs">
                    <h1 class="caption">JOIN WITH US</h1>
                    <p class="lead mbs">Spread the world with limitless information</p>
                    <p>Be a InfoGue’s Contributor, <a href="faq.html">Learn More</a></p>
                    <p class="mbm mtl">Have an account?, <a href="login.html">Sign In here!</a> or connect with</p>
                    <div>
                        <a class="btn btn-facebook mrs" href="http://www.facebook.com">
                            <i class="fa fa-facebook"></i> FACEBOOK
                        </a>
                        <a class="btn btn-twitter" href="http://www.twitter.com">
                            <i class="fa fa-twitter"></i> TWITTER
                        </a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-5">
                    <h2 class="form-title">Create an Account</h2>
                    <p class="form-subtitle">Registering yourself as Contributor</p>

                    <div class="mbm visible-xs">
                        <a class="btn btn-facebook mrs" href="http://www.facebook.com">
                            <i class="fa fa-facebook"></i> FACEBOOK
                        </a>
                        <a class="btn btn-twitter" href="http://www.twitter.com">
                            <i class="fa fa-twitter"></i> TWITTER
                        </a>
                    </div>

                    <form action="confirmation.html">
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="retype-password" placeholder="Retype Password">
                        </div>
                        <div class="checkbox">
                            <input type="checkbox" id="agree" class="css-checkbox">
                            <label for="agree" class="css-label">I agree with all <a href="term.html">terms</a> and <a href="privacy.html">conditions</a></label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">REGISTER</button>
                    </form>
                    <p class="mtm visible-xs text-center">Have an account?, <a href="login.html">Sign In here!</a>
                </div>
            </div>
        </section>
    </div>

@endsection