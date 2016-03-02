@extends('public')

@section('title', '- Setting')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="row">

                @include('contributor._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data">
                                <h3 class="title">ACCOUNT SETTING</h3>
                                <div class="content">
                                    <form action="{{ route('account.update') }}" class="form-horizontal form-strip" method="post" enctype="multipart/form-data">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="_method" value="PUT">
                                        <fieldset>
                                            <legend>INFORMATION</legend>
                                            @if(Session::has('status'))
                                                <div class="form-group">
                                                    <div class="alert alert-{{ Session::get('status') }}">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        {{ Session::get('message') }}
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                                <label for="name" class="col-sm-3 control-label">Full Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Your name">
                                                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                                <label for="male" class="col-sm-3 control-label">Gender</label>
                                                <div class="col-sm-9">
                                                    <div class="radio radio-inline">
                                                        <input type="radio" name="gender" id="male" value="male" class="css-radio" @if(old('gender', Auth::user()->gender) == 'male') checked @endif>
                                                        <label for="male" class="css-label">Male</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <input type="radio" name="gender" id="female" value="female" class="css-radio" @if(old('gender', Auth::user()->gender) == 'female') checked @endif>
                                                        <label for="female" class="css-label">Female</label>
                                                    </div>
                                                    <div class="radio radio-inline">
                                                        <input type="radio" name="gender" id="other" value="other" class="css-radio" @if(old('gender', Auth::user()->gender) == 'other') checked @endif>
                                                        <label for="other" class="css-label">Other</label>
                                                    </div>
                                                    {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('birthday') ? 'has-error' : '' }}">
                                                <label for="date" class="col-sm-3 control-label">Date of Birth</label>
                                                <div class="col-sm-9">
                                                    <label for="date" class="css-select select-inline">
                                                        <select name="date" id="date" class="form-control" required>
                                                            <option value="">Date</option>
                                                            <?php $default = Auth::user()->birthday != null ? \Carbon\Carbon::parse(Auth::user()->birthday)->format('d') : ''; ?>
                                                            @for($i = 1; $i <= 31; $i++)
                                                                <option value="{{ $i }}" @if(old('date', $default) == $i) selected @endif>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </label>
                                                    <label for="month" class="css-select select-inline">
                                                        <select name="month" id="month" class="form-control" required>
                                                            <option value="">Month</option>
                                                            <?php $default = Auth::user()->birthday != null ? \Carbon\Carbon::parse(Auth::user()->birthday)->format('m') : ''; ?>
                                                            <?php $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'); ?>
                                                            @foreach($months as $month => $name)
                                                                <option value="{{ $month }}" @if(old('month', $default) == $month) selected @endif>{{ $name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </label>
                                                    <label for="year" class="css-select select-inline">
                                                        <select name="year" id="year" class="form-control" required>
                                                            <option value="">Year</option>
                                                            <?php $default = Auth::user()->birthday != null ? \Carbon\Carbon::parse(Auth::user()->birthday)->format('Y') : ''; ?>
                                                            @for($i = 1975; $i <= \Carbon\Carbon::now()->addYear(-8)->format('Y'); $i++)
                                                                <option value="{{ $i }}" @if(old('year', $default) == $i) selected @endif>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </label>
                                                    {!! $errors->first('birthday', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                                                <label for="location" class="col-sm-3 control-label">Location</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location', Auth::user()->location) }}" placeholder="Current location">
                                                    <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Eg. Jakarta, Indonesia</span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('contact') ? 'has-error' : '' }}">
                                                <label for="contact" class="col-sm-3 control-label">Contact</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact', Auth::user()->contact) }}" placeholder="Your contact">
                                                    <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Your mobile number or fax office</span>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('about') ? 'has-error' : '' }}">
                                                <label for="about" class="col-sm-3 control-label">About</label>
                                                <div class="col-sm-9">
                                                <textarea class="form-control" name="about" id="about" cols="30"
                                                          rows="3" placeholder="Tell about you">{{ old('about', Auth::user()->about) }}</textarea>
                                                    <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>About will appear on your main profile</span>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>ACCOUNT</legend>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Member Since</label>
                                                <div class="col-sm-9">
                                                    <p class="form-control-static">January, 2016</p>
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Username</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username', Auth::user()->username) }}" placeholder="Pick a username">
                                                    {!! $errors->first('username', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                                <label class="col-sm-3 control-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="Email address">
                                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('cover') ? 'has-error' : '' }}">
                                                <label for="cover" class="col-sm-3 control-label">Cover Image</label>
                                                <div class="col-sm-9">
                                                    <div class="css-file">
                                                        <span class="file-info">No file selected</span>
                                                        <button class="btn btn-primary" type="button">SELECT COVER</button>
                                                        <input type="file" class="file-input" id="cover" name="cover" accept="image/*"/>
                                                    </div>
                                                    <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Cover image for your profile</span>
                                                    {!! $errors->first('cover', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                                                <label for="avatar" class="col-sm-3 control-label">Avatar</label>
                                                <div class="col-sm-9">
                                                    <div class="row">
                                                        <div class="col-md-4 col-sm-4">
                                                            <div class="contributor-profile">
                                                                <img src="{{ asset('images/contributors/'.Auth::user()->avatar) }}" class="img-circle img-responsive avatar"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 col-sm-8">
                                                            <p class="mtm">Select and Crop Your Avatar</p>
                                                            <p class="small text-muted mbs">Format like .png .jpg .gif</p>
                                                            <div class="css-file">
                                                                <span class="file-info">No file selected</span>
                                                                <button class="btn btn-primary" type="button">SELECT AVATAR</button>
                                                                <input type="file" class="file-input" id="avatar" name="avatar" accept="image/*"/>
                                                            </div>
                                                            {!! $errors->first('avatar', '<span class="help-block">:message</span>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>SOCIAL NETWORK</legend>
                                            <div class="form-group {{ $errors->has('instagram') ? 'has-error' : '' }}">
                                                <label for="instagram" class="col-sm-3 control-label">Instagram</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', Auth::user()->instagram) }}" placeholder="Eg. anggadarkprince">
                                                    {!! $errors->first('instagram', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('facebook') ? 'has-error' : '' }}">
                                                <label for="facebook" class="col-sm-3 control-label">Facebook</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', Auth::user()->facebook) }}" placeholder="Eg. angga.ari">
                                                    {!! $errors->first('facebook', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('twitter') ? 'has-error' : '' }}">
                                                <label for="twitter" class="col-sm-3 control-label">Twitter</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="twitter" name="twitter" value="{{ old('twitter', Auth::user()->twitter) }}" placeholder="Eg. @anggadarkprince">
                                                    {!! $errors->first('twitter', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('googleplus') ? 'has-error' : '' }}">
                                                <label for="googleplus" class="col-sm-3 control-label">Google+</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="googleplus" name="googleplus" value="{{ old('googleplus', Auth::user()->googleplus) }}" placeholder="Eg. +AnggaAriWijaya">
                                                    {!! $errors->first('googleplus', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>SUBSCRIPTION</legend>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Notification</label>
                                                <div class="col-sm-9">
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="email_subscription" value="1" id="email_subscription" class="css-checkbox" @if(old('email_subscription', Auth::user()->email_subscription)){{ 'checked' }}@endif>
                                                        <label for="email_subscription" class="css-label">Subscribe new articles</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="email_message" value="1" id="email_message" class="css-checkbox" @if(old('email_message', Auth::user()->email_subscription)){{ 'checked' }}@endif>
                                                        <label for="email_message" class="css-label">Email me when I got a message</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="email_follow" value="1" id="email_follow" class="css-checkbox" @if(old('email_follow', Auth::user()->email_follow)){{ 'checked' }}@endif>
                                                        <label for="email_follow" class="css-label">Email me when people follow me</label>
                                                    </div>
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="email_feed" value="1" id="email_feed" class="css-checkbox" @if(old('email_feed', Auth::user()->email_feed)){{ 'checked' }}@endif>
                                                        <label for="email_feed" class="css-label">Email me when people who I follow post new article</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="password" class="col-sm-3 control-label">Mobile</label>
                                                <div class="col-sm-9">
                                                    <div class="checkbox">
                                                        <input type="checkbox" name="mobile_notification" value="1" id="mobile_notification" class="css-checkbox" @if(old('mobile_notification', Auth::user()->mobile_notification)){{ 'checked' }}@endif>
                                                        <label for="mobile_notification" class="css-label">Enable Push Notification</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>CHANGE PASSWORD</legend>
                                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                                <label for="password" class="col-sm-3 control-label">Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Current password">
                                                    @if(!$errors->has('password')) <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Password is required for save</span> @endif
                                                    {!! $errors->first('password', '<span class="help-block"><i class="fa fa-info-circle mrs mts"></i>:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
                                                <label for="new_password" class="col-sm-3 control-label">New Password</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Create new password">
                                                    {!! $errors->first('new_password', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
                                                <label for="new_password_confirmation" class="col-sm-3 control-label">Confirm</label>
                                                <div class="col-sm-9">
                                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Retype new password">
                                                    {!! $errors->first('new_password_confirmation', '<span class="help-block">:message</span>') !!}
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-3 col-sm-9 pts pbm">
                                                    <button class="btn btn-primary">SAVE CHANGES</button>
                                                    <a href="#" data-toggle="modal" data-target="#discard" class="btn btn-danger">DISCARD</a>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade no-line" id="discard" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-save"></i> DISCARD SETTING</h4>
                    </div>
                    <div class="modal-body">
                        <label class="mbn">Are you sure want to discard the setting?</label>
                        <p class="mbn"><small class="text-muted">All filled content will be lost.</small></p>
                        <input type="hidden" class="form-control" value="0"/>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-primary">NO</a>
                        <a href="{{ route('account.setting') }}" class="btn btn-danger">YES</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection