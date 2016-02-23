@extends('public')

@section('title', '- Error404')

@section('content')

    <section class="container content-wrapper">
        <div class="error404">
            <h1>Error<strong>404</strong></h1>
            <h2>PAGE NOT FOUND</h2>
            <p class="lead">The page that you’re looking for is not here</p>
            <p class="text-muted">Try something else, or try to search below</p>
            <section class="search-wrapper">
                <div class="search">
                    <form action="result.html">
                        <div class="input-search">
                            <input class="form-control" id="search-404" type="search" name="search" placeholder="Type a keywords"/>
                            <i class="fa fa-search"></i>
                        </div>
                        <button type="submit" class="btn btn-primary hidden-xs">SEARCH</button>
                    </form>
                </div>
            </section>
            <p class="mbs hidden-xs">InfoGue.id was supported by awesome startups and companies</p>
            <ul class="featured-link hidden-xs">
                <li><a href="#top">Home</a></li>
                <li><a href="editorial.html">Editorial</a></li>
                <li><a href="privacy.html">Privacy</a></li>
                <li><a href="disclaimer.html">Disclaimer</a></li>
                <li><a href="faq.html">FAQ</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
            <p><i class="fa fa-angle-left mrs"></i>Back to <a href="index.html">Home Page</a> and or <a href="contributor_stream.html">Stream</a></p>
        </div>
    </section>

@endsection