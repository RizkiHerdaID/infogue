@extends('public')

@section('title', '- Conversation With Wendi Aditya Wijaya')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="row">

                @include('contributor._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data">
                                <h3 class="title">MESSAGES : WENDI ADITYA WIJAYA</h3>
                                <div class="content">
                                    <div role="list" class="message-box">
                                        <div class="loading" style="display: block"></div>
                                        <div class="they">
                                            <div class="contributor-profile mini message-list">
                                                <img src="images/contributors/team04.jpg" class="avatar img-circle"/>
                                                <div class="info">
                                                    <a href="profile.html" class="name">Wendi Aditya Wijaya</a>
                                                    <p class="message">Hei what’s up, it’s long time never see you again since</p>
                                                    <p class="timestamp">4 days ago</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me">
                                            <div class="contributor-profile mini message-list">
                                                <img src="images/contributors/cici.png" class="avatar img-circle"/>
                                                <div class="info">
                                                    <a href="profile.html" class="name">Imelda Agustine</a>
                                                    <p class="message">Actually I’m sick...
                                                        but i’m going to work tomorrow</p>
                                                    <p class="timestamp">3 days ago</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me">
                                            <div class="contributor-profile mini message-list me">
                                                <img src="images/contributors/cici.png" class="avatar img-circle"/>
                                                <div class="info">
                                                    <a href="profile.html" class="name">Imelda Agustine</a>
                                                    <p class="message">How about the project?
                                                        doesn’t it going well?</p>
                                                    <p class="timestamp">3 days ago</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="they">
                                            <div class="contributor-profile mini message-list they">
                                                <img src="images/contributors/team04.jpg" class="avatar img-circle"/>
                                                <div class="info">
                                                    <a href="profile.html" class="name">Wendi Aditya Wijaya</a>
                                                    <p class="message">Ok, no problem, btw I sent you email yasterday</p>
                                                    <p class="timestamp">3 days ago</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me">
                                            <div class="contributor-profile mini message-list me">
                                                <img src="images/contributors/cici.png" class="avatar img-circle"/>
                                                <div class="info">
                                                    <a href="profile.html" class="name">Imelda Agustine</a>
                                                    <p class="message">Oh, I don’t check it yet..
                                                        hmm I have some problem about work</p>
                                                    <p class="timestamp">3 days ago</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="they">
                                            <div class="contributor-profile mini message-list they">
                                                <img src="images/contributors/team04.jpg" class="avatar img-circle"/>
                                                <div class="info">
                                                    <a href="profile.html" class="name">Wendi Aditya Wijaya</a>
                                                    <p class="message">Oh I see...</p>
                                                    <p class="timestamp">1 days ago</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="they">
                                            <div class="contributor-profile mini message-list they">
                                                <img src="images/contributors/team04.jpg" class="avatar img-circle"/>
                                                <div class="info">
                                                    <a href="profile.html" class="name">Wendi Aditya Wijaya</a>
                                                    <p class="message">Do you have a question about your tasks?</p>
                                                    <p class="timestamp">1 days ago</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="they">
                                            <div class="contributor-profile mini message-list they">
                                                <img src="images/contributors/team04.jpg" class="avatar img-circle"/>
                                                <div class="info">
                                                    <a href="profile.html" class="name">Wendi Aditya Wijaya</a>
                                                    <p class="message">We can discuss it at office tomorrow</p>
                                                    <p class="timestamp">1 days ago</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me">
                                            <div class="contributor-profile mini message-list me">
                                                <img src="images/contributors/cici.png" class="avatar img-circle"/>
                                                <div class="info">
                                                    <a href="profile.html" class="name">Imelda Agustine</a>
                                                    <p class="message">But it’s urgent, i will send you document,
                                                        I hope you can help me immedietely..</p>
                                                    <p class="timestamp">1 days ago</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="me">
                                            <div class="contributor-profile mini message-list me">
                                                <img src="images/contributors/cici.png" class="avatar img-circle"/>
                                                <div class="info">
                                                    <a href="profile.html" class="name">Imelda Agustine</a>
                                                    <p class="message">This is a PHP code based on Laravel..</p>
                                                    <div class="attachment">
                                                        <p>Attachment</p>
                                                        <a href="#">PHP_source_code.zip</a>
                                                    </div>
                                                    <p class="timestamp">1 days ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat-box">
                                        <form action="#">
                                            <textarea name="message" id="message" cols="30" rows="3" placeholder="Type a message here" class="form-control"></textarea>
                                            <div class="control">
                                                <div class="css-file attachment">
                                                    <a class="open-attachment"><i class="fa fa-file mrs"></i>ATTACHMENT</a>
                                                    <span class="file-info"></span>
                                                    <input type="file" class="file-input" id="attachment" />
                                                </div>
                                                <button type="submit" class="btn btn-primary plm prm">SEND</button>
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

@endsection