@extends('private')

@section('title', '- Articles')

@section('content')

    <div id="content-wrapper">
        @include('admin.layouts._header')
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="{{ route('index') }}" target="_blank">INFOGUE.ID</a></li>
                <li class="hidden-xs hidden-sm"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.article.index') }}">Article</a></li>
                <li class="active hidden-xs">Preview</li>
            </ol>
            <div class="control">
                <a href="#" class="link print"><i class="fa fa-print"></i> PRINT</a>
                <a href="{{ route('admin.article.create') }}" class="link visible-xs"><i class="fa fa-plus"></i> CREATE ARTICLE</a>
            </div>
        </div>
        <div class="content" id="content">
            @include('errors.common')
            <div class="content-section" data-id="{{ $article->id }}">
                <style>
                    .article-preview .category {
                        text-transform: uppercase;
                        font-family: opensans-bold, sans-serif;
                    }
                    .article-preview .category {
                        letter-spacing: 1px;
                    }
                    .article-preview .title {
                        font-size: 1.3em;
                        line-height: 23.4px;
                        margin-bottom: 10px;
                    }
                    .article-preview .title a {
                        color: #333333;
                        -moz-transition-property: all;
                        -o-transition-property: all;
                        -webkit-transition-property: all;
                        transition-property: all;
                        -moz-transition-duration: 0.2s;
                        -o-transition-duration: 0.2s;
                        -webkit-transition-duration: 0.2s;
                        transition-duration: 0.2s;
                        -moz-transition-timing-function: ease-in;
                        -o-transition-timing-function: ease-in;
                        -webkit-transition-timing-function: ease-in;
                        transition-timing-function: ease-in;
                    }
                    .article-preview .title a:hover {
                        color: #00acc1;
                    }
                    .article-preview .timestamp {
                        color: #818181;
                        margin-bottom: 15px;
                    }
                    .article-preview .timestamp li {
                        display: inline-block;
                        font-size: 0.9em;
                    }
                    .article-preview .timestamp li + li:before {
                        font-family: FontAwesome;
                        content: "\f111";
                        font-size: 0.5em;
                        padding: 5px 6px 5px 5px;
                        line-height: 0.9em;
                        vertical-align: middle;
                        color: #b4b4b4;
                    }
                    .article-preview.single-view .featured-image {
                        height: 400px;
                        max-width: 100%;
                        margin-bottom: 20px;
                    }
                    .article-preview.single-view .title-wrapper {
                        margin-bottom: 25px;
                    }
                    .article-preview.single-view .title-wrapper .category {
                        margin-bottom: 10px;
                    }
                    .article-preview.single-view .title-wrapper .title {
                        font-size: 1.9em;
                        line-height: 1.3em;
                        margin-bottom: 20px;
                    }
                    .article-preview.single-view .title-wrapper .timestamp-wrapper {
                        padding: 10px 0;
                        border-top: 1px solid #dbdbdb;
                        border-bottom: 1px solid #dbdbdb;
                    }
                    .article-preview.single-view .title-wrapper .timestamp-wrapper:after {
                        content: "";
                        display: table;
                        clear: both;
                    }
                    .article-preview.single-view .title-wrapper .timestamp-wrapper .timestamp {
                        float: left;
                        margin: 0;
                        line-height: 34px;
                    }
                    .article-preview.single-view .title-wrapper .timestamp-wrapper .timestamp .avatar {
                        float: left;
                        width: 35px;
                        height: 35px;
                        margin-right: 10px;
                    }
                    .article-preview.single-view article {
                        line-height: 1.8em;
                    }
                    .article-preview.single-view article p {
                        line-height: 2em;
                        margin-bottom: 10px;
                    }
                    .article-preview.single-view article h1 {
                        font-size: 1.8em;
                    }
                    .article-preview.single-view article h2 {
                        font-size: 1.5em;
                    }
                    .article-preview.single-view article h3 {
                        font-size: 1.2em;
                    }
                    .article-preview.single-view article h1, .article-preview.single-view article h2, .article-preview.single-view article h3 {
                        margin: 20px 0 10px;
                    }
                    .article-preview.single-view article img {
                        margin-bottom: 10px;
                    }
                    .article-preview.single-view .excerpt {
                        padding: 20px;
                        background-color: #ecf9fb;
                        margin: 20px 0 50px;
                        font-style: italic;
                        line-height: 1.4em;
                    }
                </style>
                <div class="article-preview single-view">
                    <div class="title-wrapper">
                        <p class="category mbn"><a href="{{ route('article.category', [str_slug($article->subcategory->category->category)]) }}">{{ $article->subcategory->category->category }}</a></p>
                        <h1 class="title mtn">
                            <a href="{{ route('article.show', [$article->slug]) }}">{{ $article->title }}</a>
                        </h1>
                        <div class="timestamp-wrapper">
                            <ul class="timestamp">
                                <li><img src="{{ asset('images/contributors/'.$article->contributor->avatar) }}" class="avatar img-circle"/> By <a href="{{ route('contributor.stream', [$article->contributor->username]) }}">{{ $article->contributor->name }}</a></li>
                                <li>@fulldate($article->created_at)</li>
                                <li>{{ $article->view }} Views</li>
                                <?php
                                    $label = 'default';
                                    if($article->status == 'pending'){
                                        $label = 'warning';
                                    }
                                    else if($article->status == 'published'){
                                        $label = 'success';
                                    }
                                    else if($article->status == 'reject'){
                                        $label = 'danger';
                                    }
                                    else if($article->status == 'draft'){
                                        $label = 'info';
                                    }
                                ?>
                                <li><span class="label label-{{ $label }}">{{ strtoupper($article->status) }}</span></li>
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
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <a href="#" class="btn btn-primary" onclick="return window.history.back()"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="col-xs-8 text-right">
                        <a href="#" class="btn btn-success btn-mark" data-value="published" data-type="status"><i class="fa fa-check"></i> Approve</a>
                        <a href="#" class="btn btn-danger btn-mark" data-value="reject" data-type="status"><i class="fa fa-check"></i> Reject</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="#" method="post" data-url="{{ url('admin/article/mark') }}" id="form-mark">
        {!! csrf_field() !!}
        {!! method_field('put') !!}
    </form>

@endsection