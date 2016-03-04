@extends('public')

@section('title', '- Message')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="row">

                @include('contributor._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data" data-href="{{ Request::url() }}">
                                <h3 class="title">MESSAGES</h3>
                                <div class="content">
                                    @if(Session::has('status'))
                                        <div class="alert alert-{{ Session::get('status') }}" style="border-radius: 0">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 16px">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            {!! Session::get('message') !!}
                                        </div>
                                    @endif
                                    <div role="list" id="messages">

                                    </div>
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
        </section>
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
                <form action="#" data-url="{{ url('account/message/') }}" method="post">
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