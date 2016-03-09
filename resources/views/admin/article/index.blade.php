@extends('private')

@section('title', '- Articles')

@section('content')

    <div id="content-wrapper">
        <header>
            <a href="#menu-toggle" class="toggle-nav"><i class="fa fa-bars"></i></a>
            <div class="title">
                <h1>Article</h1>
            </div>
            <div class="control hidden-xs">
                <div class="account clearfix">
                    <div class="avatar-wrapper">
                        <img src="{{ asset('images/contributors/'.Auth::guard('admin')->user()->avatar) }}" class="img-circle img-rounded">
                        <div class="notify"></div>
                    </div>
                    <p class="avatar-greeting pull-left hidden-sm">Hi, <strong>{{ Auth::guard('admin')->user()->name }}</strong></p>
                </div>
                <a href="{{ route('admin.login.destroy') }}" class="sign-out"><i class="fa fa-sign-out"></i> SIGN OUT</a>
            </div>
        </header>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="{{ route('index') }}" target="_blank">INFOGUE.ID</a></li>
                <li class="hidden-xs hidden-sm"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="active">Article</li>
            </ol>
            <div class="control">
                <a href="#" data-toggle="modal" data-target="#modal-search" class="link"><i class="fa fa-search"></i> SEARCH</a>
                <a href="{{ route('admin.article.create') }}" class="link visible-xs"><i class="fa fa-plus"></i> CREATE ARTICLE</a>
                <a href="#" class="link print"><i class="fa fa-print"></i> PRINT</a>
            </div>
        </div>
        <div class="content" id="content">
            <div class="title-section">
                <div class="title-wrapper">
                    <h1 class="title">Article</h1>
                    <p class="subtitle">List of people post</p>
                </div>
                <div class="control">
                    <div class="filter">
                        <div class="dropdown select data">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                @if(Input::has('data') && Input::get('data') != 'all')
                                    {{ str_replace('-', ' ', strtoupper(Input::get('data'))) }}
                                @else
                                    ALL DATA
                                @endif
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdown-data">
                                <li><a href="#"><i class="fa fa-navicon"></i>All Data</a></li>
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
                        <div class="dropdown select status">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                @if(Input::has('status') && Input::get('status') != 'all')
                                    {{ strtoupper(Input::get('status')) }}
                                @else
                                    ALL STATUS
                                @endif
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                <li class="dropdown-header">ARTICLE STATUS</li>
                                <li><a href="#"><i class="fa fa-signal"></i>All Status</a></li>
                                <li><a href="#"><i class="fa fa-info-circle"></i>Pending</a></li>
                                <li><a href="#"><i class="fa fa-file-text-o"></i>Published</a></li>
                                <li><a href="#"><i class="fa fa-file-o"></i>Draft</a></li>
                                <li><a href="#"><i class="fa fa-remove"></i>Reject</a></li>
                            </ul>
                        </div>
                        <div class="dropdown select by">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                @if(Input::has('by'))
                                    {{ strtoupper(Input::get('by')) }}
                                @else
                                    TIMESTAMP
                                @endif
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                <li class="dropdown-header">SORT BY</li>
                                <li><a href="#"><i class="fa fa-calendar"></i>Date</a></li>
                                <li><a href="#"><i class="fa fa-font"></i>Title</a></li>
                                <li><a href="#"><i class="fa fa-user"></i>Author</a></li>
                                <li><a href="#"><i class="fa fa-eye"></i>View</a></li>
                                <li><a href="#"><i class="fa fa-trophy"></i>Popularity</a></li>
                            </ul>
                        </div>
                        <div class="dropdown select method">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                @if(Input::has('sort'))
                                    @if(Input::get('sort') == 'asc')
                                        ASCENDING
                                    @else
                                        DESCENDING
                                    @endif
                                @else
                                    DESCENDING
                                @endif
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                <li class="dropdown-header">METHOD</li>
                                <li><a href="#"><i class="fa fa-arrow-up"></i>Ascending</a></li>
                                <li><a href="#"><i class="fa fa-arrow-down"></i>Descending</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="group-control">
                        <a href="#" data-toggle="modal" data-target="#modal-delete" class="btn btn-danger btn-sm btn-delete all"><i class="fa fa-trash"></i> DELETE</a>
                        <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> APPROVE</a>
                    </div>
                </div>
            </div>
            @include('errors.common')
            @if(Session::has('status'))
                <div class="alert alert-{{ Session::get('status') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {!! Session::get('message') !!}
                </div>
            @endif
            <div class="content-section">
                <table class="table table-responsive table-striped table-hover table-condensed mbs">
                    <thead>
                    <tr>
                        <th width="40">
                            <div class="checkbox">
                                <input type="checkbox" name="check-all" id="check-all" class="css-checkbox">
                                <label for="check-all" class="css-label"></label>
                            </div>
                        </th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>View</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>State</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($articles as $article)
                        <tr data-id="{{ $article->id }}" data-article-ref="{{ $article->article_ref }}" data-title="{{ $article->title }}" data-category="{{ $article->category }}" data-subcategory="{{ $article->subcategory }}" data-category-ref="{{ $article->category_ref }}" data-subcategory-ref="{{ $article->subcategory_ref }}" data-timestamp="@datetime($article->created_at)" data-avatar="{{ $article->avatar_ref }}" data-author-ref="{{ $article->contributor_ref }}" data-author="{{ $article->name }}" data-rating="{{ $article->total_rating }}" data-tags="{{ implode(',', $article->tags()->pluck('tag')->toArray()) }}" data-view="{{ $article->view }}">
                            <td width="40">
                                <div class="checkbox">
                                    <input type="checkbox" name="check-{{ $article->id }}" value="{{ $article->id }}" id="check-{{ $article->id }}" class="css-checkbox checkbox-row">
                                    <label for="check-{{ $article->id }}" class="css-label"></label>
                                </div>
                            </td>
                            <td><a href="{{ route('admin.article.show', [$article->slug]) }}">{{ $article->title }}</a></td>
                            <td>{{ $article->category }}</td>
                            <td>
                                <div class="people">
                                    <img src="{{ asset('images/contributors/'.$article->contributor->avatar) }}"/>
                                    <a href="{{ route('contributor.stream', [$article->contributor->username]) }}">{{ $article->contributor->name }}</a>
                                </div>
                            </td>
                            <td>{{ $article->view }}X</td>
                            <td><div class="rating-wrapper pn" data-rating="{{ $article->total_rating }}"></div></td>
                            <?php
                                $label = 'default';
                                $status = 'default';

                                if($article->status == 'published'){
                                    $label = 'success';
                                }
                                if($article->status == 'pending'){
                                    $label = 'warning';
                                }
                                if($article->status == 'draft'){
                                    $label = 'info';
                                }
                                if($article->status == 'reject'){
                                    $label = 'danger';
                                }

                                if($article->state == 'trending'){
                                    $status = 'success';
                                }
                                else if($article->state == 'headline'){
                                    $status = 'warning';
                                }
                            ?>
                            <td><span class="label label-{{ $label }}">{{ strtoupper($article->status) }}</span></td>
                            <td><span class="label label-{{ $status }}">{{ strtoupper($article->state) }}</span></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        ACTION
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                        <li class="dropdown-header">QUICK ACTION</li>
                                        <li @if($article->status == 'published'){!! 'class="active"' !!}@endif><a href="#" class="btn-mark" data-value="published" data-type="status"><i class="fa fa-check"></i> @if($article->status == 'published'){{ 'Approved' }}@else{{ 'Approve' }}@endif</a></li>
                                        <li @if($article->status == 'reject'){!! 'class="active"' !!}@endif><a href="#" class="btn-mark" data-value="reject" data-type="status"><i class="fa fa-remove"></i> @if($article->status == 'reject'){{ 'Rejected' }}@else{{ 'Reject' }}@endif</a></li>
                                        <li @if($article->state == 'trending'){!! 'class="active"' !!}@endif><a href="#" class="btn-mark" data-value="trending" data-type="state"><i class="fa fa-trophy"></i> @if($article->state != 'trending'){!! 'Set' !!}@endif Trending</a></li>
                                        <li @if($article->state == 'headline'){!! 'class="active"' !!}@endif><a href="#" class="btn-mark" data-value="headline" data-type="state"><i class="fa fa-star"></i> @if($article->state != 'headline'){!! 'Set' !!}@endif Headline</a></li>
                                        <li><a href="#" class="btn-mark" data-value="general" data-type="state"><i class="fa fa-file-text"></i> Set General</a></li>
                                        <li class="dropdown-header">CONTROL</li>
                                        <li><a href="{{ route('admin.article.show', [$article->slug]) }}"><i class="fa fa-eye"></i> View</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#modal-detail" class="btn-article-detail"><i class="fa fa-info-circle"></i> Detail</a></li>
                                        <li><a href="{{ route('admin.article.edit', [$article->slug]) }}"><i class="fa fa-pencil"></i> Edit</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#modal-delete" class="btn-delete" data-label="{{ $article->title }}"><i class="fa fa-trash"></i> Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No article available</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="table-footer">
                    <div class="status">
                        <p class="text-muted">{{ $articles->currentPage() }}/{{ $articles->lastPage() }} list of page</p>
                        <p>Showing {{ $articles->perPage() * $articles->currentPage() - 9 }} to {{ $articles->perPage() * $articles->currentPage() }} of {{ $articles->total() }} entries</p>
                    </div>
                    <div class="pagination-wrapper">
                        {!! $articles->appends(Input::all())->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade color" id="modal-detail" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" class="form-strip form-horizontal">
                    <input type="hidden" class="form-control" value="0"/>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-file-text-o"></i> ARTICLE INFO</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>TITLE</label>
                                </div>
                                <div class="col-sm-9">
                                    <p><a href="#" target="_blank" class="title">Title</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>TIMESTAMP</label>
                                </div>
                                <div class="col-sm-9">
                                    <p class="timestamp">Timestamp</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>CATEGORY</label>
                                </div>
                                <div class="col-sm-9">
                                    <p><a href="#" class="category">Category</a> | <a href="#" class="subcategory">Subcategory</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>KEYWORDS</label>
                                </div>
                                <div class="col-sm-9">
                                    <ul class="list-inline tags"></ul>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>AUTHOR</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="people">
                                        <img src="" class="author-avatar"/>
                                        <a href="#" class="author" target="_blank">Author</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>RATING</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="rating-wrapper pn"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label>VIEWS</label>
                                </div>
                                <div class="col-sm-9">
                                    <p class="view">0 X</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-primary">CLOSE</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade no-line" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" data-url="{{ url('admin/article/') }}" method="post">
                    {!! csrf_field() !!}
                    {!! method_field('delete') !!}
                    <input type="hidden" name="selected" value="">
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

    <div class="modal fade no-line" id="modal-search" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.article.index') }}" method="get">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-search"></i> SEARCH QUERY</h4>
                    </div>
                    <div class="modal-body">
                        <label class="mbs">Search in Article Data</label>
                        <div class="search">
                            <input type="search" name="query" id="query" class="form-control pull-left" placeholder="Type keywords here"/>
                            <button type="submit" class="btn btn-primary pull-right">SEARCH</button>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </form>
            </div>
        </div>
    </div>

    <form action="#" method="post" data-url="{{ url('admin/article/mark') }}" id="form-mark">
        {!! csrf_field() !!}
        {!! method_field('put') !!}
    </form>

@endsection