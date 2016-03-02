@extends('public')

@section('title', '- Followers')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="row">

                @include('contributor._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data" data-href="{{ Request::url() }}">
                                <h3 class="title">FOLLOWERS</h3>
                                <div class="content">
                                    <div role="list" id="followers">

                                    </div>
                                </div>
                                <div class="text-center pm">
                                    <div class="loading"></div>
                                    <a href="#" class="btn btn-primary btn-load-more">LOAD MORE</a>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script id="follower-row-template" type="text/template">
        @{{#data}}
        <div class="contributor-profile mini">
            <img src="@{{ avatar_ref }}" class="avatar img-circle img-responsive"/>
            <div class="info">
                <a href="@{{ contributor_ref }}" class="name">@{{ name }}</a>
                <p class="location">@{{ location }}</p>
            </div>
            <button class="btn btn-primary btn-outline @{{ following_status }}" data-toggle="button">
                <i class="fa fa-user-plus visible-xs"></i><span class="hidden-xs">@{{ following_text }}</span>
            </button>
        </div>
        @{{/data}}
    </script>

@endsection