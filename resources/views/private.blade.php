<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Info Gue @yield('title')</title>
    <meta name="description" content="{{ $site_settings['Description'] }}">
    <meta name="keywords" content="{{ $site_settings['Keywords'] }}">
    <meta name="author" content="{{ $site_settings['Owner'] }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="url" content="{{ route('index') }}" />

    <link rel="apple-touch-icon" href="{{ asset('/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset($site_settings['Favicon']) }}">

    <link rel="stylesheet" href="{{ asset('/library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/library/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/library/summernote/dist/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('/library/bootstrap-tagsinput/dist/bootstrap-tagsinput-typeahead.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin.css') }}">
</head>
<body>

<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('images/misc/logo-administrator.png') }}">
            </a>
        </div>
        <div class="sidebar-statistic">
            <div>
                <h3>{{ $site_statistic['article'] }}</h3>
                <p>ARTICLES</p>
            </div>
            <div>
                <h3>{{ $site_statistic['member'] }}</h3>
                <p>MEMBERS</p>
            </div>
        </div>
        <a href="{{ route('admin.article.create') }}" class="btn btn-outline btn-light create">CREATE ARTICLE</a>
        <nav role="navigation">
            <ul>
                <li @if(Request::segment(2) == 'dashboard'){!! 'class="active"' !!}@endif><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i>Dashboard</a></li>
                <li @if(Request::segment(2) == 'setting') {!! 'class="active"' !!}@endif><a href="{{ route('admin.setting') }}"><i class="fa fa-wrench"></i>Setting<span class="badge pull-right new">42</span></a></li>
                <li @if(Request::segment(2) == 'contributor') {!! 'class="active"' !!}@endif><a href="{{ route('admin.contributor.index') }}"><i class="fa fa-child"></i>Contributor</a></li>
                <li @if(Request::segment(2) == 'article') {!! 'class="active"' !!}@endif><a href="{{ route('admin.article.index') }}"><i class="fa fa-file-text-o"></i>Article</a></li>
                <li @if(Request::segment(2) == 'category') {!! 'class="active"' !!}@endif><a href="{{ route('admin.category.index') }}"><i class="fa fa-bars"></i>Category</a></li>
                <li @if(Request::segment(2) == 'feedback') {!! 'class="active"' !!}@endif><a href="{{ route('admin.feedback.index') }}"><i class="fa fa-comments-o"></i>Feedback</a></li>
                <li @if(Request::segment(2) == 'about') {!! 'class="active"' !!}@endif><a href="{{ route('admin.about') }}"><i class="fa fa-info-circle"></i>About</a></li>
                <li class="visible-xs"><a href="{{ route('admin.login.destroy') }}"><i class="fa fa-sign-out"></i>Sign Out</a></li>
            </ul>
        </nav>

        <div class="copyright">
            <img src="{{ asset('images/misc/logo-small.png') }}"/>
            <p>&copy; {{ date('Y') }} All Rights Reserved.</p>
        </div>
    </div>
    <!-- End of sidebar-wrapper -->

    <!-- Page Content -->

    @yield('content')

    <!-- End of page-content-wrapper -->

</div> <!-- End of wrapper -->

<script src="{{ asset('/library/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('/library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('/library/bootstrap-typeahead/typeahead.bundle.js') }}"></script>
<script src="{{ asset('/library/equalize/js/equalize.min.js') }}"></script>
<script src="{{ asset('/library/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('/library/jquery.timeago/jquery.timeago.js') }}"></script>
<script src="{{ asset('/library/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('/js/admin.js') }}"></script>

</body>
</html>