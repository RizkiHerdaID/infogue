@extends('public')

@section('title', '- '.$article->title)

@section('content')

    <section class="container content-wrapper">
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <?php $counter = 1; $length = count($breadcrumb); $class=""; ?>
                @foreach($breadcrumb as $list => $uri)

                    @if($counter == 2) <?php $class = "class='hidden-xs'" ?> @endif
                    @if($counter == 2 && $counter == $length) <?php $class = "class='hidden-xs active'" ?> @endif

                    <li {!! $class !!}>
                        <a href="{{ $uri }}">{{ $list }}</a>
                    </li>

                    <?php $counter++ ?>
                @endforeach

                @if($counter <= 3)

                    @for($i = $counter; $i <= 3; $i++)

                        <li class="blank"></li>

                    @endfor

                @endif
            </ol>
            <div class="control hidden-xs">
                <a class="btn btn-primary control-left" href="{{ $prev_ref }}"><i class="fa fa-chevron-left"></i></a>
                <a class="btn btn-primary control-right" href="{{ $next_ref }}"><i class="fa fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="article-wrapper">
            <div class="row">
                <div class="col-md-8">
                    <div class="article-preview single-view" data-id="{{ $article->id }}">
                        <div class="featured-image">
                            <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ asset('images/featured/'.$article->featured) }}"/>
                        </div>
                        <div class="title-wrapper">
                            <p class="category"><a href="{{ route('article.category', [str_slug($article->subcategory->category->category)]) }}">{{ $article->subcategory->category->category }}</a></p>
                            <h1 class="title">
                                <a href="{{ route('article.show', [$article->slug]) }}">{{ $article->title }}</a>
                            </h1>
                            <div class="timestamp-wrapper">
                                <ul class="timestamp">
                                    <li><img src="{{ asset('images/contributors/'.$article->contributor->avatar) }}" class="avatar img-circle"/> By <a href="{{ route('contributor.stream', [$article->contributor->username]) }}">{{ $article->contributor->name }}</a></li>
                                    <li>@fulldate($article->created_at)</li>
                                    <li>{{ $article->view }} Views</li>
                                    <li><span class="disqus-comment-count" data-disqus-url="{{ Request::url() }}"> <!-- Count will be inserted here --> </span></li>
                                </ul>
                                <ul class="social text-right hidden-xs">
                                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ route('article.show', [$article->slug]) }}" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/home?status={{ route('article.show', [$article->slug]) }}" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="https://plus.google.com/share?url={{ route('article.show', [$article->slug]) }}" class="googleplus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <article>
                            {!! $article->content !!}
                        </article>

                        @if(trim($article->excerpt) != "")
                        <div class="excerpt">
                            {{ $article->excerpt }}
                        </div>
                        @endif

                        <div class="panel panel-simple">
                            <div class="panel-heading">Like This Article?</div>
                            <div class="panel-body">
                                <div class="rating">
                                    <?php $ratingMessage = ['WORST', 'BAD', 'GOOD', 'EXCELLENT', 'GREAT']; $ratingTotal = ($article->rating()->count() == null) ? 0 : $article->rating->total_rating; ?>
                                    <p class="pull-left pts pbs mrm"><strong>GIVE A RATING</strong></p>
                                    <div class="rating-wrapper control" data-rating="{{ $ratingTotal }}"></div>
                                    <span class="rate-message">@if($ratingTotal > 0){{ $ratingMessage[$ratingTotal-1] }}@endif</span>
                                </div>
                                <ul class="social text-right">
                                    <li><strong class="mrs">SHARE ON</strong></li>
                                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ route('article.show', [$article->slug]) }}" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="https://www.twitter.com/home?status={{ route('article.show', [$article->slug]) }}" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="https://plus.google.com/share?url={{ route('article.show', [$article->slug]) }}" class="googleplus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel panel-simple">
                            <div class="panel-heading">About The Author</div>
                            <div class="panel-body">
                                <div class="contributor-profile">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <img src="{{ $author->avatar_ref }}" class="img-circle avatar"/>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-9">
                                                    <a href="{{ $author->contributor_ref }}" class="name">{{ $author->name }}</a>
                                                    <p class="location">{{ $article->contributor->location }}</p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <button class="btn btn-primary btn-outline {{ $author->following_status }}" data-toggle="button">{{ $author->following_text }}</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="about">{{ $author->about }} <a href="{{ route('contributor.stream', [$author->username]) }}">MORE</a></p>
                                                    <ul class="statistic list-separated">
                                                        <li><a href="{{ route('contributor.article', [$author->username]) }}">{{ $author->articles()->where('status', 'published')->count() }} ARTICLE</a></li>
                                                        <li><a href="{{ route('contributor.following', [$author->username]) }}">{{ $author->following()->count() }} FOLLOWING</a></li>
                                                        <li><a href="{{ route('contributor.follower', [$author->username]) }}">{{ $author->followers()->count() }} FOLLOWERS</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-simple">
                            <div class="panel-heading">Article By Author</div>
                            <div class="panel-body">
                                <div class="row">
                                    @forelse($author->articles()->where('status', 'published')->where('slug', '!=', $article->slug)->orderBy('created_at', 'desc')->take(3)->get() as $contributor_article)
                                        <div class="col-sm-4">
                                            <div class="article-preview portrait mini">
                                                <div class="featured-image">
                                                    <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $contributor_article->featured }}" data-echo="{{ asset('images/featured/'.$contributor_article->featured) }}"/>
                                                </div>
                                                <div class="title-wrapper">
                                                    <p class="category"><a href="{{ route('article.category', [str_slug($contributor_article->subcategory->category->category)]) }}">{{ $contributor_article->subcategory->category->category }}</a></p>
                                                    <h1 class="title">
                                                        <a href="{{ route('article.show', [$contributor_article->slug]) }}">{{ $contributor_article->title }}</a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>@fulldate($contributor_article->created_at)</li>
                                                        <li>{{ $contributor_article->view }} Views</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-center center-block">No articles available</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-simple">
                            <div class="panel-heading">Leave a Comment</div>
                            <div class="panel-body" id="comment-info" data-link="{{ Request::url() }}" data-identity="{{ 'article_'.$article->id }}">

                                <form action="{{ route("account.article.comment", [$article->slug]) }}" method="post" id="form-comment" class="mts">
                                    {!! csrf_field() !!}

                                    @include('errors.common')

                                    @if(Session::has('status'))
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="alert alert-{{ Session::get('status') }}">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    {!! '<p>'.Session::get('message').'</p>' !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(Auth::check())
                                        <?php $commentAble = true; ?>
                                        <div class="mbm">
                                            <img width="50" height="50" class="img-circle pull-left"
                                                 style="background: url('{{ asset('images/contributors/'.Auth::user()->avatar) }}') center center / cover;">
                                            <div style="margin-left: 70px">
                                                <p style="margin-bottom: 5px; font-size: 1em; font-weight: bold"><a href="{{ route('contributor.stream', [Auth::user()->location]) }}">{{ Auth::user()->name }}</a></p>
                                                <p class="mts">{{ Auth::user()->location }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <?php $commentAble = false; ?>
                                        <p class="sub-category">Please Sign in or Register</p>
                                        <p class="mbs">Authorization is needed to leave embedded comment, or use alternative comment with <strong>Disqus</strong> below.</p>
                                        <div class="mbs">
                                            <a href="{{ route("login.form") }}" class="btn btn-primary">LOGIN</a>
                                            <a href="{{ route("register.form") }}" class="btn btn-success">REGISTER</a>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-lg-10">
                                            <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                                                <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Type Your Comment" required maxlength="2000" @if(!$commentAble) {{ 'disabled' }} @endif>{{ old('comment') }}</textarea>
                                                {!! $errors->first('comment', '<span class="help-block">:message</span>') !!}
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary" @if(!$commentAble) {{ 'disabled' }} @endif>SUBMIT COMMENT</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="mtm mbl">
                                    @foreach($comments as $comment)
                                        <div class="mbm">
                                            <img width="50" height="50" class="img-circle pull-left"
                                                 style="background: url('{{ asset('images/contributors/'.$comment->contributor->avatar) }}') center center / cover;">
                                            <div style="margin-left: 70px">
                                                <p style="margin-bottom: 5px; font-size: 1em; font-weight: bold"><a href="{{ route('contributor.stream', [$comment->contributor->username]) }}">{{ $comment->contributor->name }}</a></p>
                                                <time class="timeago text-muted" datetime="{{ $comment->created_at }}">{{ $comment->created_at }}</time>
                                                <p class="mts">{{ $comment->comment }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div id="disqus_thread"></div>
                                <script>
                                     var disqus_config = function () {
                                     this.page.url = document.getElementById('comment-info').getAttribute("data-link"); // Replace PAGE_URL with your page's canonical URL variable
                                     this.page.identifier = document.getElementById('comment-info').getAttribute("data-identity"); // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                                     //console.log(this.page.identifier);
                                    };

                                    (function() { // DON'T EDIT BELOW THIS LINE
                                        var d = document, s = d.createElement('script');

                                        s.src = '//info-gue.disqus.com/embed.js';

                                        s.setAttribute('data-timestamp', +new Date());
                                        (d.head || d.body).appendChild(s);
                                    })();
                                </script>
                                <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-4 sidebar">
                    <div class="mbl">
                        <div class="tag category mtn">Related Article</div>
                        <div class="row">
                            @forelse($related as $related_article)
                                <div class="col-md-12 col-sm-6">
                                    <div class="article-preview landscape mini">
                                        <div class="row">
                                            <div class="col-sm-5 col-xs-4">
                                                <div class="featured-image">
                                                    <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $related_article->featured }}" data-echo="{{ asset('images/featured/'.$related_article->featured) }}"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-7 col-xs-8">
                                                <div class="title-wrapper">
                                                    <h1 class="title">
                                                        <a href="{{ route('article.show', [$related_article->slug]) }}">{{ $related_article->title }}</a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>@fulldate($related_article->created_at)</li>
                                                        <li>{{ $related_article->view }} Views</li>
                                                    </ul>
                                                </div>
                                                <div class="rating-wrapper" data-rating="@if($related_article->rating()->count() == null) {{ '0' }} @else {{ $related_article->rating->total_rating }} @endif"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center center-block">No related article available</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="mbl">
                        <div class="tag category mtn">Tags</div>
                        <ul class="list-inline">
                            @forelse($tags as $tag)
                                <li><a class="tag" href="{{ route('article.tag', [str_slug($tag->tag)]) }}">{{ $tag->tag }}</a></li>
                            @empty
                                <p class="text-center center-block">No tags available</p>
                            @endforelse
                        </ul>
                    </div>

                    <div class="mbl">
                        <div class="tag category mtn">Popular Article</div>
                        <div class="row">
                            @forelse($popular as $popular_article)
                                <div class="col-md-12 col-sm-6">
                                    <div class="article-preview portrait">
                                        <div class="featured-image">
                                            <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $popular_article->featured }}" data-echo="{{ asset('images/featured/'.$popular_article->featured) }}"/>
                                        </div>
                                        <div class="title-wrapper">
                                            <p class="category"><a href="{{ route('article.category', [str_slug($popular_article->category)]) }}">{{ $article->category }}</a></p>
                                            <h1 class="title">
                                                <a href="{{ route('article.show', [$popular_article->slug]) }}">{{ $popular_article->title }}</a>
                                            </h1>
                                            <ul class="timestamp">
                                                <li>By <a href="{{ $popular_article->contributor_ref }}">{{ $popular_article->name }}</a></li>
                                                <li>@fulldate($popular_article->created_at)</li>
                                                <li>{{ $popular_article->view }} Views</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center center-block">No popular article available</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection