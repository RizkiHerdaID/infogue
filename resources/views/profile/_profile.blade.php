<section class="profile">
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('images/contributors/'.$contributor->avatar) }}" class="avatar img-circle"/>
            <div class="text-center hidden-sm hidden-xs">
                <a class="btn btn-primary btn-outline mtm" href="{{ route('contributor.detail', [$contributor->username]) }}">MORE INFO</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row mts">
                <div class="col-md-7">
                    <h2 class="name"><a href="{{ route('contributor.stream', [$contributor->username]) }}">{{ $contributor->name }}</a></h2>
                </div>
                <div class="col-md-5">
                    <a class="btn btn-primary btn-outline more-info" href="{{ route('contributor.detail', [$contributor->username]) }}">MORE INFO</a>
                    @if(Auth::check() && Auth::user()->id != $contributor->id)
                    <a class="btn btn-primary btn-outline {{ $contributor->following_status }}" href="#" data-toggle="button">{{ $contributor->following_text }}</a>
                    <a class="btn btn-primary btn-outline" href="#" data-target="#send-message" data-toggle="modal"><i class="fa fa-envelope-o"></i></a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="about">{{ $contributor->about }} <a href="{{ route('contributor.detail', [$contributor->username]) }}">More</a></p>
                    <p class="location hidden-xs"><i class="fa fa-map-marker"></i> {{ $contributor->location }}</p>
                </div>
                <div class="col-md-12">
                    <ul class="statistic nav-justified">
                        <li><a href="{{ route('contributor.following', [$contributor->username]) }}"><strong>{{ $contributor->following()->count() }}</strong>FOLLOWING</a></li>
                        <li><a href="{{ route('contributor.article', [$contributor->username]) }}"><strong>{{ $contributor->articles()->where('status', 'published')->count() }}</strong>ARTICLES</a></li>
                        <li><a href="{{ route('contributor.follower', [$contributor->username]) }}"><strong>{{ $contributor->followers()->count() }}</strong>FOLLOWERS</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>