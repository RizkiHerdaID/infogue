@extends('public')

@section('title', '- Message')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="row">

                @include('contributor.sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data">
                                <h3 class="title">MESSAGES</h3>
                                <div class="content">
                                    <div role="list">
                                        <div class="contributor-profile mini message-list">
                                            <img src="images/contributors/team04.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="contributor_conversation.html">
                                                    <p class="name">Wendi Aditya Wijaya</p>
                                                    <p class="message">Hei what’s up, it’s long time never see you again since</p>
                                                    <p class="timestamp">15 Conversation | 40 minutes ago</p>
                                                </a>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-delete" data-toggle="modal" data-target="#delete"><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">DELETE</span></button>
                                        </div>
                                        <div class="contributor-profile mini message-list">
                                            <img src="images/contributors/profile.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="contributor_conversation.html">
                                                    <p class="name">Brian Vhirdrict</p>
                                                    <p class="message">We need to complete last code about path finder</p>
                                                    <p class="timestamp">67 Conversation | 4 hours ago</p>
                                                </a>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-delete" data-toggle="modal" data-target="#delete"><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">DELETE</span></button>
                                        </div>
                                        <div class="contributor-profile mini message-list">
                                            <img src="images/contributors/cici.png" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="contributor_conversation.html">
                                                    <p class="name">Imelda Agustine</p>
                                                    <p class="message">Bro, come at my home saturday night</p>
                                                    <p class="timestamp">12 Conversation | 2 hours ago</p>
                                                </a>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-delete" data-toggle="modal" data-target="#delete"><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">DELETE</span></button>
                                        </div>
                                        <div class="contributor-profile mini message-list">
                                            <img src="images/contributors/angga.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="contributor_conversation.html">
                                                    <p class="name">Angga Ari Wijaya</p>
                                                    <p class="message">We promise to solve their cases, now I’m working on it</p>
                                                    <p class="timestamp">8 Conversation | a minute ago</p>
                                                </a>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-delete" data-toggle="modal" data-target="#delete"><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">DELETE</span></button>
                                        </div>
                                        <div class="contributor-profile mini message-list">
                                            <img src="images/contributors/team02.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="contributor_conversation.html">
                                                    <p class="name">Rendi Beat</p>
                                                    <p class="message">Confirm soon alright?</p>
                                                    <p class="timestamp">15 Conversation | 8 hours ago</p>
                                                </a>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-delete" data-toggle="modal" data-target="#delete"><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">DELETE</span></button>
                                        </div>
                                        <div class="contributor-profile mini message-list">
                                            <img src="images/contributors/iyan.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="contributor_conversation.html">
                                                    <p class="name">Iyan Budiman</p>
                                                    <p class="message">I was sent you email, have you read it?</p>
                                                    <p class="timestamp">45 Conversation | 1 days ago</p>
                                                </a>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-delete" data-toggle="modal" data-target="#delete"><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">DELETE</span></button>
                                        </div>
                                        <div class="contributor-profile mini message-list">
                                            <img src="images/contributors/lukman.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="contributor_conversation.html">
                                                    <p class="name">Lukman Hidayatullah</p>
                                                    <p class="message">Meet me at 9:00 AM at starbuck, don’t be late</p>
                                                    <p class="timestamp">8 Conversation | a minute ago</p>
                                                </a>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-delete" data-toggle="modal" data-target="#delete"><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">DELETE</span></button>
                                        </div>
                                        <div class="contributor-profile mini message-list">
                                            <img src="images/contributors/team01.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="contributor_conversation.html">
                                                    <p class="name">Shanon Rean</p>
                                                    <p class="message">Hei what’s up, it’s long time never see you again since</p>
                                                    <p class="timestamp">8 Conversation | a minute ago</p>
                                                </a>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-delete" data-toggle="modal" data-target="#delete"><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">DELETE</span></button>
                                        </div>
                                        <div class="contributor-profile mini message-list">
                                            <img src="images/contributors/desi.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="contributor_conversation.html">
                                                    <p class="name">Desi Wulandari</p>
                                                    <p class="message">Hei hei... just say hi, how are you?...</p>
                                                    <p class="timestamp">51 Conversation | 4 days ago</p>
                                                </a>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-delete" data-toggle="modal" data-target="#delete"><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">DELETE</span></button>
                                        </div>
                                        <div class="contributor-profile mini message-list">
                                            <img src="images/contributors/vivi.jpg" class="avatar img-circle img-responsive"/>
                                            <div class="info">
                                                <a href="contributor_conversation.html">
                                                    <p class="name">Vivi Rachkmawati</p>
                                                    <p class="message">I hope we keep friend and bounding til end of my life</p>
                                                    <p class="timestamp">85 Conversation | 3 days ago</p>
                                                </a>
                                            </div>
                                            <button class="btn btn-primary btn-outline btn-delete" data-toggle="modal" data-target="#delete"><i class="fa fa-trash visible-xs"></i><span class="hidden-xs">DELETE</span></button>
                                        </div>
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

@endsection