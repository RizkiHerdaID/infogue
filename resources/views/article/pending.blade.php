@extends('public')

@section('title', '- Article is reviewing')

@section('content')

    <section class="container content-wrapper">
        <div class="error404">
            <h3 class="mbs">Article with title:</h3>
            <h2>"{{ $article->title }}"</h2>
            <h3 class="text-danger mbs">Currently is reviewing by Infogue.id Editor</h3>
            <h3 class="mbm">PLEASE BE PATIENT</h3>
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
                <li><a href="/editorial">Editorial</a></li>
                <li><a href="/privacy">Privacy</a></li>
                <li><a href="/disclaimer">Disclaimer</a></li>
                <li><a href="/faq">FAQ</a></li>
                <li><a href="/contact">Contact</a></li>
            </ul>
            <p><i class="fa fa-angle-left mrs"></i>Back to <a href="{{ route('index') }}">Home Page</a> and or <a href="{{ route('account.stream') }}">Stream</a></p>
        </div>
    </section>

@endsection