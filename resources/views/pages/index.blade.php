@extends('public')

@section('title', '- Home Page')

@section('content')

    <div class="container content-wrapper">
        <div class="featured-wrapper">
            <div class="row">
                <div class="col-md-8">
                    @if($featured->count() > 0)

                        <div class="article-preview featured-large">
                            <div class="featured-image" data-featured="{{ asset('images/featured/'.$featured->first()->featured) }}">
                                <div class="content">
                                    <h4 class="category slide-category">{{ $featured->first()->category }}</h4>
                                    <h3><a href="{{ route('article.show', [$featured->first()->slug]) }}" class="slide-title">{{ $featured->first()->title }}</a></h3>
                                    <p class="slide-description hidden-xs">{{ str_limit(strip_tags($featured->first()->content), 160) }}</p>
                                </div>
                            </div>
                        </div>

                    @endif

                    <div class="featured-list">
                        @forelse($featured as $article)

                            <div class="slide">
                                <div class="article-preview featured-mini active">
                                    <div class="featured-image">
                                        <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ asset('images/featured/'.$article->featured) }}"/>
                                        <div class="category-wrapper">
                                            <h4 class="category"><a href="{{ route('article.category', [str_slug($article->subcategory->category->category)]) }}" class="src-category">{{ $article->subcategory->category->category }}</a></h4>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h4 class="sub-category">{{ $article->subcategory->subcategory }}</h4>
                                        <p><a href="{{ route('article.show', [$article->slug]) }}" class="src-title">{{ str_limit($article->title, 40) }}</a></p>
                                        <p class="hidden src-description">{{ str_limit(strip_tags($article->content), 160) }}</p>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <div class="slide">
                                <div class="article-preview featured-mini active">No Featured</div>
                            </div>
                            <div class="slide">
                                <div class="article-preview featured-mini active">No Featured</div>
                            </div>
                            <div class="slide">
                                <div class="article-preview featured-mini active">No Featured</div>
                            </div>
                            <div class="slide">
                                <div class="article-preview featured-mini active">No Featured</div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#popular" aria-controls="home" role="tab" data-toggle="tab">Most Popular</a>
                        </li>
                        <li role="presentation">
                            <a href="#commented" aria-controls="profile" role="tab" data-toggle="tab">Most Commented</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content featured-news">
                        <div role="tabpanel" class="tab-pane active" id="popular">
                            <ol>
                                <?php $counter = 1; ?>
                                @forelse($popular as $article)

                                    <li>
                                        <a href="{{ route('article.show', [$article->slug]) }}" data-disqus-identifier="{{ 'article_'.$article->id }}">
                                            <p class="number">@if($counter < 10) {{ '0'.$counter  }} @else {{ $counter }} @endif</p>
                                            <p>{{ $article->title }}</p>
                                        </a>
                                    </li>

                                    <?php $counter++; ?>

                                @empty
                                        <li>
                                            <a href="#">
                                                <p>No popular article available</p>
                                            </a>
                                        </li>
                                @endforelse
                            </ol>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="commented">
                            <ol>
                                <?php $counter = 1; ?>
                                @forelse($ranked as $article)

                                    <li>
                                        <a href="{{ route('article.show', [$article->slug]) }}" data-disqus-identifier="{{ 'article_'.$article->id }}">
                                            <p class="number">@if($counter < 10) {{ '0'.$counter  }} @else {{ $counter }} @endif</p>
                                            <p>{{ $article->title }}</p>
                                        </a>
                                    </li>

                                    <?php $counter++; ?>

                                @empty
                                    <li>
                                        <a href="#">
                                            <p>No ranked article available</p>
                                        </a>
                                    </li>
                                @endforelse
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="breadcrumb-wrapper mbs mts">
            <ol class="breadcrumb">
                <li><a href="{{ route('article.trending') }}">Trending</a></li>
                <li class="blank"></li>
                <li class="blank"></li>
            </ol>
            <div class="control">
                <a class="btn btn-primary control-left" href="{{ route('article.trending') }}"><i class="fa fa-chevron-left"></i></a>
                <a class="btn btn-primary control-right" href="{{ route('article.trending') }}"><i class="fa fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="row">
            <?php $counter = 1; ?>
            @forelse($trending as $article)

                <div class="col-md-4 col-sm-6 @if($counter == 4) {{ 'visible-sm visible-xs' }} @endif">
                    <div class="article-preview portrait">
                        <div class="featured-image">
                            <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ asset('images/featured/'.$article->featured) }}"/>
                        </div>
                        <div class="title-wrapper">
                            <p class="category"><a href="{{ route('article.category', [str_slug($article->subcategory->category->category)]) }}">{{ $article->subcategory->category->category }}</a></p>
                            <h1 class="title">
                                <a href="{{ route('article.show', [$article->slug]) }}">{{ $article->title }}</a>
                            </h1>
                            <ul class="timestamp">
                                <li>By <a href="{{ route('contributor.stream', [$article->contributor->username]) }}">{{ $article->contributor->name }}</a></li>
                                <li>@simpledate($article->created_at)</li>
                                <li>{{ $article->view }} Views</li>
                            </ul>
                        </div>
                        <article>{{ str_limit(strip_tags($article->content), 160) }}</article>
                        <div class="rating-wrapper" data-rating="@if($article->rating == null) {{ '0' }} @else {{ $article->rating->total_rating }} @endif"></div>
                        <p class="sub-category"><a href="{{ route('article.subcategory', [str_slug($article->subcategory->category->category), str_slug($article->subcategory->subcategory)]) }}">{{ $article->subcategory->subcategory }}</a></p>
                    </div>
                </div>

                <?php $counter++; ?>

            @empty
                <p class="text-center center-block">No article available</p>
            @endforelse

        </div>

        <div class="breadcrumb-wrapper mbs mts">
            <ol class="breadcrumb">
                <li><a href="{{ route('article.latest') }}">Latest</a></li>
                <li class="blank"></li>
                <li class="blank"></li>
            </ol>
            <div class="control">
                <a class="btn btn-primary control-left" href="{{ route('article.latest') }}"><i class="fa fa-chevron-left"></i></a>
                <a class="btn btn-primary control-right" href="{{ route('article.latest') }}"><i class="fa fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="row">
            <?php $counter = 1; ?>
            @forelse($latest as $article)

                <div class="col-md-4 col-sm-6 @if($counter == 4) {{ 'visible-sm visible-xs' }} @endif">
                    <div class="article-preview portrait">
                        <div class="featured-image">
                            <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ asset('images/featured/'.$article->featured) }}"/>
                        </div>
                        <div class="title-wrapper">
                            <p class="category"><a href="{{ route('article.category', [str_slug($article->subcategory->category->category)]) }}">{{ $article->subcategory->category->category }}</a></p>
                            <h1 class="title">
                                <a href="{{ route('article.show', [$article->slug]) }}">{{ $article->title }}</a>
                            </h1>
                            <ul class="timestamp">
                                <li>By <a href="{{ route('contributor.stream', [$article->contributor->username]) }}">{{ $article->contributor->name }}</a></li>
                                <li>@simpledate($article->created_at)</li>
                                <li>{{ $article->view }} Views</li>
                            </ul>
                        </div>
                        <article>{{ str_limit(strip_tags($article->content), 160) }}</article>
                        <div class="rating-wrapper" data-rating="@if($article->rating == null) {{ '0' }} @else {{ $article->rating->total_rating }} @endif"></div>
                        <p class="sub-category"><a href="{{ route('article.subcategory', [str_slug($article->subcategory->category->category), str_slug($article->subcategory->subcategory)]) }}">{{ $article->subcategory->subcategory }}</a></p>
                    </div>
                </div>

                <?php $counter++; ?>

            @empty
                <p class="text-center center-block">No article available</p>
            @endforelse
        </div>

        <div class="row">
            <div class="col-md-8">
                @if(isset($summary[0]) && $summary[0]->count() > 0)

                <?php $article = $summary[0][0]; ?>
                <div class="tag category">{{ $article->subcategory->category->category }}</div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="article-preview portrait">
                            <div class="featured-image">
                                <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ asset('images/featured/'.$article->featured) }}"/>
                            </div>
                            <div class="title-wrapper">
                                <p class="category"><a href="{{ route('article.category', [str_slug($article->subcategory->category->category)]) }}">{{ $article->subcategory->category->category }}</a></p>
                                <h1 class="title">
                                    <a href="{{ route('article.show', [$article->slug]) }}">{{ $article->title }}</a>
                                </h1>
                                <ul class="timestamp">
                                    <li>By <a href="{{ route('contributor.stream', [$article->contributor->username]) }}">{{ $article->contributor->name }}</a></li>
                                    <li>@fulldate($article->created_at)</li>
                                    <li>{{ $article->view }} Views</li>
                                </ul>
                            </div>
                            <article>{{ str_limit(strip_tags($article->content), 160) }}</article>
                            <div class="rating-wrapper" data-rating="@if($article->rating == null) {{ '0' }} @else {{ $article->rating->total_rating }} @endif"></div>
                            <p class="sub-category"><a href="{{ route('article.subcategory', [str_slug($article->subcategory->category->category), str_slug($article->subcategory->subcategory)]) }}">{{ $article->subcategory->subcategory }}</a></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        @if($summary[0]->count() > 1)

                            @for($i = 1; $i < $summary[0]->count(); $i++)

                                <?php $article = $summary[0][$i]; ?>

                                <div class="article-preview landscape mini">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-4">
                                            <div class="featured-image">
                                                <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ asset('images/featured/'.$article->featured) }}"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-7 col-xs-8">
                                            <div class="title-wrapper">
                                                <h1 class="title">
                                                    <a href="{{ route('article.show', [$article->slug]) }}">{{ $article->title }}</a>
                                                </h1>
                                                <ul class="timestamp">
                                                    <li>@fulldate($article->created_at)</li>
                                                    <li>{{ $article->view }} Views</li>
                                                </ul>
                                            </div>
                                            <div class="rating-wrapper" data-rating="@if($article->rating == null) {{ '0' }} @else {{ $article->rating->total_rating }} @endif"></div>
                                        </div>
                                    </div>
                                </div>

                            @endfor

                        @endif

                    </div>
                </div>

                @else
                    <p class="text-center center-block">No article available</p>
                @endif



                <div class="row">
                    <div class="col-md-6">
                        @if(isset($summary[1]) && $summary[1]->count() > 0)

                            <?php $article = $summary[1][0]; ?>
                            <div class="tag category">{{ $article->subcategory->category->category }}</div>
                            <div class="row">
                                <div class="col-md-12 col-sm-6 mbm">
                                    <div class="article-preview portrait">
                                        <div class="featured-image">
                                            <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ asset('images/featured/'.$article->featured) }}"/>
                                            <div class="category-wrapper">
                                                <p class="sub-category"><a href="{{ route('article.subcategory', [str_slug($article->subcategory->category->category), str_slug($article->subcategory->subcategory)]) }}">{{ $article->subcategory->subcategory }}</a></p>
                                                <div class="rating-wrapper" data-rating="@if($article->rating == null) {{ '0' }} @else {{ $article->rating->total_rating }} @endif"></div>
                                            </div>
                                        </div>
                                        <div class="title-wrapper">
                                            <h1 class="title">
                                                <a href="{{ route('article.show', [$article->slug]) }}">{{ $article->title }}</a>
                                            </h1>
                                            <ul class="timestamp">
                                                <li>By <a href="{{ route('contributor.stream', [$article->contributor->username]) }}">{{ $article->contributor->name }}</a></li>
                                                <li>@simpledate($article->created_at)</li>
                                                <li>{{ $article->view }} Views</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">

                                    @if($summary[1]->count() > 1)

                                        @for($i = 1; $i < 4; $i++)

                                            <?php $article = $summary[1][$i]; ?>

                                            <div class="article-preview landscape mini">
                                                <div class="row">
                                                    <div class="col-sm-5 col-xs-4">
                                                        <div class="featured-image">
                                                            <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ asset('images/featured/'.$article->featured) }}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7 col-xs-8">
                                                        <div class="title-wrapper">
                                                            <h1 class="title">
                                                                <a href="{{ route('article.show', [$article->slug]) }}">{{ $article->title }}</a>
                                                            </h1>
                                                            <ul class="timestamp">
                                                                <li>@fulldate($article->created_at)</li>
                                                                <li>{{ $article->view }} Views</li>
                                                            </ul>
                                                        </div>
                                                        <div class="rating-wrapper" data-rating="@if($article->rating == null) {{ '0' }} @else {{ $article->rating->total_rating }} @endif"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endfor

                                    @endif

                                </div>
                            </div>
                        @else
                            <p class="text-center center-block">No article available</p>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if(isset($summary[2]) && $summary[2]->count() > 0)

                            <?php $article = $summary[2][0]; ?>
                            <div class="tag category">{{ $article->subcategory->category->category }}</div>
                            <div class="row">
                                <div class="col-md-12 col-sm-6 mbm">
                                    <div class="article-preview portrait">
                                        <div class="featured-image">
                                            <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ asset('images/featured/'.$article->featured) }}"/>
                                            <div class="category-wrapper">
                                                <p class="sub-category"><a href="{{ route('article.subcategory', [str_slug($article->subcategory->category->category), str_slug($article->subcategory->subcategory)]) }}">{{ $article->subcategory->subcategory }}</a></p>
                                                <div class="rating-wrapper" data-rating="@if($article->rating == null) {{ '0' }} @else {{ $article->rating->total_rating }} @endif"></div>
                                            </div>
                                        </div>
                                        <div class="title-wrapper">
                                            <h1 class="title">
                                                <a href="{{ route('article.show', [$article->slug]) }}">{{ $article->title }}</a>
                                            </h1>
                                            <ul class="timestamp">
                                                <li>By <a href="{{ route('contributor.stream', [$article->contributor->username]) }}">{{ $article->contributor->name }}</a></li>
                                                <li>@simpledate($article->created_at)</li>
                                                <li>{{ $article->view }} Views</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">

                                    @if($summary[2]->count() > 1)

                                        @for($i = 1; $i < 4; $i++)

                                            <?php $article = $summary[2][$i]; ?>

                                            <div class="article-preview landscape mini">
                                                <div class="row">
                                                    <div class="col-sm-5 col-xs-4">
                                                        <div class="featured-image">
                                                            <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ asset('images/featured/'.$article->featured) }}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-7 col-xs-8">
                                                        <div class="title-wrapper">
                                                            <h1 class="title">
                                                                <a href="{{ route('article.show', [$article->slug]) }}">{{ $article->title }}</a>
                                                            </h1>
                                                            <ul class="timestamp">
                                                                <li>@fulldate($article->created_at)</li>
                                                                <li>{{ $article->view }} Views</li>
                                                            </ul>
                                                        </div>
                                                        <div class="rating-wrapper" data-rating="@if($article->rating == null) {{ '0' }} @else {{ $article->rating->total_rating }} @endif"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endfor

                                    @endif

                                </div>
                            </div>
                        @else
                            <p class="text-center center-block">No article available</p>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                @if(isset($summary[3]) && $summary[3]->count() > 0)
                    <?php $article = $summary[3][0]; ?>
                    <div class="tag category">{{ $article->subcategory->category->category }}</div>
                    <div class="row">
                        <div class="col-md-12 col-sm-6">
                            <div class="article-preview portrait">
                                <div class="featured-image">
                                    <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ asset('images/featured/'.$article->featured) }}"/>
                                </div>
                                <div class="title-wrapper">
                                    <p class="category"><a href="{{ route('article.category', [str_slug($article->subcategory->category->category)]) }}">{{ $article->subcategory->category->category }}</a></p>
                                    <h1 class="title">
                                        <a href="{{ route('article.show', [$article->slug]) }}">{{ $article->title }}</a>
                                    </h1>
                                    <ul class="timestamp">
                                        <li>By <a href="{{ route('contributor.stream', [$article->contributor->username]) }}">{{ $article->contributor->name }}</a></li>
                                        <li>@fulldate($article->created_at)</li>
                                        <li>{{ $article->view }} Views</li>
                                    </ul>
                                </div>
                                <article>{{ str_limit(strip_tags($article->content), 160) }}</article>
                                <div class="rating-wrapper" data-rating="@if($article->rating == null) {{ '0' }} @else {{ $article->rating->total_rating }} @endif"></div>
                                <p class="sub-category"><a href="{{ route('article.subcategory', [str_slug($article->subcategory->category->category), str_slug($article->subcategory->subcategory)]) }}">{{ $article->subcategory->subcategory }}</a></p>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            @if($summary[2]->count() > 1)

                                @for($i = 1; $i < $summary[3]->count(); $i++)

                                    <?php $article = $summary[3][$i]; ?>

                                    <div class="article-preview landscape mini">
                                        <div class="row">
                                            <div class="col-sm-5 col-xs-4">
                                                <div class="featured-image">
                                                    <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ asset('images/featured/'.$article->featured) }}"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-7 col-xs-8">
                                                <div class="title-wrapper">
                                                    <h1 class="title">
                                                        <a href="{{ route('article.show', [$article->slug]) }}">{{ $article->title }}</a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>@fulldate($article->created_at)</li>
                                                        <li>{{ $article->view }} Views</li>
                                                    </ul>
                                                </div>
                                                <div class="rating-wrapper" data-rating="@if($article->rating == null) {{ '0' }} @else {{ $article->rating->total_rating }} @endif"></div>
                                            </div>
                                        </div>
                                    </div>

                                @endfor

                            @endif
                        </div>
                    </div>

                @else
                    <p class="text-center center-block">No article available</p>
                @endif

                <div class="tag category">Advertisement</div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="http://angga-ari.com" target="_blank">
                            <h3>New Macbook Air Just $1200</h3>
                            <p>KeepShop.id is selling new the product of apple mid 2016 Macbook Air Core i5 4 GB of
                                RAM</p>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="http://angga-ari.com" target="_blank">
                            <h3>The Most Advanced Technology</h3>
                            <p>We provide internet for your office, home, and education purpose with full guarantee
                                and services</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mobile mtl" data-stellar-background-ratio="0.3">
        <div class="container">
            <h2>Keep in touch with us</h2>
            <h1>MOBILE EVERYWHERE</h1>
            <p class="lead">Don't be nerd and keep up-to date with your handheld</p>
            <p class="mbm mtl">Available on Android and iOS, so hurry get it now on:</p>
            <a class="btn btn-outline btn-light btn-mobile" href="http://play.google.com" target="_blank">
                <i class="fa fa-android"></i>
                <h3>ANDROID</h3>
                <p>PLAY STORE</p>
            </a>
            <a class="btn btn-outline btn-light btn-mobile" href="http://itunes.apple.com" target="_blank">
                <i class="fa fa-apple"></i>
                <h3>APPLE iOS</h3>
                <p>APP STORE</p>
            </a>
            <img src="{{ asset('/images/misc/mobile.png') }}" class="hidden-xs" alt="Mobile Application" data-stellar-ratio="1.45"/>
        </div>
    </div>

    <div class="container">
        <div class="section">
            <div class="title">
                <h1>SUPPORTED BY</h1>
                <p class="lead">InfoGue.id was supported by awesome startup and company</p>
            </div>
            <ul class="company-list">
                <li><a href="http://www.google.com?q=mountain" target="_blank">
                        <img src="{{ asset('/images/misc/mountain.png') }}" alt="Sleeping Mountain"/></a>
                </li>
                <li><a href="http://www.google.com?q=redcode" target="_blank">
                        <img src="{{ asset('/images/misc/redcode.png') }}" alt="Redcode Deliver"/></a>
                </li>
                <li><a href="http://www.google.com?q=vana" target="_blank">
                        <img src="{{ asset('/images/misc/vana.png') }}" alt="Vana Internet Provider"/></a>
                </li>
                <li><a href="http://www.google.com?q=express" target="_blank">
                        <img src="{{ asset('/images/misc/express.png') }}" alt="Express"/></a>
                </li>
                <li><a href="http://www.google.com?q=magnive" target="_blank">
                        <img src="{{ asset('/images/misc/magnive.png') }}" alt="Magnive"/></a>
                </li>
                <li><a href="http://www.google.com?q=frezze" target="_blank">
                        <img src="{{ asset('/images/misc/frezze.png') }}" alt="Frezzer"/></a>
                </li>
                <li><a href="http://www.google.com?q=bluewave" target="_blank">
                        <img src="{{ asset('/images/misc/bluewave.png') }}" alt="Bluewave"/></a>
                </li>
                <li><a href="http://www.google.com?q=smiles" target="_blank">
                        <img src="{{ asset('/images/misc/smiles.png') }}" alt="Smiles"/></a>
                </li>
            </ul>
        </div>
    </div>


    <div class="modal fade newsletter no-line" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">INFOGUE.ID</h4>
                </div>
                <div class="modal-body">
                    <h1 class="hidden-xs"><i class="fa fa-envelope-o mbs"></i></h1>
                    <h3>ENTER YOUR EMAIL AND GET</h3>
                    <h1>NEWSLETTER</h1>
                    <P>Subscribe to our Newsletter and receive knowledge everyday</P>
                    <form action="#">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary subscribe"><i class="fa fa-envelope-o visible-xs"></i><span class="hidden-xs">SUBSCRIBE</span></button>
                            <input type="email" class="form-control" placeholder="EMAIL ADDRESS"/>
                        </div>
                    </form>
                    <a href="#" data-dismiss="modal" class="dismiss">NO THANKS</a>
                    <p class="small">We Promise don't spam<span class="hidden-xs"> and use your email for weird purpose</span></p>
                    <p class="small">See our policy at <a href="{{ url('term') }}">Terms</a> and <a href="{{ url('privacy') }}">Privacy</a></p>
                </div>
                <div class="modal-footer">
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection