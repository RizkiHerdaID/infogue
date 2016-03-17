@extends('private')

@section('title', '- About')

@section('content')

    <div id="content-wrapper">
        @include('admin.layouts._header')
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="{{ route('index') }}" target="_blank">INFOGUE.ID</a></li>
                <li class="hidden-xs"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="active">About</li>
            </ol>
        </div>
        <div class="content">
            <div class="title-section">
                <h1 class="title">Credits</h1>
                <p class="subtitle">Thanks for using our services</p>
            </div>
            <div class="content-section">
                <article>
                    <p>InfoGue.id was originally developed by
                        <a href="mailto:anggadarkprince@gmail.com">Angga Ari Wijaya</a> (Starter of Sketch
                        Project Studio). The web was written for performance in the real world, with many of the
                        features borrowed from the code-base of Laravel PHP Framework.</p>

                    <p>It was, for months, developed and maintained by developer, the Vanilla Development Team
                        and a group of community members called the
                        <a href="mailto:sketchprojectstudio@gmail.com">Sketch Project Studio</a>.</p>

                    <p>In 2016, we release the very first version 1.0 and ready to launch. A hat tip goes to us for
                        inspiring us to create a better solution at similar website, and for bringing the world into the
                        general consciousness of the web community.</p>

                    <img src="{{ asset('images/misc/logo-color.png') }}" class="img-responsive mtl mbs"/>
                    <p>&copy; Copyright {{ date('Y') }} All Rights Reserved.</p>

                    <p>Developer Contact (+62) 8565547868<br>Gresik, Jatim - Indonesia</p>
                    <div style="margin-bottom: 250px">
                </article>
            </div>
        </div>
    </div>

@endsection