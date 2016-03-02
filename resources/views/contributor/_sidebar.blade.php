<div class="col-md-4 hidden-sm hidden-xs">
    <div class="contributor-menu default">
        <div class="featured" style="background: url('{{ asset('/images/covers/'.Auth::user()->cover) }}') no-repeat center center / cover"></div>
        <div class="contributor-profile mini">
            <img src="{{ asset('images/contributors/'.Auth::user()->avatar) }}" class="avatar img-circle img-responsive"/>
            <div class="info">
                <p class="name"><a href="{{ route('contributor.stream', [Auth::user()->username]) }}">{{ Auth::user()->name }}</a></p>
                <ul class="list-separated small mts text-muted">
                    <li>{{ Auth::user()->followers()->count() }} FOLLOWERS</li>
                    <li>{{ Auth::user()->following()->count() }} FOLLOWING</li>
                </ul>
            </div>
            <a href="{{ route('account.article.create') }}" class="btn btn-primary btn-outline btn-block">CREATE ARTICLE</a>
        </div>
        <nav role="navigation">
            <ul role="listbox">
                <li @if(Request::segment(2) == '') class='active' @endif><a href="{{ route('account.stream') }}"><i class="fa fa-desktop"></i>Stream</a></li>
                <li @if(Request::segment(2) == 'article') class='active' @endif><a href="{{ route('account.article.index') }}"><i class="fa fa-file-text"></i>Article</a></li>
                <li @if(Request::segment(2) == 'message') class='active' @endif><a href="{{ route('account.message.list') }}"><i class="fa fa-envelope"></i>Message</a></li>
                <li @if(Request::segment(2) == 'follower') class='active' @endif><a href="{{ route('account.follower') }}"><i class="fa fa-chevron-left"></i>Follower</a></li>
                <li @if(Request::segment(2) == 'following') class='active' @endif><a href="{{ route('account.following') }}"><i class="fa fa-chevron-right"></i>Following</a></li>
                <li @if(Request::segment(2) == 'setting') class='active' @endif><a href="{{ route('account.setting') }}"><i class="fa fa-wrench"></i>Setting</a></li>
                <li><a href="{{ route('login.destroy') }}"><i class="fa fa-sign-out"></i>Sign Out</a></li>
            </ul>
        </nav>
    </div>
</div>