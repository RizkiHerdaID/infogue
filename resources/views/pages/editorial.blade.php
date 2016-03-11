@extends('public')

@section('title', '- Editorial')

@section('content')

    <section class="container content-wrapper">
        <!-- begin of breadcrumb -->
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="{{ route('article.archive') }}">Archive</a></li>
                <li class="active">Editorial</li>
                <li class="blank"></li>
            </ol>
            <div class="control hidden-xs">
                <a class="btn btn-primary control-left" href="{{ route('page.contact') }}">
                    <i class="fa fa-chevron-left"></i>
                </a>
                <a class="btn btn-primary control-right" href="{{ route('page.privacy') }}">
                    <i class="fa fa-chevron-right"></i>
                </a>
            </div>
        </div>
        <!-- begin of breadcrumb -->

        <!-- begin of static-page -->
        <div class="row static-page">
            <div class="col-md-3">
                @include('pages._static_navigation')
            </div>
            <div class="col-md-9">
                <article>
                    <h1>Editorial</h1>

                    <h3>Meet Our Team</h3>
                    <p>Listed below are links to biographies of a selection of InfoGue.id staff.</p>

                    <p>A list of those staff the InfoGue.id publishes salaries and remuneration for can be found on the
                        senior management bellow. Former senior InfoGue.id staff are aggregated on the archive page</p>

                    <div class="row mtm mbm">
                        <div class="col-sm-3 col-xs-6">
                            <div class="member text-center">
                                <img src="{{ asset('images/misc/editor_1.jpg') }}" width="120"
                                     class="img-circle img-responsive center-block"/>
                                <h3 class="mbn">Freddie Arif</h3>
                                <p class="text-muted">Lead Editor</p>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="member text-center">
                                <img src="{{ asset('images/misc/editor_2.jpg') }}" width="120"
                                     class="img-circle img-responsive center-block"/>
                                <h3 class="mbn">Shaka Bellen</h3>
                                <p class="text-muted">Web Developer</p>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="member text-center">
                                <img src="{{ asset('images/misc/editor_3.jpg') }}" width="120"
                                     class="img-circle img-responsive center-block"/>
                                <h3 class="mbn">Dewi Andriane</h3>
                                <p class="text-muted">Digital Artist</p>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="member text-center">
                                <img src="{{ asset('images/misc/editor_4.jpg') }}" width="120"
                                     class="img-circle img-responsive center-block"/>
                                <h3 class="mbn">Rendi Afrana</h3>
                                <p class="text-muted">Senior Writter</p>
                            </div>
                        </div>
                    </div>

                    <h3>Editorial Structure</h3>
                    <p>Regardless of the point of view or length of the editorial, there is a preferred structure for
                        writing it.
                    </p>

                    <h3>Introduction</h3>
                    <p>State your topic up front, explain its history and affirm why it is relevant and who is affected
                        by it. Clearly word your opinion and the main reason you have embraced it.
                    </p>

                    <h3>Body</h3>
                    <p>Support your position with another reason. Acknowledge counter arguments and opinions. Present
                        relevant facts and statistics and include ethical or moral reasons for your stand. Give an
                        example  of what you think would be the best approach to or outcome of the situation.
                    </p>

                    <h3>Conclusion</h3>
                    <p>Make an emotional or passionate statement regarding why your opinion or proposed solution is
                        better than others. Tie up the piece by clearly restating your stance.
                    </p>

                    <h3>Editorial Writing Tips</h3>
                    <p>To keep the piece professional and powerful, keep some guidelines in mind while writing the
                        editorial.
                    </p>

                    <ol>
                        <li>Cite positions and quotes from community and business leaders, politicians or applicable
                            business professionals to support your views and present informed arguments.
                        </li>
                        <li>Avoid using first person syntax. Although the editorial is your opinion, using the word "I"
                            weakens the impact of your statements and makes it sound like you are whining rather than
                            offering viable comments or solutions. Cleverly word your statements and opinions so they
                            read like facts.
                        </li>
                        <li>Keep on topic and avoid rambling. Succinctly stated arguments are the most effective.</li>
                    </ol>
                </article>

                <ul class="timestamp">
                    <li class="pull-left">
                        <img src="{{ asset('images/contributors/avatar_1.jpg') }}" class="avatar img-circle"/>
                        By <a href="#">Administrator</a>
                    </li>
                    <li class="pull-right">
                        <span class="hidden-xs">Last Updated</span> At 23 January 2016
                    </li>
                </ul>
            </div>
        </div>
        <!-- end of static-page -->
    </section>
    <!-- end of container-wrapper -->

@endsection