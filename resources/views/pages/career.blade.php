@extends('public')

@section('title', '- Career')

@section('content')

    <section class="container content-wrapper">
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="archive.html">Archive</a></li>
                <li class="active">Career</li>
                <li class="blank"></li>
            </ol>
            <div class="control hidden-xs">
                <a class="btn btn-primary control-left" href="term.html"><i class="fa fa-chevron-left"></i></a>
                <a class="btn btn-primary control-right" href="faq.html"><i class="fa fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="row static-page">
            <div class="col-md-3">
                <nav class="static-nav hidden-xs hidden-sm">
                    <ul>
                        <li><a href="editorial.html">Editorial</a></li>
                        <li><a href="privacy.html">Privacy</a></li>
                        <li><a href="disclaimer.html">Disclaimer</a></li>
                        <li><a href="term.html">Terms</a></li>
                        <li class="active"><a href="career.html">Career</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-9">
                <article>
                    <h1>Career</h1>

                    <h3>Work With Us</h3>

                    <p>The InfoGue.id is a global media organization dedicated to enhancing society by creating, collecting
                        and distributing high-quality news and information. The company includes The New York Times,
                        International New York Times, NYTimes.com, INYT.com and related properties. It is known globally for
                        excellence in its journalism, and innovation in its print and digital storytelling and its business
                        model. Follow news about the company at @infogue.</p>

                    <div class="mtm mbm hidden-xs" style="background: url('/images/misc/office-space.jpg') center center / cover; height: 300px" data-stellar-background-ratio="0.5" data-stellar-vertical-offset="50"></div>

                    <p>We are shaping the direction of online news and media during a critical juncture for the industry. It
                        is our goal to set the bar for the information age and continue to seek talent who can help us bring
                        our audience the “next next thing” in journalism, entertainment, education, and ideas. We offer a
                        comprehensive and competitive benefits package which includes medical, dental and vision plans for
                        employees and their families, health and wellness programs, a 401(k) plan, tuition reimbursement,
                        paid vacation, paid parental leave and much more.</p>

                    <h3>Occupancy</h3>

                    <p>The InfoGUe.id is an Equal Opportunity Employer and does not discriminate on the basis of an
                        individual's sex, age, race, color, creed, national origin, alienage, religion, marital status,
                        pregnancy, sexual orientation or affectional preference, gender identity and expression, disability,
                        genetic trait or predisposition, carrier status, citizenship, veteran or military status and other
                        personal characteristics protected by law. All applications will receive consideration for
                        employment without regard to legally protected characteristics.</p>

                    <h3>Contact</h3>
                    <p>If you are experiencing difficulties with this site, you can contact our support team</p>
                    <div class="contact">
                        <p>Avenue Street 34 - East Java, Indonesia</p>
                        <p><a href="tel:+628565547868">(+62) 8565547868</a></p>
                        <p><a href="mailto:editorial@infogue.com">editorial@infogue.com</a></p>
                    </div>
                    <ul class="social mln">
                        <li class="pln"><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </article>

                <ul class="timestamp">
                    <li class="pull-left"><img src="images/contributors/angga.jpg" class="avatar img-circle"/> By <a href="profile.html">Administrator</a></li>
                    <li class="pull-right"><span class="hidden-xs">Last Updated</span> At 23 January 2016</li>
                </ul>
            </div>
        </div>
    </section>

@endsection