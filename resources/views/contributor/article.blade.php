@extends('public')

@section('title', '- My Article')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper" data-href="{{ Request::url() }}">
            <div class="row">

                @include('contributor._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data">
                                <h3 class="title">ARTICLE</h3>
                                <div class="data-filter mbn">
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
                                <div class="content">
                                    @include('errors.common')

                                    @if(Session::has('status'))
                                        <div class="alert alert-{{ Session::get('status') }}" style="border-radius: 0">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            {!! Session::get('message') !!}
                                        </div>
                                    @endif
                                    <div>
                                        @forelse($articles as $article)
                                            <div class="article-preview landscape mini" style="height: 180px">
                                                <div class="row">
                                                    <div class="col-sm-4 col-xs-5">
                                                        <div class="featured-image">
                                                            <img src="{{ asset('images/misc/preloader.gif') }}" alt="{{ $article->featured }}" data-echo="{{ $article->featured_ref }}"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-8 col-xs-7">
                                                        <div class="title-wrapper">
                                                            <p class="category hidden-xs"><a href="{{ $article->category_ref }}">{{ $article->category }}</a></p>
                                                            <h1 class="title">
                                                                <a href="{{ $article->article_ref }}">
                                                                    {{ $article->title }}
                                                                </a>
                                                            </h1>
                                                            <ul class="timestamp">
                                                                <li>Extreme Sport</li>
                                                                <li>{{ $article->published_at }}</li>
                                                                <li class="hidden-xs">{{ $article->view }} Views</li>
                                                            </ul>
                                                        </div>
                                                        <div class="rating-wrapper" data-rating="2" style="padding: 0 0 5px"></div>

                                                        <div class="text-right control">
                                                            <div class="dropdown" data-id="{{ $article->id }}" data-url="{{ route('article.show', [$article->slug]) }}">
                                                                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    ACTION
                                                                    <span class="caret"></span>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                                                    <li class="dropdown-header">CONTROL</li>
                                                                    <li><a href="{{ route('article.show', [$article->slug]) }}"><i class="fa fa-eye"></i> View</a></li>
                                                                    <li><a href="{{ route('account.article.edit', [$article->slug]) }}"><i class="fa fa-pencil"></i> Edit</a></li>
                                                                    <li><a href="#" data-toggle="modal" data-target="#modal-delete" data-label="{{ $article->title }}" class="btn-delete"><i class="fa fa-trash"></i> Delete</a></li>
                                                                    <li class="dropdown-header">QUICK ACTION</li>
                                                                    @if($article->status == 'published')
                                                                    <li><a href="#" class="btn-draft"><i class="fa fa-edit"></i> Set as Draft</a></li>
                                                                    @endif
                                                                    <li><a href="#" data-toggle="modal" data-target="#modal-share" class="btn-share"><i class="fa fa-share-alt"></i> Share</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        <div style="display: block; clear: both;">
                                                            @if($article->status == 'published')
                                                                <span class="label label-success" style="font-size: 11px">PUBLISHED</span>
                                                            @elseif($article->status == 'pending')
                                                                <span class="label label-warning" style="font-size: 11px">PENDING @if($article->content_update != '') {{ 'UPDATE' }}@endif</span>
                                                            @elseif($article->status == 'reject')
                                                                <span class="label label-danger" style="font-size: 11px">REJECT</span>
                                                            @elseif($article->status == 'draft')
                                                                <span class="label label-info" style="font-size: 11px">DRAFT</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-center center-block pm">No articles available, <a href="{{ route('account.article.create') }}">create</a> now?</p>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="text-center">
                                    {!! $articles->appends(Input::all())->links() !!}
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade no-line" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" data-url="{{ url('account/article/') }}" method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-trash"></i> DELETE ARTICLE</h4>
                    </div>
                    <div class="modal-body">
                        <label class="mbn">Are you sure delete the <span class="delete-title text-danger"></span>?</label>
                        <p class="mbn"><small class="text-muted">All related data will be deleted.</small></p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-primary">CANCEL</a>
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade no-line" id="modal-share" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">SHARE ARTICLE</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label"><strong>COPY URL</strong></label>
                        <input type="url" class="form-control copy-url" readonly value="http://infogue.com/article/sdfas2323">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><strong>SHARE ON</strong></label>
                        <ul class="social">
                            <li><a href="https://www.facebook.com/sharer/sharer.php?u=#" class="facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.twitter.com/home?status=#" class="twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://plus.google.com/share?url=#" class="googleplus" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <form action="#" method="post" data-url="{{ url('account/article/draft') }}" id="form-draft">
        {!! csrf_field() !!}
        <input type="hidden" name="_method" value="PATCH">
    </form>

@endsection