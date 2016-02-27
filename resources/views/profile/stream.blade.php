@extends('public')

@section('title', '- Imelda Agustine')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="breadcrumb-wrapper hidden-xs">
                <ol class="breadcrumb mtn">
                    <li><a href="{{ route('article.archive') }}">Archive</a></li>
                    <li><a href="contributor.html">Contributor</a></li>
                    <li class="active">{{ $contributor->name }}</li>
                </ol>
            </div>

            <div class="row">

                @include('profile._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="cover" style="background: url('{{ asset('images/covers/'.$contributor->cover) }}') no-repeat center / cover"></div>
                        <div class="profile-wrapper">

                            @include('profile._profile')

                            <section class="list-data" data-href="{{ Request::url() }}">
                                <h3 class="title">STREAM</h3>
                                <div class="content" id="stream">

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

    <script id="article-landscape-template" type="text/template">
        @{{#data}}
        <div class="article-preview landscape mini">
            <div class="row">
                <div class="col-sm-4 col-xs-5">
                    <div class="featured-image">
                        <img src="{{ asset('images/misc/preloader.gif') }}" alt="@{{ featured }}" data-echo="@{{ featured_ref }}"/>
                    </div>
                </div>
                <div class="col-sm-8 col-xs-7">
                    <div class="title-wrapper">
                        <p class="category hidden-xs"><a href="@{{ subcategory_ref }}">@{{ subcategory }}</a></p>
                        <h1 class="title">
                            <a href="@{{ article_ref }}">@{{ title }}</a>
                        </h1>
                        <ul class="timestamp">
                            <li>By <a href="@{{ contributor_ref }}">@{{ username }}</a></li>
                            <li>@{{ published_at }}</li>
                            <li class="hidden-xs">@{{ view }} Views</li>
                        </ul>
                    </div>
                    <div class="rating-wrapper" data-rating="@{{ total_rating }}">@{{ rating }}</div>
                    <ul class="social text-right">
                        <li><a href="https://www.facebook.com/sharer/sharer.php?u=@{{ article_ref }}" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://www.twitter.com/home?status=@{{ article_ref }}" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://plus.google.com/share?url=@{{ article_ref }}" class="googleplus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        @{{/data}}
    </script>

@endsection