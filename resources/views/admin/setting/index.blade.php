@extends('private')

@section('title', '- Settings')

@section('content')

    <div id="content-wrapper">
        @include('admin.layouts._header')
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="{{ route('index') }}" target="_blank">INFOGUE.ID</a></li>
                <li class="hidden-xs"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="active">Setting</li>
            </ol>
        </div>
        <div class="content">
            <div class="title-section">
                <h1 class="title">Website Setting</h1>
                <p class="subtitle">Basic web configuration and contact <a href="#" class="pull-right hidden-xs reset-setting">RESET DEFAULT</a></p>
            </div>
            <div class="content-section">
                @include('errors.common')
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
                <form acion="{{ route('admin.setting.update') }}" class="form-horizontal form-strip" id="form-setting" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    <fieldset>
                        <legend>BASIC INFORMATION</legend>
                        <div class="form-group {{ $errors->has('website') ? 'has-error' : '' }}">
                            <label for="website" class="col-sm-3 control-label">Website Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="website" name="website" value="{{ old('website', $site_settings['Website Name']) }}" placeholder="Put the website name" required maxlength="30">
                                {!! $errors->first('website', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('keywords') ? 'has-error' : '' }}">
                            <label for="keywords" class="col-sm-3 control-label">Keywords</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="keywords" name="keywords" value="{{ old('keywords', $site_settings['Keywords']) }}" placeholder="Keywords separated by coma" data-role="tagsinput" required maxlength="100">
                                <input type="text" class="form-control-dummy" id="keywords-dummy" name="keywords-dummy" />
                                {!! $errors->first('keywords', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label for="online" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-9">
                                <div class="radio radio-inline">
                                    <input type="radio" name="status" id="online" value="online" class="css-radio" @if(old('status', $site_settings['Status']) == 'online') checked @endif required>
                                    <label for="online" class="css-label">Online</label>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" name="status" id="maintenance" value="maintenance" class="css-radio" @if(old('status', $site_settings['Status']) == 'maintenance') checked @endif>
                                    <label for="maintenance" class="css-label">Maintenance</label>
                                </div>
                                {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label for="address" class="col-sm-3 control-label">Address</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="address" id="address" cols="30"
                                          rows="2" placeholder="Company address" required maxlength="100">{{ old('address', $site_settings['Address']) }}</textarea>
                                {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('contact') ? 'has-error' : '' }}">
                            <label for="contact" class="col-sm-3 control-label">Contact</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact', $site_settings['Contact']) }}" placeholder="Office phone or Fax" required maxlength="50">
                                {!! $errors->first('contact', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $site_settings['Email']) }}" placeholder="Company email address" required maxlength="50">
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="description" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" id="description" cols="30"
                                          rows="3" placeholder="Describe about this website" required maxlength="160">{{ old('description', $site_settings['Description']) }}</textarea>
                                {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('owner') ? 'has-error' : '' }}">
                            <label for="owner" class="col-sm-3 control-label">Owner</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="owner" name="owner" value="{{ old('owner', $site_settings['Owner']) }}" placeholder="Company or website owner" maxlength="30">
                                {!! $errors->first('owner', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                            <label for="latitude" class="col-sm-3 control-label">Location</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control mbs" id="latitude" name="latitude" value="{{ old('latitude', $site_settings['Latitude']) }}" placeholder="Latitude coordinate">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $site_settings['Longitude']) }}" placeholder="Longitude coordinate">
                                    </div>
                                </div>
                                {!! $errors->first('location', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>SOCIAL ACCOUNT</legend>
                        <div class="form-group {{ $errors->has('facebook') ? 'has-error' : '' }}">
                            <label for="facebook" class="col-sm-3 control-label">Facebook</label>
                            <div class="col-sm-9">
                                <input type="url" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', $site_settings['Facebook']) }}" placeholder="Full url of Facebook account" maxlength="100">
                                {!! $errors->first('facebook', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('twitter') ? 'has-error' : '' }}">
                            <label for="twitter" class="col-sm-3 control-label">Twitter</label>
                            <div class="col-sm-9">
                                <input type="url" class="form-control" id="twitter" name="twitter" value="{{ old('twitter', $site_settings['Twitter']) }}" placeholder="Full url of Twitter account" maxlength="100">
                                {!! $errors->first('twitter', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('googleplus') ? 'has-error' : '' }}">
                            <label for="googleplus" class="col-sm-3 control-label">Google+</label>
                            <div class="col-sm-9">
                                <input type="url" class="form-control" id="googleplus" name="googleplus" value="{{ old('googleplus', $site_settings['Google Plus']) }}" placeholder="Full url of Google+ account" maxlength="100">
                                {!! $errors->first('googleplus', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>APPEARANCE</legend>
                        <div class="form-group {{ $errors->has('favicon') ? 'has-error' : '' }}">
                            <label for="favicon" class="col-sm-3 control-label">Favicon</label>
                            <div class="col-sm-9">
                                <div class="css-file">
                                    <span class="file-info">No file selected</span>
                                    <button class="btn btn-primary" type="button">SELECT<span class="hidden-xs"> FAVICON</span></button>
                                    <input type="file" class="file-input" id="favicon" name="favicon" accept="image/*"/>
                                </div>
                                <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Small icon on browser tab</span>
                                {!! $errors->first('favicon', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('background') ? 'has-error' : '' }}">
                            <label for="background" class="col-sm-3 control-label">Background</label>
                            <div class="col-sm-9">
                                <div class="css-file">
                                    <span class="file-info">No file selected</span>
                                    <button class="btn btn-primary" type="button">SELECT<span class="hidden-xs"> BACKGROUND</span></button>
                                    <input type="file" class="file-input" id="background" name="background" accept="image/*"/>
                                </div>
                                <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Optional background (not necessary)</span>
                                {!! $errors->first('background', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>ALERT & EMAIL</legend>
                        <div class="form-group {{ $errors->has('notification') ? 'has-error' : '' }}">
                            <label class="col-sm-3 control-label">Notification</label>
                            <div class="col-sm-9">
                                <div class="checkbox {{ $errors->has('article') ? 'has-error' : '' }}">
                                    <input type="checkbox" name="article" id="article" value="1" class="css-checkbox" @if(old('article', $site_settings['Email Article'])) checked @endif>
                                    <label for="article" class="css-label">Email me when a contributor creates new article</label>
                                </div>
                                <div class="checkbox {{ $errors->has('feedback') ? 'has-error' : '' }}">
                                    <input type="checkbox" name="feedback" id="feedback" value="1" class="css-checkbox" @if(old('feedback', $site_settings['Email Feedback'])) checked @endif>
                                    <label for="feedback" class="css-label">Email me when I got a feedback</label>
                                </div>
                                <div class="checkbox {{ $errors->has('member') ? 'has-error' : '' }}">
                                    <input type="checkbox" name="member" id="member" value="1" class="css-checkbox" @if(old('member', $site_settings['Email Contributor'])) checked @endif>
                                    <label for="member" class="css-label">Email me when we got new member</label>
                                </div>
                                {!! $errors->first('notification', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('approve') ? 'has-error' : '' }}">
                            <label for="yes" class="col-sm-3 control-label">Auto Approve</label>
                            <div class="col-sm-9">
                                <div class="radio radio-inline">
                                    <input type="radio" name="approve" id="yes" value="1" class="css-radio" @if(old('approve', $site_settings['Auto Approve'])) checked @endif required>
                                    <label for="yes" class="css-label">Yes</label>
                                </div>
                                <div class="radio radio-inline">
                                    <input type="radio" name="approve" id="no" value="0" class="css-radio" @if(!old('approve', $site_settings['Auto Approve'])) checked @endif required>
                                    <label for="no" class="css-label">No</label>
                                </div>
                                {!! $errors->first('approve', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>ADMIN ACCOUNT</legend>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Username</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">{{ explode('@', Auth::guard('admin')->user()->email)[0] }}</p>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('admin_email') ? 'has-error' : '' }}">
                            <label for="admin_email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="admin_email" name="admin_email" placeholder="Admin email address" value="{{ old('name', Auth::guard('admin')->user()->email) }}" required maxlength="30">
                                {!! $errors->first('admin_email', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name" class="col-sm-3 control-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Put your name here" value="{{ old('name', Auth::guard('admin')->user()->name) }}" required maxlength="50">
                                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('avatar') ? 'has-error' : '' }}">
                            <label for="avatar" class="col-sm-3 control-label">Avatar</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-4 col-lg-3">
                                        <div class="contributor-profile">
                                            <img src="{{ asset('images/contributors/'.Auth::guard('admin')->user()->avatar) }}" class="img-circle img-responsive avatar" width="120" height="120"/>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-lg-9">
                                        <p class="mts mbn">Select and Crop Your Avatar</p>
                                        <p class="small text-muted mbs">Format like .png .jpg .gif</p>
                                        <div class="css-file">
                                            <span class="file-info">No file selected</span>
                                            <button class="btn btn-primary" type="button">SELECT<span class="hidden-xs"> AVATAR</span></button>
                                            <input type="file" class="file-input" id="avatar" name="avatar" accept="image/*"/>
                                        </div>
                                        {!! $errors->first('avatar', '<span class="help-block">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label for="password" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Type current password" required pattern=".{6,20}">
                                <span class="help-block"><i class="fa fa-info-circle mrs mts"></i>Password is required for save</span>
                                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('new_password') ? 'has-error' : '' }}">
                            <label for="new_password" class="col-sm-3 control-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Create new password" pattern=".{6,20}">
                                {!! $errors->first('new_password', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('new_password_confirmation') ? 'has-error' : '' }}">
                            <label for="new_password_confirmation" class="col-sm-3 control-label">Confirm</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Retype new password" pattern=".{6,20}">
                                {!! $errors->first('new_password_confirmation', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group no-line">
                            <div class="col-sm-offset-3 col-sm-9 pts pbm">
                                <button class="btn btn-primary">SAVE CHANGES</button>
                                <a href="#" data-toggle="modal" data-target="#discard" class="btn btn-danger">DISCARD</a>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
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
                        <label class="mbn">Are you sure want to discard this setting?</label>
                        <p class="mbn"><small class="text-muted">All filled content will be lost.</small></p>
                        <input type="hidden" class="form-control" value="0"/>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-primary">NO</a>
                        <a href="{{ route('admin.setting') }}" class="btn btn-danger">YES</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection