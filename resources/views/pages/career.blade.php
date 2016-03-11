@extends('public')

@section('title', '- Career')

@section('content')
    <!-- begin of container-wrapper -->
    <section class="container content-wrapper">
        <!-- begin of breadcrumb -->
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="{{ route('article.archive') }}">Archive</a></li>
                <li class="active">Career</li>
                <li class="blank"></li>
            </ol>
            <div class="control hidden-xs">
                <a class="btn btn-primary control-left" href="{{ route('page.terms') }}">
                    <i class="fa fa-chevron-left"></i>
                </a>
                <a class="btn btn-primary control-right" href="{{ route('page.faq') }}">
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
                    <h1>Career</h1>

                    <h3>Work With Us</h3>
                    <p>The InfoGue.id is a global media organization dedicated to enhancing society by creating,
                        collecting and distributing high-quality news and information. The company includes Infogue.id,
                        Infogue Redaction, and related properties. It is known globally for excellence in its
                        journalism, and innovation in its print and digital storytelling and its
                        business model. Follow news about the company at @infogue.</p>
                    <div class="mtm mbm hidden-xs"
                         style="background: url('{{ asset('images/misc/office-space.jpg') }}') center center / cover;
                                 height: 300px" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="50">
                    </div>
                    <p>We are shaping the direction of online news and media during a critical juncture for the
                        industry. It is our goal to set the bar for the information age and continue to seek talent who
                        can help us bring our audience the "next next thing" in journalism, entertainment, education,
                        and ideas. We offer a comprehensive and competitive benefits package which includes medical,
                        dental and vision plans for employees and their families, health and wellness programs, a 401(k)
                        plan, tuition reimbursement, paid vacation, paid parental leave and much more.</p>

                    <h3>Occupancy</h3>
                    <p>The InfoGUe.id is an Equal Opportunity Employer and does not discriminate on the basis of an
                        individual's sex, age, race, color, creed, national origin, alienage, religion, marital status,
                        pregnancy, sexual orientation or affectional preference, gender identity and expression,
                        disability, genetic trait or predisposition, carrier status, citizenship, veteran or military
                        status and other personal characteristics protected by law. All applications will receive
                        consideration for employment without regard to legally protected characteristics.</p>

                    <h3>Contact</h3>
                    <p>If you are experiencing difficulties with this site, you can contact our support team</p>
                    <div class="contact">
                        <p>{{ $site_settings['Address'] }}</p>

                        <p><a href="tel:{{ $site_settings['Contact'] }}">{{ $site_settings['Contact'] }}</a></p>

                        <p><a href="mailto:{{ $site_settings['Email'] }}">{{ $site_settings['Email'] }}</a></p>
                    </div>
                    <ul class="social mln">
                        <li class="pln">
                            <a href="{{ $site_settings['Facebook'] }}" class="facebook">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $site_settings['Twitter'] }}" class="twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="{{ $site_settings['Google Plus'] }}" class="googleplus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                    </ul>
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