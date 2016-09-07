@extends('private')

@section('title', '- Messages')

@section('content')

    <div id="content-wrapper">
        @include('admin.layouts._header')
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="{{ route('index') }}" target="_blank">INFOGUE.ID</a></li>
                <li class="hidden-xs"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="active">Message</li>
            </ol>
        </div>
        <div class="content" id="content">
            <div class="account-profile">
                <div class="profile-wrapper">
                    <section class="list-data" data-href="{{ Request::url() }}">
                        <div>
                            @include('errors.common')
                            @if(Session::has('status'))
                                <div class="alert alert-{{ Session::get('status') }}" style="border-radius: 0">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    {!! Session::get('message') !!}
                                </div>
                            @endif
                            <div role="list" id="messages"></div>
                        </div>
                        <div class="text-center pm">
                            <div class="loading"></div>
                            <a href="#" class="btn btn-primary btn-load-more">LOAD MORE</a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script id="message-row-template" type="text/template">
        @{{#data}}
        <div class="contributor-profile mini message-list" data-id="@{{ message_id }}" data-sender="@{{ message_sender }}">
            <img src="@{{ avatar_ref }}" class="avatar img-circle img-responsive"/>
            <div class="info">
                <a href="@{{ conversation_ref }}">
                    <p class="name">@{{ name }}</p>
                    <p class="message">@{{ message }}</p>
                    <p class="timestamp">@{{ conversation_total }} Conversation |
                        <time class="timeago" datetime="@{{ created_at }}">@{{ created_at }}</time>
                    </p>
                </a>
            </div>
            <button class="btn btn-primary btn-outline btn-delete delete-message" data-toggle="modal" data-label="@{{ name }}" data-target="#modal-delete">
                <i class="fa fa-trash visible-xs"></i><span class="hidden-xs">DELETE</span>
            </button>
        </div>
        @{{/data}}
    </script>

    <div class="modal fade no-line" id="modal-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" data-url="{{ url('admin/message/') }}" method="post">
                    {!! csrf_field() !!}
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="sender" value="">
                    <input type="hidden" name="contributor" value="">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-trash"></i> DELETE CONVERSATION</h4>
                    </div>
                    <div class="modal-body">
                        <label class="mbn">Are you sure delete conversation with <span class="delete-title text-danger"></span>?</label>
                        <p class="mbn"><small class="text-muted">All related data will be deleted.</small></p>
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn btn-primary">CANCEL</a>
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection