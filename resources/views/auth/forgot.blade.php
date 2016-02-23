@extends('public')

@section('title', '- Forgot Password')

@section('content')

    <div class="forgot" data-stellar-background-ratio="0.7" data-stellar-vertical-offset="220">
        <section class="container">
            <div class="row">
                <div class="col-md-4 col-md-push-1 col-sm-5">
                    <h2 class="form-title">Reset My Password</h2>
                    <p class="form-subtitle">We will try to recover your account</p>
                    <form action="reset.html">
                        <div class="form-group">
                            <label for="email">REGISTERED EMAIL</label>
                            <input type="email" class="form-control" id="email" placeholder="Email Address">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">RESET</button>
                    </form>
                </div>
                <div class="col-md-6 col-md-push-2 col-sm-7">
                    <h2 class="mbs hidden-xs">Recovery Your Account</h2>
                    <p class="hidden-xs">Still doesn't know about InfoGue's feature, <a href="faq.html">Learn More</a></p>
                    <p class="mbm mtl">Remember your credential? <a href="login.html">Sign here!</a> or connect with</p>
                    <div class="mbm">
                        <a class="btn btn-facebook mrs" href="http://www.facebook.com">
                            <i class="fa fa-facebook"></i> FACEBOOK
                        </a>
                        <a class="btn btn-twitter" href="http://www.twitter.com">
                            <i class="fa fa-twitter"></i> TWITTER
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection