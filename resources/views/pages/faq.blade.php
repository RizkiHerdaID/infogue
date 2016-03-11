@extends('public')

@section('title', '- FAQ')

@section('content')

    <section class="container content-wrapper">
        <!-- begin of breadcrumb -->
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="{{ route('article.archive') }}">Archive</a></li>
                <li class="active">FAQ Ask question</li>
                <li class="blank"></li>
            </ol>
            <div class="control hidden-xs">
                <a class="btn btn-primary control-left" href="{{ route('page.career') }}">
                    <i class="fa fa-chevron-left"></i>
                </a>
                <a class="btn btn-primary control-right" href="{{ route('page.contact') }}">
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
                <article class="faq">
                    <h1>Frequently Ask question</h1>

                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <h3 class="mbn pts">Subscriptions</h3>

                        <p>Member access and digital content</p>

                        <div class="panel panel-default">
                            <div class="panel-heading active" role="tab" id="headingOne">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                       aria-expanded="true" aria-controls="collapseOne">
                                        How can I receive home delivery of InfoGue.id?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                 aria-labelledby="headingOne">
                                <div class="panel-body">
                                    InfoGue is not available for home delivery we just provide digital information. For
                                    more information concerning home delivery, please call
                                    {{ $site_settings['Contact'] }}. For more information regarding mail subscriptions,
                                    please call {{ $site_settings['Contact'] }}. Information on subscriptions is also
                                    available through our subscriber services website at {{ route('index') }}
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Does InfoGue provide premium content to individuals or organizations?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    Due to the vast number of requests we receive, The InfoGue.id refuses all requests
                                    for complimentary copies, subscriptions and souvenirs, no matter how worthy the
                                    cause.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Can I subscribe to just The InfoGue.id Book Review?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingThree">
                                <div class="panel-body">
                                    InfoGue.id Book Review contains authoritative reviews (more than 2,000 a year),
                                    author interviews, lists of best selling and recommended books, and intelligent
                                    coverage of the book world. You can subscribe separately to the Sunday InfoGue.id
                                    Book Review by calling {{ $site_settings['Contact'] }} or going to
                                    {{ route('page.contact') }}.
                                </div>
                            </div>
                        </div>

                        <h3 class="mbn pts">Correspondence</h3>

                        <p>How to contribute and review news and article</p>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        How do I submit a letter to the editor?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingFour">
                                <div class="panel-body">
                                    <p>The InfoGue.id welcomes the opinions and views of its readers. Letters to the
                                        editor must include your name, address, and a daytime telephone number and be
                                        addressed to: Letters to the Editor, The InfoGue.id,
                                        {{ $site_settings['Address'] }}. Letters may also be sent by phone
                                        {{ $site_settings['Contact'] }} or by email
                                        to {{ $site_settings['Email'] }}.</p>

                                    <p>InfoGue.id does not accept open or third party submissions, and submission does
                                        not guarantee publication. For more information, please call
                                        {{ $site_settings['Contact'] }}.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFive">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        How can I obtain the email address of a InfoGue reporter or editor?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingFive">
                                <div class="panel-body">
                                    <p>Readers may send email to reporters through infogue.id. For each story carrying
                                        an underlined byline, readers can click on the byline to access an email form;
                                        those emails are delivered once a day to staff reporters. Some bylines are not
                                        underlined; those are not linked to the form. Over time, we are adding those
                                        names to links that direct reader mail to the department generating the article.
                                    </p>

                                    <p>Due to the volume of mail, you may not receive a reply.</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingSix">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        How may I write to the editors about news coverage or report an error?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingSix">
                                <div class="panel-body">
                                    Comments and suggestions may be emailed to {{ $site_settings['Email'] }} or
                                    telephoned {{ $site_settings['Contact'] }}. The comment or correction will reach an
                                    appropriate editor promptly. Ordinarily a comment about news coverage will receive
                                    an individual reply. And we do pay respectful attention to all messages, even those
                                    that are part of organized letter-writing campaigns, for which we are not staffed to
                                    reply individually. A correction generally takes two or three days to appear on Page
                                    A2, after fact checking.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingSeven">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                        Does InfoGue.id have an ombudsman or public editor?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingSeven">
                                <div class="panel-body">
                                    {{ $site_settings['Owner'] }} is the public editor, the designated representative
                                    of the newspaper’s readers. Her role is to address readers’ comments about
                                    coverage, to raise questions of her own and to write about such matters, in
                                    commentaries published as often as she wishes. Her column appears in the opinion
                                    pages on Sundays, though not necessarily every week. {{ $site_settings['Owner'] }}
                                    email address is {{ $site_settings['Email'] }}. Telephone messages may be left at
                                    {{ $site_settings['Contact'] }}. The public editor’s recent columns, with her web
                                    journal  and a reader forum, can be found at {{ route('index') }}.
                                </div>
                            </div>
                        </div>

                        <h3 class="mbn pts">Placing Information in InfoGue.id</h3>

                        <p>Advertising and buy our service as news portal</p>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingEight">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                        How do I place a classified ad in The InfoGue.id?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseEight" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingEight">
                                <div class="panel-body">
                                    For information about placing a classified ad, visit {{ route('page.contact') }}
                                    or call {{ $site_settings['Contact'] }}.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingNine">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                                        How do I submit a Weddings/Celebrations announcement?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseNine" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingNine">
                                <div class="panel-body">
                                    For information about submitting a wedding or celebration announcement, call (212)
                                    556-7325 or email {{ $site_settings['Email'] }}. Submissions may be sent by email to
                                    {{ $site_settings['Email'] }} or by phone on {{ $site_settings['Contact'] }}. To
                                    obtain a high-quality reprint of a wedding or celebration announcement that appeared
                                    in InfoGue.id, please call PARS International at (212) 221-9595, extension 210, or
                                    visit {{ route('index') }} to order
                                    online.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTen">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                                        Does InfoGue.id have a personals column?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTen" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingTen">
                                <div class="panel-body">
                                    InfoGue Personals appears each Sunday in The City section, Long Island Weekly,
                                    Connecticut Weekly. Call {{ $site_settings['Contact'] }}
                                    for more information or to place a personal advertisement.
                                </div>
                            </div>
                        </div>

                        <h3 class="mbn pts">Access to InfoGue Content</h3>

                        <p>General web and content integrity</p>

                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingEleven">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                                        How do I obtain permission to reprint material from InfoGue.id?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingEleven">
                                <div class="panel-body">
                                    To obtain permission to license or republish InfoGue text, including InfoGue
                                    articles with photos/illustrations, visit {{ route('page.contact') }},
                                    or call {{ $site_settings['Contact'] }}, or email {{ $site_settings['Email'] }}.
                                    For permission to license or republish InfoGue photos, call Redux Pictures at
                                    (212) 253-0399. For academic uses or photocopying, call (978) 750 8400 or visit
                                    http://copyright.com.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwelve">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                                        Does the full news report of The InfoGue.id appear on the Web?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingTwelve">
                                <div class="panel-body">
                                    InfoGue.com offers all articles from the daily and Sunday editions of the newspaper,
                                    as well as updated news and analysis throughout the day by journalists from The
                                    InfoGue.id.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThirteen">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                       href="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                                        Are the homepages of InfoGue.id archived online by day?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThirteen" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="headingThirteen">
                                <div class="panel-body">
                                    The homepage of InfoGue.com is archived throughout the day. If you are interested in
                                    seeing a particular article or date, search InfoGue.id’s online archives via the
                                    search bar on InfoGue.id Topics page.
                                </div>
                            </div>
                        </div>
                    </div>
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