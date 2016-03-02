@extends('public')

@section('title', '- '.$contributor->name.' Detail')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="breadcrumb-wrapper hidden-xs">
                <ol class="breadcrumb mtn">
                    <li><a href="{{ route('article.archive') }}">Archive</a></li>
                    <li class="active">Contributor</li>
                    <li class="active">{{ $contributor->name }}</li>
                </ol>
            </div>

            <div class="row">

                @include('profile._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile detail">
                        <div class="cover" style="background: url('{{ asset('images/covers/'.$contributor->cover) }}') no-repeat center / cover"></div>
                        <div class="profile-wrapper">
                            <section class="profile">
                                <img src="{{ asset('images/contributors/'.$contributor->avatar) }}" class="avatar img-circle"/>
                                <h2 class="name"><a href="{{ route('contributor.stream', [$contributor->username]) }}">{{ $contributor->name }}</a></h2>

                                <p class="about">{{ $contributor->about }}</p>

                                <ul class="statistic nav-justified">
                                    <li><a href="{{ route('contributor.following', [$contributor->username]) }}"><strong>{{ $contributor->following()->count() }}</strong>FOLLOWING</a></li>
                                    <li><a href="{{ route('contributor.article', [$contributor->username]) }}"><strong>{{ $contributor->articles()->where('status', 'published')->count() }}</strong>ARTICLES</a></li>
                                    <li><a href="{{ route('contributor.follower', [$contributor->username]) }}"><strong>{{ $contributor->followers()->count() }}</strong>FOLLOWERS</a></li>
                                </ul>

                            </section>
                            <section class="list-data">
                                <h3 class="title">PROFILE DETAIL <a href="{{ route('contributor.stream', [$contributor->username]) }}">BACK TO PROFILE</a></h3>
                                <div class="content">
                                    <ul class="list-group">
                                        <li class="list-group-item active">
                                            <strong>ACCOUNT</strong>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-user"></i>Full Name</strong>
                                            <span class="value">{{ $contributor->name }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-heart"></i>Username</strong>
                                            <span class="value">{{ $contributor->username }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-envelope"></i>Email</strong>
                                            <span class="value">{{ $contributor->email }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-phone"></i>Contact</strong>
                                            <span class="value">@if($contributor->contact != null){{ $contributor->contact }}@else{{ '-' }}@endif</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-birthday-cake"></i>Birthday</strong>
                                            <span class="value">@if($contributor->birthday != null)@fulldate(\Carbon\Carbon::parse($contributor->birthday))@else{{ '-' }}@endif</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-female"></i>Gender</strong>
                                            <span class="value">{{ $contributor->gender }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-map-marker"></i>Location</strong>
                                            <span class="value">{{ $contributor->location }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-check"></i>Member Since</strong>
                                            <span class="value">@fulldate(\Carbon\Carbon::parse($contributor->created_at))</span>
                                        </li>
                                        <li class="list-group-item active">
                                            <strong>ACHIEVEMENT</strong>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-file-text"></i>Article</strong>
                                            <span class="value">{{ $contributor->articles->count() }} Articles</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-users"></i>Followers</strong>
                                            <span class="value">{{ $contributor->followers->count() }} People</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-users"></i>Following</strong>
                                            <span class="value">{{ $contributor->following->count() }} Contributors</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-trophy"></i>Popularity</strong>
                                            <span class="value">{{ round($contributor->followers->count() / $contributor->following->count(), 2) }}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-eye"></i>Article Viewed</strong>
                                            <span class="value">{{ $contributor->articles->sum('view') }} Views</span>
                                        </li>
                                        <li class="list-group-item active">
                                            <strong>SOCIAL</strong>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-twitter"></i>Twitter</strong>
                                            <span class="value">@if($contributor->twitter != null)<a href="{{ $contributor->twitter }}" target="_blank">{{ $contributor->twitter }}</a>@else{{ '-' }}@endif</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-facebook"></i>Facebook</strong>
                                            <span class="value">@if($contributor->facebook != null)><a href="{{ $contributor->facebook }}" target="_blank">{{ $contributor->facebook }}</a>@else{{ '-' }}@endif</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-google-plus"></i>Google+</strong>
                                            <span class="value">@if($contributor->googleplus != null)<a href="{{ $contributor->googleplus }}" target="_blank">{{ $contributor->googleplus }}</a>@else{{ '-' }}@endif</span>
                                        </li>
                                        <li class="list-group-item">
                                            <strong><i class="fa fa-instagram"></i>Instagram</strong>
                                            <span class="value">@if($contributor->instagram != null)><a href="{{ $contributor->instagram }}" target="_blank">{{ $contributor->instagram }}</a>@else{{ '-' }}@endif</span>
                                        </li>
                                    </ul>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection