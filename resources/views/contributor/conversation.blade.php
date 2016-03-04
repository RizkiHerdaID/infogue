@extends('public')

@section('title', '- Conversation With '.$contributor->name)

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="row">

                @include('contributor._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data" data-href="{{ Request::url() }}">
                                <h3 class="title">MESSAGES : {{ strtoupper($contributor->name) }}</h3>
                                <div class="content">
                                    <div class="message-box">
                                        <div class="loading" style="display: block"></div>
                                        <div id="conversations">

                                        </div>
                                    </div>
                                    <div class="chat-box">
                                        <form action="{{ route('account.message.send') }}" id="form-message" method="post" enctype="multipart/form-data">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="async" value="true">
                                            <input type="hidden" name="contributor_id" value="{{ $contributor->id }}">
                                            <textarea name="message" id="message" cols="30" rows="3" placeholder="Type a message here" class="form-control"></textarea>
                                            <div class="control">
                                                <div class="css-file attachment">
                                                    <a class="open-attachment"><i class="fa fa-file mrs"></i>ATTACHMENT</a>
                                                    <span class="file-info"></span>
                                                    <input type="file" class="file-input" id="attachment" name="attachment" />
                                                </div>
                                                <button type="submit" class="btn btn-primary btn-send plm prm">SEND</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script id="conversation-row-template" type="text/template">
        @{{#data}}
        <div class="conversation @{{ owner }}" data-id="@{{ id }}">
            <div class="contributor-profile mini message-list @{{ owner }}">
                <img src="@{{ avatar_ref }}" class="avatar img-circle"/>
                <div class="info">
                    <a href="@{{ contributor_ref }}" class="name">@{{ name }}</a>
                    <p class="message">@{{ message }}</p>
                    <div class="attachment @{{ has_attachment }}">
                        <p>Attachment</p>
                        <a href="@{{ attachment_ref }}" target="_blank">@{{ attachment }}</a>
                    </div>
                    <p class="timestamp"><time class="timeago" datetime="@{{ created_at }}">@{{ created_at }}</time></p>
                </div>
            </div>
        </div>
        @{{/data}}
    </script>

@endsection