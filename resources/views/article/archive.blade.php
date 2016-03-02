@extends('public')

@section('title', '- Archive')

@section('content')

    <section class="container content-wrapper" data-href="{{ Request::url() }}">
        <div class="data-filter">
            <div class="data">
                <p class="hidden-xs">Data Filter</p>
                <div class="dropdown select">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown-data" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        @if(Input::has('data')) {{ str_replace('-', ' ', ucwords(Input::get('data'))) }} @else All Data @endif
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-data">
                        <li><a href="#" data-value="all-data">All Data</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">CATEGORY</li>
                        @foreach($site_menus as $category)
                            <li><a href="#" data-value="{{ str_slug($category->category) }}">{{ $category->category }}</a></li>
                        @endforeach

                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">HEADLINE</li>
                        <li><a href="#" data-value="trending">Trending</a></li>
                        <li><a href="#" data-value="headline">Headline</a></li>
                        <li><a href="#" data-value="popular">Popular</a></li>
                    </ul>
                </div>
            </div>
            <div class="view hidden-xs">
                <p>View As</p>
                <div class="btn-group" data-toggle="buttons">
                    <?php $list = 'checked'; $grid = '' ?>
                    @if(Input::has('view'))
                        @if(Input::get('view') == 'grid')
                            <?php $grid = 'checked'; $list = '' ?>
                        @else
                            <?php $list = 'checked'; $grid = '' ?>
                        @endif
                    @endif
                    <label class="btn btn-primary @if($list == 'checked') active @endif">
                        <input type="radio" name="view" id="list" value="list" autocomplete="off" {{ $list }}>
                        <i class="fa fa-reorder"></i>
                    </label>
                    <label class="btn btn-primary @if($grid == 'checked') active @endif">
                        <input type="radio" name="view" id="grid" value="grid" autocomplete="off" {{ $grid }}>
                        <i class="fa fa-th"></i>
                    </label>
                </div>
            </div>
            <div class="sort">
                <p class="hidden-xs">Sort By</p>
                <div class="dropdown select by">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown-sort-type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        @if(Input::has('by')) {{ ucwords(Input::get('by')) }} @else Date @endif
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                        <li><a href="#" data-value="date">Date</a></li>
                        <li><a href="#" data-value="title">Title</a></li>
                        <li><a href="#" data-value="star">Star</a></li>
                        <li><a href="#" data-value="view">View</a></li>
                    </ul>
                </div>
                <div class="dropdown select method">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown-sort-method" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        @if(Input::has('sort')) {{ ucwords(Input::get('sort')) }} @else Descending @endif
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort">
                        <li><a href="#" data-value="asc">Ascending</a></li>
                        <li><a href="#" data-value="desc">Descending</a></li>
                        <li><a href="#" data-value="random">Shuffle</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="article-wrapper">
            <div id="articles">
                @forelse($archive as $article)
                    @if(Input::get('view', 'list') == 'list')

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
                                            <li><a href="{{ $article->contributor_ref }}#disqus_thread"></a></li>
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

                    @else

                        <div class="col-md-4 col-sm-6">
                            <div class="article-preview portrait">
                                <div class="featured-image">
                                    <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ $article->featured_ref }}"/>
                                </div>
                                <div class="title-wrapper">
                                    <p class="category"><a href="{{ $article->subcategory_ref }}">{{ $article->subcategory }}</a></p>
                                    <h1 class="title">
                                        <a href="{{ $article->article_ref }}">{{ $article->title }}</a>
                                    </h1>
                                    <ul class="timestamp">
                                        <li>By <a href="{{ $article->contributor_ref }}">{{ $article->username }}</a></li>
                                        <li>{{ $article->published_at }}</li>
                                        <li>{{ $article->view }} Views</li>
                                    </ul>
                                </div>
                                <article>
                                    {{ $article->content }}
                                </article>
                                <div class="rating-wrapper" data-rating="{{ $article->total_rating }}"></div>
                                <ul class="social text-right">
                                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ $article->article_ref }}" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/home?status={{ $article->article_ref }}" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="https://plus.google.com/share?url={{ $article->article_ref }}" class="googleplus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>

                    @endif

                @empty
                    <p class="text-center center-block">No articles available</p>
                @endforelse

            </div>
            <div class="text-center">
                {!! $archive->appends(Input::all())->links() !!}
            </div>
        </div>
    </section>

@endsection