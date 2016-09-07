<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">
    <meta name="description" content="{{ $site_settings['Description'] }}">
    <meta name="keywords" content="{{ $site_settings['Keywords'] }}">
    <meta name="author" content="{{ $site_settings['Owner'] }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ route('index') }}">
    <meta name="theme-color" content="#4dc4d2">

    <title>Info Gue @yield('title')</title>

    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset($site_settings['Favicon']) }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput-typeahead.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <div id="wrapper">
        @include('admin.layouts._navigation')

        <!-- page content -->
        @yield('content')
        <!-- end of page content -->
    </div>
    <!-- end of wrapper -->

    <div class="modal fade no-line" id="modal-info" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">TITLE</h4>
                </div>
                <div class="modal-body">
                    <label class="mbn modal-message">MESSAGE</label>
                    <p class="mbn"><small class="text-muted modal-submessage">SUB MESSAGE</small></p>
                </div>
                <div class="modal-footer">
                    <a href="#" data-dismiss="modal" class="btn btn-primary">OK</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('library/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('library/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('library/jquery.nicescroll/dist/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('library/jquery.timeago/jquery.timeago.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('library/mustache/mustache.min.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>