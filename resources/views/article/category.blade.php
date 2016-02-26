@extends('public')

@section('title', '- International')

@section('content')

    <section class="container content-wrapper" data-href="{{ Request::url() }}">
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <?php $counter = 1; $length = count($breadcrumb); $class=""; ?>
                @foreach($breadcrumb as $list => $uri)

                    @if($counter == 2) <?php $class = "class='hidden-xs'" ?> @endif
                    @if($counter == $length) <?php $class = "class='active'" ?> @endif
                    @if($counter == 2 && $counter == $length) <?php $class = "class='hidden-xs active'" ?> @endif

                    <li {!! $class !!}>@if($counter == $length){{ $list }}
                        @else
                            <a href="{{ $uri }}">{{ $list }}</a>
                        @endif
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
                <a class="btn btn-primary control-left" href="#"><i class="fa fa-chevron-left"></i></a>
                <a class="btn btn-primary control-right" href="#"><i class="fa fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="article-wrapper">
            <div class="row" id="articles">

            </div>
            <div class="text-center">
                <div class="loading"></div>
                <a href="#" class="btn btn-primary btn-load-more">LOAD MORE</a>
            </div>
        </div>
    </section>

    <script id="article-portrait-template" type="text/template">
        @{{#data}}
        <div class="col-md-4 col-sm-6">
            <div class="article-preview portrait">
                <div class="featured-image">
                    <img src="{{ asset('images/misc/preloader.gif') }}" alt="@{{ featured }}" data-echo="@{{ featured_ref }}"/>
                </div>
                <div class="title-wrapper">
                    <p class="category"><a href="category.html">@{{ subcategory }}</a></p>
                    <h1 class="title">
                        <a href="article.html">@{{ title }}</a>
                    </h1>
                    <ul class="timestamp">
                        <li>By <a href="@{{ username }}">@{{ name }}</a></li>
                        <li>@{{ published_at }}</li>
                        <li>@{{ view }} Views</li>
                    </ul>
                </div>
                <article>
                    @{{ content }}
                </article>
                <div class="rating-wrapper" data-rating="@{{ total_rating }}">@{{ rating }}</div>
                <ul class="social text-right">
                    <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div>
        </div>
        @{{/data}}
    </script>

@endsection