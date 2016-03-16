@extends('public')

@section('title', '- Contact')

@section('content')

    <div class="map" style="background: url('{{ asset('images/misc/map.jpg') }}') no-repeat center / cover"></div>
    <div class="container">
        <!-- contact form -->
        <div class="section" id="feedback">
            <div class="title">
                <h1>GET IN TOUCH</h1>
                <p class="lead">
                    {{ $site_settings['Address'] }} - Tel.
                    <a href="tel:{{ $site_settings['Contact'] }}">{{ $site_settings['Contact'] }}</a> <br/>
                    email: <a href="mailto:{{ $site_settings['Email'] }}">{{ $site_settings['Email'] }}</a>
                </p>
            </div>
            <div class="content">
                <form action="{{ route("feedback.store") }}" method="post" id="form-contact">
                    {!! csrf_field() !!}

                    @include('errors.common')

                    @if(Session::has('status'))
                        <div class="row">
                            <div class="col-md-8  col-md-push-2">
                                <div class="alert alert-{{ Session::get('status') }}">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {!! '<p>'.Session::get('message').'</p>' !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4 col-md-push-2 col-sm-6">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <input type="name" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Your Name" required maxlength="50">
                                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-4 col-md-push-2 col-sm-6">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required maxlength="50">
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-md-push-2">
                            <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                                <textarea class="form-control" id="message" name="message" rows="7" placeholder="Type Your Message" required maxlength="5000">{{ old('message') }}</textarea>
                                {!! $errors->first('message', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary center-block pll prl mtm">SEND</button>
                            </div>
                        </div>
                    </div>
                </form>

                <ul class="list-inline center-block text-center mtm lead contact-social">
                    <li class="pm pbn"><a href="{{ $site_settings['Facebook'] }}" target="_blank">Facebook</a></li>
                    <li class="pm pbn"><a href="{{ $site_settings['Twitter'] }}" target="_blank">Twitter</a></li>
                    <li class="pm pbn"><a href="{{ $site_settings['Google Plus'] }}" target="_blank">Google+</a></li>
                </ul>
            </div>
        </div>
        <!-- end of contact form -->

        @include('pages._supporter')
    </div>

@endsection