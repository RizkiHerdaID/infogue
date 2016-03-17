<!-- header -->
<header>
    <a href="#menu-toggle" class="toggle-nav"><i class="fa fa-bars"></i></a>
    <div class="title">
        <h1>{{ ucfirst(Request::segment(2)) }}</h1>
    </div>
    <div class="control hidden-xs">
        <div class="account clearfix">
            <div class="avatar-wrapper">
                <img src="{{ asset('images/contributors/'.Auth::guard('admin')->user()->avatar) }}" class="img-circle img-rounded">
                <div class="notify"></div>
            </div>
            <p class="avatar-greeting pull-left hidden-sm">Hi, <strong>{{ Auth::guard('admin')->user()->name }}</strong></p>
        </div>
        <a href="{{ route('admin.login.destroy') }}" class="sign-out"><i class="fa fa-sign-out"></i> SIGN OUT</a>
    </div>
</header>
<!-- end of header -->