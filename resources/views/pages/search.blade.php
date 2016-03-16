@extends('public')

@section('title', '- Search Result')

@section('content')

    <section class="container">
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="{{ route('article.archive') }}">Archive</a></li>
                <li class="active">SEARCH</li>
                <li class="blank"></li>
            </ol>
            <div class="control">
                <p style="padding: 8px 20px">Search result : <strong>{{ $total_result }} Items found</strong></p>
            </div>
        </div>

        @if(Input::get('filter') != 'article' && isset($contributor_result))
        <div class="panel panel-simple">
            <div class="panel-heading small">{{ $contributor_result->total() }} People Found
                @if(Request::segment(2) == null)
                    <a href="{{ route('search.people') }}?{{ parse_url(Input::fullUrl())['query'] }}" class="pull-right small">View All</a>
                @else
                    <span class="pull-right small">Page {{ $contributor_result->currentPage() }} of {{ $contributor_result->lastPage() }}</span>
                @endif
            </div>
            <div class="panel-body" id="search-contributor">
                <div class="row">
                    @forelse($contributor_result as $contributor)
                        <div class="col-md-3 col-sm-6">
                            <div class="contributor-profile mini">
                                <img src="{{ asset('images/contributors/'.$contributor->avatar) }}" class="avatar img-circle img-responsive" width="80"/>
                                <div class="info">
                                    <button class="btn btn-primary btn-outline pull-right visible-xs visible-sm {{ $contributor->following_status }}" data-toggle="button">{{ $contributor->following_text }}</button>
                                    <a href="{{ route('contributor.stream', [$contributor->username]) }}" class="name">{{ $contributor->name }}</a>
                                    <p class="location">{{ $contributor->location }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center center-block">No result found</p>
                    @endforelse
                </div>
            </div>
            @if($contributor_result->count() < $contributor_result->total() && Request::segment(2) == null)
            <div class="text-center">
                <a class="btn btn-default" href="{{ route('search.people') }}?{{ parse_url(Input::fullUrl())['query'] }}">View All People</a>
            </div>
            @else
                <div class="text-center">
                    {!! $contributor_result->appends(Input::all())->links() !!}
                </div>
            @endif
        </div>
        @endif

        @if(Input::get('filter') != 'contributor' && isset($article_result))
        <div class="panel panel-simple">
            <div class="panel-heading small">{{ $article_result->total() }} Articles Found
                @if(Request::segment(2) == null)
                    <a href="{{ route('search.article') }}?{{ parse_url(Input::fullUrl())['query'] }}" class="pull-right small">View All</a>
                @else
                    <span class="pull-right small">Page {{ $article_result->currentPage() }} of {{ $article_result->lastPage() }}</span>
                @endif
            </div>
            <div class="panel-body"></div>
        </div>

        <div class="article-wrapper">
            @forelse($article_result as $article)
                <div class="article-preview landscape">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="featured-image">
                                <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ $article->featured_ref }}"/>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="title-wrapper">
                                <p class="category"><a href="{{ $article->category_ref }}">{{ $article->category }}</a></p>
                                <h1 class="title">
                                    <a href="{{ $article->article_ref }}">
                                        {{ $article->title }}
                                    </a>
                                </h1>
                                <ul class="timestamp">
                                    <li>By <a href="{{ $article->contributor_ref }}">{{ $article->name }}</a></li>
                                    <li>{{ $article->published_at }}</li>
                                    <li>{{ $article->view }} Views</li>
                                </ul>
                            </div>
                            <article>
                                {{ $article->content }}
                            </article>
                            <div class="rating-wrapper" data-rating="{{ $article->total_rating }}"></div>
                            <ul class="social text-right">
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ route('article.show', [$article->slug]) }}" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://www.twitter.com/home?status={{ route('article.show', [$article->slug]) }}" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://plus.google.com/share?url={{ route('article.show', [$article->slug]) }}" class="googleplus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center center-block">No result found</p>
            @endforelse

            @if($article_result->count() < $article_result->total() && Request::segment(2) == null)
            <div class="text-center">
                <a class="btn btn-default" href="{{ route('search.article') }}?{{ parse_url(Input::fullUrl())['query'] }}">View All Articles</a>
            </div>
            @else
                <div class="text-center">
                    {!! $article_result->appends(Input::all())->links() !!}
                </div>
            @endif
        </div>
        @endif
    </section>

@endsection