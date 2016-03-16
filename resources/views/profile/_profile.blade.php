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
                    @if(!(Auth::check() && Auth::user()->id == $contributor->id))
                        <a class="btn btn-primary btn-outline @if(Auth::check()){{ $contributor->following_status }}@endif" href="@if(Auth::check()){{ '#' }}@else{{ route('login.form') }}@endif" @if(Auth::check()) data-id="{{ $contributor->id }}" data-toggle="button" @endif>{{ $contributor->following_text }}</a>
                        <a class="btn btn-primary btn-outline btn-message" href="@if(Auth::check()){{ '#' }}@else{{ route('login.form') }}@endif" @if(Auth::check()) data-target="#send-message" data-toggle="modal" @endif><i class="fa fa-envelope-o"></i></a>
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
    @if(Session::has('status'))
        <div class="alert alert-{{ Session::get('status') }}" style="border-radius: 0">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
                <span aria-hidden="true">&times;</span>
            </button>
            {!! Session::get('message') !!}
        </div>
    @endif
</section>

<div class="modal fade color" id="send-message" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('account.message.send') }}" id="form-message" class="form-strip form-horizontal" method="post">
                {!! csrf_field() !!}
                <input type="hidden" id="contributor_id" name="contributor_id" value="{{ $contributor->id }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-envelope-o"></i> SEND MESSAGE</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>SEND TO : </label> <span class="message-to"></span>
                    </div>
                    <div class="form-group">
                        <label for="message" class="mbs">MESSAGE : </label>
                        <textarea name="message" class="form-control" id="message" cols="30" rows="5" placeholder="Type message here" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-danger">DISCARD</a>
                    <button type="submit" class="btn btn-primary">SEND</button>
                </div>
            </form>
        </div>
    </div>
</div>