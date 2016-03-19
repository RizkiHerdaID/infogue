@extends('public')

@section('title', '- Forgot Password')

@section('content')

    <div class="forgot" data-stellar-background-ratio="0.7" data-stellar-vertical-offset="220">
        <section class="container">
            <div class="row">
                <div class="col-md-4 col-md-push-1 col-sm-5">
                    <h2 class="form-title">Reset My Password</h2>
                    <p class="form-subtitle">We will try to recover your account</p>

                    @if(Session::has('status'))
                        <div class="form-group">
                            <div class="alert alert-warning">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="margin-top: 0; font-size: 16px;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                {{ Session::get('status') }}
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('login.reset.email') }}" method="post" id="form-email">
                        {!! csrf_field() !!}
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">REGISTERED EMAIL</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">RESET</button>
                    </form>
                </div>
                <div class="col-md-6 col-md-push-2 col-sm-7">
                    <h2 class="mbs hidden-xs">Recovery Your Account</h2>
                    <p class="hidden-xs">Still doesn't know about InfoGue feature, <a href="{{ url('faq') }}">Learn More</a></p>
                    <p class="mbm mtl">Remember your credential? <a href="{{ route('login.form') }}">Sign here!</a> or connect with</p>
                    <div class="mbm">
                        <a class="btn btn-facebook mrs" href="{{ url('auth/facebook') }}">
                            <i class="fa fa-facebook"></i> FACEBOOK
                        </a>
                        <a class="btn btn-twitter" href="{{ url('auth/twitter') }}">
                            <i class="fa fa-twitter"></i> TWITTER
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection