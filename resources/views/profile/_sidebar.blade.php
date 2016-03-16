@if(Auth::check())
    <div class="col-md-4 hidden-sm hidden-xs">
        <div class="contributor-menu compact">
            <div class="featured" style="background: url('{{ asset('images/covers/'.Auth::user()->cover) }}') no-repeat center center / cover">
                <div class="contributor-profile mini">
                    <img src="{{ asset('images/contributors/'.Auth::user()->avatar) }}" class="avatar img-circle img-responsive" width="80"/>
                    <div class="info">
                        <p class="name">{{ Auth::user()->name }}</p>
                        <p class="location">@if(empty(Auth::user()->location)){{ 'No Location' }}@else{{ Auth::user()->location }}@endif</p>
                    </div>
                </div>
                <a href="{{ route('account.article.create') }}" class="btn btn-primary btn-outline btn-block">CREATE ARTICLE</a>
            </div>
            <nav>
                <ul>
                    <li><a href="{{ route('account.stream') }}"><i class="fa fa-desktop"></i>Stream</a></li>
                    <li><a href="{{ route('account.article.index') }}"><i class="fa fa-file-text"></i>Article</a></li>
                    <li><a href="{{ route('account.message.list') }}"><i class="fa fa-envelope"></i>Message</a></li>
                    <li><a href="{{ route('account.follower') }}"><i class="fa fa-chevron-left"></i>Follower</a></li>
                    <li><a href="{{ route('account.following') }}"><i class="fa fa-chevron-right"></i>Following</a></li>
                    <li><a href="{{ route('account.setting') }}"><i class="fa fa-wrench"></i>Setting</a></li>
                    <li><a href="{{ route('login.destroy') }}"><i class="fa fa-sign-out"></i>Sign Out</a></li>
                </ul>
            </nav>
        </div>
    </div>
@else
    <div class="col-md-4 hidden-sm hidden-xs">
        <div class="contributor-menu unauthorized hidden-xs">
            <div class="featured">
                <div class="info">
                    <p class="title">Don't have an account?</p>
                    <p class="subtitle">Let's make it one</p>
                    <a href="{{ route('register.form') }}" class="btn btn-primary btn-outline btn-block">REGISTER</a>
                </div>
            </div>
            <div class="login-form">
                <h2 class="form-title">Sign In</h2>
                <p class="form-subtitle">Login into Contributor profile</p>
                <form action="{{ route('login.attempt') }}" method="post">
                    {!! csrf_field() !!}
                    <div class="mbm">
                        <div class="btn-group btn-group-justified" role="group">
                            <a class="btn btn-facebook" href="{{ url('auth/facebook') }}">
                                <i class="fa fa-facebook"></i> FACEBOOK
                            </a>
                            <a class="btn btn-twitter" href="{{ url('auth/twitter') }}">
                                <i class="fa fa-twitter"></i> TWITTER
                            </a>
                        </div>
                    </div>

                    @if(Session::has('status'))
                        <div class="form-group">
                            <div class="alert alert-danger">
                                {{ Session::get('status') }}
                            </div>
                        </div>
                    @endif

                    <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                        <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Email Address or Username" required>
                        {!! $errors->first('username', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group clearfix">
                        <div class="checkbox pull-left mtn">
                            <input type="checkbox" id="remember" name="remember" class="css-checkbox" @if(old('remember', 0)) checked @endif>
                            <label for="remember" class="css-label">Remember Me</label>
                        </div>
                        <a href="{{ route('login.forgot') }}" class="forgot-link clearfix pull-right">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
                </form>
            </div>
        </div>
    </div>
@endif