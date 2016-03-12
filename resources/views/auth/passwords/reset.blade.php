@extends('public')

@section('title', '- Reset Password')

@section('content')

    <div class="reset" style="background: url('{{ asset('images/covers/'.$contributor->cover) }}') no-repeat center / cover">
        <section class="container">
            <div class="row">
                <div class="col-md-7 col-sm-7">
                    <div class="contributor-profile">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ asset('images/contributors/'.$contributor->avatar) }}" class="img-circle avatar"/>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('contributor.stream', [$contributor->username]) }}" class="name">@if($contributor->name == '') {{ "No Name" }} @else {{ $contributor->name }} @endif</a>
                                        <p class="location">@if($contributor->location == '') {{ "No Location" }} @else {{ $contributor->location }}@endif</p>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="about hidden-xs">{{ $contributor->about }} <a href="{{ route('contributor.stream', [$contributor->username]) }}">MORE</a></p>
                                        <ul class="statistic list-separated">
                                            <li><a href="{{ route('contributor.article', [$contributor->username]) }}">{{ $contributor->articles()->count() }} ARTICLE</a></li>
                                            <li><a href="{{ route('contributor.following', [$contributor->username]) }}">{{ $contributor->following()->count() }} FOLLOWING</a></li>
                                            <li><a href="{{ route('contributor.follower', [$contributor->username]) }}">{{ $contributor->followers()->count() }} FOLLOWERS</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-md-push-1 col-sm-5">
                    <h2 class="form-title">Reset Password</h2>
                    <p class="form-subtitle">Recovering your credential</p>

                    @include('errors.common')

                    <form action="{{ route('login.reset.attempt') }}" method="post" id="form-reset">
                        {!! csrf_field() !!}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <input type="email" class="form-control" id="email" name="email" value="{{ $contributor->email }}" placeholder="Email Address" required>
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required pattern=".{6,20}" maxlength="20">
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Retype Password" required pattern=".{6,20}" maxlength="20">
                            {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">RESET MY PASSWORD</button>
                    </form>
                </div>
            </div>
        </section>
    </div>

@endsection