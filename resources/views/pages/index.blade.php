@extends('public')

@section('title', '- Home Page')

@section('content')

    <div class="container content-wrapper">
        <div class="featured-wrapper">
            <div class="row">
                <div class="col-md-8">
                    <div class="article-preview featured-large">
                        <div class="featured-image" data-featured="/images/featured/image25.jpg">
                            <div class="content">
                                <h4 class="category slide-category">Health</h4>
                                <h3><a href="article.html" class="slide-title">Research proves selfie can stimule happiness</a></h3>
                                <p class="slide-description hidden-xs">Study in University of Cragnain prove photo selfie can reduce stress
                                    and give positive impact. People who enjoy their photo as habit...</p>
                            </div>
                        </div>
                    </div>
                    <div class="featured-list">
                        <div class="slide">
                            <div class="article-preview featured-mini active">
                                <div class="featured-image">
                                    <img src="/images/misc/preloader.gif" alt="Featured 1" data-echo="/images/featured/image25.jpg"/>
                                    <div class="category-wrapper">
                                        <h4 class="category"><a href="category.html" class="src-category">Health</a></h4>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4 class="sub-category">Lifestyle</h4>
                                    <p><a href="article.html" class="src-title">Research proves selfie can stimule happiness</a></p>
                                    <p class="hidden src-description">Study in University of Cragnain prove photo selfie can reduce stress
                                        and give positive impact. People who enjoy their photo as habit...</p>
                                </div>
                            </div>
                        </div>
                        <div class="slide">
                            <div class="article-preview featured-mini">
                                <div class="featured-image">
                                    <img src="/images/misc/preloader.gif" alt="Featured 1" data-echo="/images/featured/image26.jpg"/>
                                    <div class="category-wrapper">
                                        <h4 class="category"><a href="category.html" class="src-category">Sport</a></h4>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4 class="sub-category">Extreme</h4>
                                    <p><a href="article.html" class="src-title">Hard journey into ice cave in the north</a></p>
                                    <p class="hidden src-description">Consectetur adipisicing elit. Accusamus ad
                                        aperiam assumenda aut adipisicing elit cum distinctio, doloremque ea facilis itaque...</p>
                                </div>
                            </div>
                        </div>
                        <div class="slide">
                            <div class="article-preview featured-mini">
                                <div class="featured-image">
                                    <img src="/images/misc/preloader.gif" alt="Featured 1" data-echo="/images/featured/image27.jpg"/>
                                    <div class="category-wrapper">
                                        <h4 class="category"><a href="category.html" class="src-category">Entertainment</a></h4>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4 class="sub-category">Film</h4>
                                    <p><a href="article.html" class="src-title">Release date prequel of Girl of Darkness</a></p>
                                    <p class="hidden src-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus ad
                                        aperiam assumenda aut consectetur, culpa cum distinctio, doloremque ea facilis itaque...</p>
                                </div>
                            </div>
                        </div>
                        <div class="slide">
                            <div class="article-preview featured-mini">
                                <div class="featured-image">
                                    <img src="/images/misc/preloader.gif" alt="Featured 1" data-echo="/images/featured/image28.jpg"/>
                                    <div class="category-wrapper">
                                        <h4 class="category"><a href="category.html" class="src-category">News</a></h4>
                                    </div>
                                </div>
                                <div class="content">
                                    <h4 class="sub-category">Government</h4>
                                    <p><a href="article.html" class="src-title">Financial crisis again, what we should do?</a></p>
                                    <p class="hidden src-description">Aperiam assumenda aut consectetur, culpa cum distinctio Lorem ipsum dolor sit amet, Accusamus ad
                                        doloremque consectetur adipisicing elit...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#popular" aria-controls="home" role="tab" data-toggle="tab">Most Popular</a>
                        </li>
                        <li role="presentation">
                            <a href="#commented" aria-controls="profile" role="tab" data-toggle="tab">Most Commented</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content featured-news">
                        <div role="tabpanel" class="tab-pane active" id="popular">
                            <ol>
                                <li><a href="article.html">
                                        <p class="number">01</p>
                                        <p>Water is founded on mars, NASA confirm newest life pontential.</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">02</p>
                                        <p>Electric vehicle became future of transportation</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">03</p>
                                        <p>Edit genome for the first time success on a large surgery</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">04</p>
                                        <p>Cancer become the most deadly desease past 3 years</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">05</p>
                                        <p>Team Obelix got the golden ticket in final game face Chronos</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">06</p>
                                        <p>People join the biggest party in the world, let's join the big crowd</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">07</p>
                                        <p>Muse release the new album after almost 2 years</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">08</p>
                                        <p>Finally it goes rain tonight on Jakarta after long summer</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">09</p>
                                        <p>Momentum of opimpic affect entire world business</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">10</p>
                                        <p>Man behind the gun, the old aphorism now become popular</p>
                                    </a></li>
                            </ol>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="commented">
                            <ol>
                                <li><a href="article.html">
                                        <p class="number">01</p>
                                        <p>People join the biggest party in the world, let's join the big crowd</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">02</p>
                                        <p>Muse release the new album after almost 2 years</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">03</p>
                                        <p>Electric vehicle became future of transportation</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">04</p>
                                        <p>Finally it goes rain tonight on Jakarta after long summer</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">05</p>
                                        <p>Water is founded on mars, NASA confirm newest life pontential.</p>
                                    </a></li>

                                <li><a href="article.html">
                                        <p class="number">06</p>
                                        <p>Edit genome for the first time success on a large surgery</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">07</p>
                                        <p>Cancer become the most deadly desease past 3 years</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">08</p>
                                        <p>Team Obelix got the golden ticket in final game face Chronos</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">09</p>
                                        <p>Man behind the gun, the old aphorism now become popular</p>
                                    </a></li>
                                <li><a href="article.html">
                                        <p class="number">10</p>
                                        <p>Momentum of opimpic affect entire world business</p>
                                    </a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="breadcrumb-wrapper mbs mts">
            <ol class="breadcrumb">
                <li><a href="#">Trending</a></li>
                <li class="blank"></li>
                <li class="blank"></li>
            </ol>
            <div class="control">
                <a class="btn btn-primary control-left" href="#"><i class="fa fa-chevron-left"></i></a>
                <a class="btn btn-primary control-right" href="#"><i class="fa fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="article-preview portrait">
                    <div class="featured-image">
                        <img src="/images/misc/preloader.gif" alt="Featured 1" data-echo="/images/featured/image1.jpg"/>
                    </div>
                    <div class="title-wrapper">
                        <p class="category"><a href="category.html">Entertainment</a></p>
                        <h1 class="title">
                            <a href="article.html">Reika make a dark theme on his new video clip</a>
                        </h1>
                        <ul class="timestamp">
                            <li>By <a href="profile.html">Angga Ari Wijaya</a></li>
                            <li>2 May 2016</li>
                            <li>355 Views</li>
                        </ul>
                    </div>
                    <article>
                        After success with single Don’t Let You Go, Reika the band from america starting create
                        ivideo clip. Black and white describe about the song that can make feels free...
                    </article>
                    <div class="rating-wrapper" data-rating="2"></div>
                    <p class="sub-category"><a href="category.html">International</a></p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="article-preview portrait">
                    <div class="featured-image">
                        <img src="/images/misc/preloader.gif" alt="Featured 2" data-echo="/images/featured/image2.jpg"/>
                    </div>
                    <div class="title-wrapper">
                        <p class="category"><a href="category.html">Technology</a></p>
                        <h1 class="title">
                            <a href="article.html">Google has release new concept od User Interface design</a>
                        </h1>
                        <ul class="timestamp">
                            <li>By <a href="profile.html">Imelda Dwi</a></li>
                            <li>14 February 2016</li>
                            <li>234 Views</li>
                        </ul>
                    </div>
                    <article>
                        Google I/O in San Fransisco late 2014 before announch new feature and service, one of them
                        is Material Design which can implement on web or android...
                    </article>
                    <div class="rating-wrapper" data-rating="3"></div>
                    <p class="sub-category"><a href="category.html">Internet</a></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="article-preview portrait">
                    <div class="featured-image">
                        <img src="/images/misc/preloader.gif" alt="Featured 4" data-echo="/images/featured/image3.jpg"/>
                    </div>
                    <div class="title-wrapper">
                        <p class="category"><a href="category.html">Science</a></p>
                        <h1 class="title">
                            <a href="article.html">Reika make a dark theme on his new video clip</a>
                        </h1>
                        <ul class="timestamp">
                            <li>By <a href="profile.html">Winda Aditiya</a></li>
                            <li>1 January 2016</li>
                            <li>53K Views</li>
                        </ul>
                    </div>
                    <article>
                        Research proves the earth’s air is more polluted than 10 years ago and this is should
                        become big concern for society to keep on guard and pay attention...
                    </article>
                    <div class="rating-wrapper" data-rating="2"></div>
                    <p class="sub-category"><a href="category.html">Research</a></p>
                </div>
            </div>
        </div>

        <div class="breadcrumb-wrapper mbs mts">
            <ol class="breadcrumb">
                <li><a href="#">Latest</a></li>
                <li class="blank"></li>
                <li class="blank"></li>
            </ol>
            <div class="control">
                <a class="btn btn-primary control-left" href="#"><i class="fa fa-chevron-left"></i></a>
                <a class="btn btn-primary control-right" href="#"><i class="fa fa-chevron-right"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="article-preview portrait">
                    <div class="featured-image">
                        <img src="/images/misc/preloader.gif" alt="Featured 4" data-echo="/images/featured/image4.jpg"/>
                    </div>
                    <div class="title-wrapper">
                        <p class="category"><a href="category.html">Entertainment</a></p>
                        <h1 class="title">
                            <a href="article.html">Reika make a dark theme on his new video clip</a>
                        </h1>
                        <ul class="timestamp">
                            <li>By <a href="profile.html">Angga Ari Wijaya</a></li>
                            <li>2 May 2016</li>
                            <li>355 Views</li>
                        </ul>
                    </div>
                    <article>
                        After success with single Don’t Let You Go, Reika the band from america starting create
                        ivideo clip. Black and white describe about the song that can make feels free...
                    </article>
                    <div class="rating-wrapper" data-rating="2"></div>
                    <p class="sub-category"><a href="category.html">International</a></p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="article-preview portrait">
                    <div class="featured-image">
                        <img src="/images/misc/preloader.gif" alt="Featured 5" data-echo="/images/featured/image5.jpg"/>
                    </div>
                    <div class="title-wrapper">
                        <p class="category"><a href="category.html">Technology</a></p>
                        <h1 class="title">
                            <a href="article.html">Google has release new concept od User Interface design</a>
                        </h1>
                        <ul class="timestamp">
                            <li>By <a href="profile.html">Imelda Dwi</a></li>
                            <li>14 February 2016</li>
                            <li>234 Views</li>
                        </ul>
                    </div>
                    <article>
                        Google I/O in San Fransisco late 2014 before announch new feature and service, one of them
                        is Material Design which can implement on web or android...
                    </article>
                    <div class="rating-wrapper" data-rating="4"></div>
                    <p class="sub-category"><a href="category.html">Internet</a></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="article-preview portrait">
                    <div class="featured-image">
                        <img src="/images/misc/preloader.gif" alt="Featured 6" data-echo="/images/featured/image6.jpg"/>
                    </div>
                    <div class="title-wrapper">
                        <p class="category"><a href="category.html">Science</a></p>
                        <h1 class="title">
                            <a href="article.html">Reika make a dark theme on his new video clip</a>
                        </h1>
                        <ul class="timestamp">
                            <li>By <a href="profile.html">Winda Aditiya</a></li>
                            <li>1 January 2016</li>
                            <li>53K Views</li>
                        </ul>
                    </div>
                    <article>
                        Research proves the earth’s air is more polluted than 10 years ago and this is should
                        become big concern for society to keep on guard and pay attention...
                    </article>
                    <div class="rating-wrapper" data-rating="5"></div>
                    <p class="sub-category"><a href="category.html">Research</a></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="tag category">Entertainment</div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="article-preview portrait">
                            <div class="featured-image">
                                <img src="/images/misc/preloader.gif" alt="Featured 7" data-echo="/images/featured/image7.jpg"/>
                            </div>
                            <div class="title-wrapper">
                                <h1 class="title">
                                    <a href="article.html">
                                        John Burn starting his career from a model and programmer
                                    </a>
                                </h1>
                                <ul class="timestamp">
                                    <li>By <a href="profile.html">Winda Aditiya</a></li>
                                    <li>1 January 2016</li>
                                    <li>53K Views</li>
                                </ul>
                            </div>
                            <article>
                                Every people is unique even we through the same way, school in same place, eat
                                similar breakfast, but we have defferent when pick a decision and emotion...
                            </article>
                            <div class="rating-wrapper" data-rating="3"></div>
                            <p class="sub-category"><a href="category.html">International</a></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="article-preview landscape mini">
                            <div class="row">
                                <div class="col-sm-5 col-xs-4">
                                    <div class="featured-image">
                                        <img src="/images/misc/preloader.gif" alt="Featured 8" data-echo="/images/featured/image8.jpg"/>
                                    </div>
                                </div>
                                <div class="col-sm-7 col-xs-8">
                                    <div class="title-wrapper">
                                        <h1 class="title">
                                            <a href="article.html">
                                                Bicyclist recommend warming up before exercising
                                            </a>
                                        </h1>
                                        <ul class="timestamp">
                                            <li>24 January 2016</li>
                                            <li>12 Views</li>
                                        </ul>
                                    </div>
                                    <div class="rating-wrapper" data-rating="2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="article-preview landscape mini">
                            <div class="row">
                                <div class="col-sm-5 col-xs-4">
                                    <div class="featured-image">
                                        <img src="/images/misc/preloader.gif" alt="Featured 9" data-echo="/images/featured/image9.jpg"/>
                                    </div>
                                </div>
                                <div class="col-sm-7 col-xs-8">
                                    <div class="title-wrapper">
                                        <h1 class="title">
                                            <a href="article.html">Extreme sport now more popular lately</a>
                                        </h1>
                                        <ul class="timestamp">
                                            <li>15 January 2016</li>
                                            <li>632 Views</li>
                                        </ul>
                                    </div>
                                    <div class="rating-wrapper" data-rating="2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="article-preview landscape mini">
                            <div class="row">
                                <div class="col-sm-5 col-xs-4">
                                    <div class="featured-image">
                                        <img src="/images/misc/preloader.gif" alt="Featured 10" data-echo="/images/featured/image10.jpg"/>
                                    </div>
                                </div>
                                <div class="col-sm-7 col-xs-8">
                                    <div class="title-wrapper">
                                        <h1 class="title">
                                            <a href="article.html">
                                                Sertification become necesarry as Coach
                                            </a>
                                        </h1>
                                        <ul class="timestamp">
                                            <li>12 January 2016</li>
                                            <li>173 Views</li>
                                        </ul>
                                    </div>
                                    <div class="rating-wrapper" data-rating="2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="article-preview landscape mini">
                            <div class="row">
                                <div class="col-sm-5 col-xs-4">
                                    <div class="featured-image">
                                        <img src="/images/misc/preloader.gif" alt="Featured 11" data-echo="/images/featured/image11.jpg"/>
                                    </div>
                                </div>
                                <div class="col-sm-7 col-xs-8">
                                    <div class="title-wrapper">
                                        <h1 class="title">
                                            <a href="article.html">
                                                Young people in Indonesia introduce importance of exercise
                                            </a>
                                        </h1>
                                        <ul class="timestamp">
                                            <li>18 January 2016</li>
                                            <li>12 Views</li>
                                        </ul>
                                    </div>
                                    <div class="rating-wrapper" data-rating="2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="tag category">Sport</div>
                        <div class="row">
                            <div class="col-md-12 col-sm-6 mbm">
                                <div class="article-preview portrait">
                                    <div class="featured-image">
                                        <img src="/images/misc/preloader.gif" alt="Featured 13" data-echo="/images/featured/image13.jpg"/>
                                        <div class="category-wrapper">
                                            <p class="sub-category"><a href="category.html">Soccer</a></p>
                                            <div class="rating-wrapper" data-rating="3"></div>
                                        </div>
                                    </div>
                                    <div class="title-wrapper">
                                        <h1 class="title">
                                            <a href="article.html">
                                                Football Supporter are going to watch the biggest game ever
                                            </a>
                                        </h1>
                                        <ul class="timestamp">
                                            <li>By <a href="profile.html">Angga Ari</a></li>
                                            <li>25 January 2016</li>
                                            <li>674 Views</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-6">
                                <div class="article-preview landscape mini">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-4">
                                            <div class="featured-image">
                                                <img src="/images/misc/preloader.gif" alt="Featured 14" data-echo="/images/featured/image14.jpg"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-7 col-xs-8">
                                            <div class="title-wrapper">
                                                <h1 class="title">
                                                    <a href="article.html">
                                                        Fishing world champion begin
                                                    </a>
                                                </h1>
                                                <ul class="timestamp">
                                                    <li>15 January 2016</li>
                                                    <li>212 Views</li>
                                                </ul>
                                            </div>
                                            <div class="rating-wrapper" data-rating="2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="article-preview landscape mini">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-4">
                                            <div class="featured-image">
                                                <img src="/images/misc/preloader.gif" alt="Featured 15" data-echo="/images/featured/image15.jpg"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-7 col-xs-8">
                                            <div class="title-wrapper">
                                                <h1 class="title">
                                                    <a href="article.html">
                                                        Running now the most popular and healthy quick training
                                                    </a>
                                                </h1>
                                                <ul class="timestamp">
                                                    <li>11 January 2016</li>
                                                    <li>72 Views</li>
                                                </ul>
                                            </div>
                                            <div class="rating-wrapper" data-rating="2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="article-preview landscape mini">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-4">
                                            <div class="featured-image">
                                                <img src="/images/misc/preloader.gif" alt="Featured 16" data-echo="/images/featured/image16.jpg"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-7 col-xs-8">
                                            <div class="title-wrapper">
                                                <h1 class="title">
                                                    <a href="article.html">
                                                        Home sport is alternative for modern people
                                                    </a>
                                                </h1>
                                                <ul class="timestamp">
                                                    <li>7 January 2016</li>
                                                    <li>643 Views</li>
                                                </ul>
                                            </div>
                                            <div class="rating-wrapper" data-rating="4"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="tag category">Economic</div>
                        <div class="row">
                            <div class="col-md-12 col-sm-6 mbm">
                                <div class="article-preview portrait">
                                    <div class="featured-image">
                                        <img src="/images/misc/preloader.gif" alt="Featured 12" data-echo="/images/featured/image12.jpg"/>
                                        <div class="category-wrapper">
                                            <p class="sub-category"><a href="category.html">Finance</a></p>
                                            <div class="rating-wrapper" data-rating="4"></div>
                                        </div>
                                    </div>
                                    <div class="title-wrapper">
                                        <h1 class="title">
                                            <a href="article.html">
                                                Micro business now  collec money from goverment program
                                            </a>
                                        </h1>
                                        <ul class="timestamp">
                                            <li>By <a href="profile.html">Rio Shika</a></li>
                                            <li>28 January 2016</li>
                                            <li>732 Views</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-6">
                                <div class="article-preview landscape mini">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-4">
                                            <div class="featured-image">
                                                <img src="/images/misc/preloader.gif" alt="Featured 17" data-echo="/images/featured/image17.jpg"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-7 col-xs-8">
                                            <div class="title-wrapper">
                                                <h1 class="title">
                                                    <a href="article.html">
                                                        Chef Technology Officer from Apple critics competitor
                                                    </a>
                                                </h1>
                                                <ul class="timestamp">
                                                    <li>13 January 2016</li>
                                                    <li>73 Views</li>
                                                </ul>
                                            </div>
                                            <div class="rating-wrapper" data-rating="2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="article-preview landscape mini">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-4">
                                            <div class="featured-image">
                                                <img src="/images/misc/preloader.gif" alt="Featured 18" data-echo="/images/featured/image18.jpg"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-7 col-xs-8">
                                            <div class="title-wrapper">
                                                <h1 class="title">
                                                    <a href="article.html">
                                                        Young businessman become popular figure
                                                    </a>
                                                </h1>
                                                <ul class="timestamp">
                                                    <li>8 January 2016</li>
                                                    <li>163 Views</li>
                                                </ul>
                                            </div>
                                            <div class="rating-wrapper" data-rating="2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="article-preview landscape mini">
                                    <div class="row">
                                        <div class="col-sm-5 col-xs-4">
                                            <div class="featured-image">
                                                <img src="/images/misc/preloader.gif" alt="Featured 20" data-echo="/images/featured/image20.jpg"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-7 col-xs-8">
                                            <div class="title-wrapper">
                                                <h1 class="title">
                                                    <a href="article.html">
                                                        Electronic get expensive everyday
                                                    </a>
                                                </h1>
                                                <ul class="timestamp">
                                                    <li>2 January 2016</li>
                                                    <li>53 Views</li>
                                                </ul>
                                            </div>
                                            <div class="rating-wrapper" data-rating="3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="tag category">Health</div>
                <div class="row">
                    <div class="col-md-12 col-sm-6">
                        <div class="article-preview portrait">
                            <div class="featured-image">
                                <img src="/images/misc/preloader.gif" alt="Featured 24" data-echo="/images/featured/image24.jpg"/>
                            </div>
                            <div class="title-wrapper">
                                <h1 class="title">
                                    <a href="article.html">
                                        Blend various healthy vegetable on breakfast
                                    </a>
                                </h1>
                                <ul class="timestamp">
                                    <li>By <a href="profile.html">Mitha Nita</a></li>
                                    <li>23 February 2016</li>
                                    <li>82 Views</li>
                                </ul>
                            </div>
                            <article>
                                An egg can provide energy for a day, but sometime we doing exercise, stay up until
                                midnight and so on. We need more extra calories from our food specially...
                            </article>
                            <div class="rating-wrapper" data-rating="3"></div>
                            <p class="sub-category"><a href="category.html">Lifestyle</a></p>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6">
                        <div class="article-preview landscape mini">
                            <div class="row">
                                <div class="col-sm-5 col-xs-4">
                                    <div class="featured-image">
                                        <img src="/images/misc/preloader.gif" alt="Featured 19" data-echo="/images/featured/image19.jpg"/>
                                    </div>
                                </div>
                                <div class="col-sm-7 col-xs-8">
                                    <div class="title-wrapper">
                                        <h1 class="title">
                                            <a href="article.html">
                                                People grow old and dying like always
                                            </a>
                                        </h1>
                                        <ul class="timestamp">
                                            <li>22 January 2016</li>
                                            <li>912 Views</li>
                                        </ul>
                                    </div>
                                    <div class="rating-wrapper" data-rating="3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="article-preview landscape mini">
                            <div class="row">
                                <div class="col-sm-5 col-xs-4">
                                    <div class="featured-image">
                                        <img src="/images/misc/preloader.gif" alt="Featured 21" data-echo="/images/featured/image21.jpg"/>
                                    </div>
                                </div>
                                <div class="col-sm-7 col-xs-8">
                                    <div class="title-wrapper">
                                        <h1 class="title">
                                            <a href="article.html">
                                                Now doctor consultation can be accessed at home
                                            </a>
                                        </h1>
                                        <ul class="timestamp">
                                            <li>18 January 2016</li>
                                            <li>46 Views</li>
                                        </ul>
                                    </div>
                                    <div class="rating-wrapper" data-rating="4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="article-preview landscape mini">
                            <div class="row">
                                <div class="col-sm-5 col-xs-4">
                                    <div class="featured-image">
                                        <img src="/images/misc/preloader.gif" alt="Featured 22" data-echo="/images/featured/image22.jpg"/>
                                    </div>
                                </div>
                                <div class="col-sm-7 col-xs-8">
                                    <div class="title-wrapper">
                                        <h1 class="title">
                                            <a href="article.html">
                                                Doctor is the one of exellent job can make you rich
                                            </a>
                                        </h1>
                                        <ul class="timestamp">
                                            <li>14 January 2016</li>
                                            <li>784 Views</li>
                                        </ul>
                                    </div>
                                    <div class="rating-wrapper" data-rating="2"></div>
                                </div>
                            </div>
                        </div>
                        <div class="article-preview landscape mini">
                            <div class="row">
                                <div class="col-sm-5 col-xs-4">
                                    <div class="featured-image">
                                        <img src="/images/misc/preloader.gif" alt="Featured 23" data-echo="/images/featured/image23.jpg"/>
                                    </div>
                                </div>
                                <div class="col-sm-7 col-xs-8">
                                    <div class="title-wrapper">
                                        <h1 class="title">
                                            <a href="article.html">
                                                Surgery team X desease success healing Vcro Virus
                                            </a>
                                        </h1>
                                        <ul class="timestamp">
                                            <li>12 January 2016</li>
                                            <li>623 Views</li>
                                        </ul>
                                    </div>
                                    <div class="rating-wrapper" data-rating="3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tag category">Advertisement</div>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="http://angga-ari.com" target="_blank">
                            <h3>New Macbook Air Just $1200</h3>
                            <p>KeepShop.id is selling new the product of apple mid 2016 Macbook Air Core i5 4 GB of
                                RAM</p>
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="http://angga-ari.com" target="_blank">
                            <h3>The Most Advanced Technology</h3>
                            <p>We provide internet for your office, home, and education purpose with full guarantee
                                and services</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mobile mtl" data-stellar-background-ratio="0.3">
        <div class="container">
            <h2>Keep in touch with us</h2>
            <h1>MOBILE EVERYWHERE</h1>
            <p class="lead">Don’t be nerd and keep up-to date with your handheld</p>
            <p class="mbm mtl">Available on Android and iOS, so hurry get it now on:</p>
            <a class="btn btn-outline btn-light btn-mobile" href="http://play.google.com" target="_blank">
                <i class="fa fa-android"></i>
                <h3>ANDROID</h3>
                <p>PLAY STORE</p>
            </a>
            <a class="btn btn-outline btn-light btn-mobile" href="http://itunes.apple.com" target="_blank">
                <i class="fa fa-apple"></i>
                <h3>APPLE iOS</h3>
                <p>APP STORE</p>
            </a>
            <img src="/images/misc/mobile.png" class="hidden-xs" alt="Mobile Application" data-stellar-ratio="1.45"/>
        </div>
    </div>

    <div class="container">
        <div class="section">
            <div class="title">
                <h1>SUPPORTED BY</h1>
                <p class="lead">InfoGue.id was supported by awesome startup and company</p>
            </div>
            <ul class="company-list">
                <li><a href="http://www.google.com?q=mountain" target="_blank">
                        <img src="/images/misc/mountain.png" alt="Sleeping Mountain"/></a>
                </li>
                <li><a href="http://www.google.com?q=redcode" target="_blank">
                        <img src="/images/misc/redcode.png" alt="Redcode Deliver"/></a>
                </li>
                <li><a href="http://www.google.com?q=vana" target="_blank">
                        <img src="/images/misc/vana.png" alt="Vana Internet Provider"/></a>
                </li>
                <li><a href="http://www.google.com?q=express" target="_blank">
                        <img src="/images/misc/express.png" alt="Express"/></a>
                </li>
                <li><a href="http://www.google.com?q=magnive" target="_blank">
                        <img src="/images/misc/magnive.png" alt="Magnive"/></a>
                </li>
                <li><a href="http://www.google.com?q=frezze" target="_blank">
                        <img src="/images/misc/frezze.png" alt="Frezzer"/></a>
                </li>
                <li><a href="http://www.google.com?q=bluewave" target="_blank">
                        <img src="/images/misc/bluewave.png" alt="Bluewave"/></a>
                </li>
                <li><a href="http://www.google.com?q=smiles" target="_blank">
                        <img src="/images/misc/smiles.png" alt="Smiles"/></a>
                </li>
            </ul>
        </div>
    </div>

@endsection


<div class="modal fade newsletter no-line" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">INFOGUE.ID</h4>
            </div>
            <div class="modal-body">
                <h1 class="hidden-xs"><i class="fa fa-envelope-o mbs"></i></h1>
                <h3>ENTER YOUR EMAIL AND GET</h3>
                <h1>NEWSLETTER</h1>
                <P>Subscribe to our Newsletter and receive knowledge everyday</P>
                <form action="#">
                    <div class="form-group">
                        <button type="button" class="btn btn-primary subscribe"><i class="fa fa-envelope-o visible-xs"></i><span class="hidden-xs">SUBSCRIBE</span></button>
                        <input type="email" class="form-control" placeholder="EMAIL ADDRESS"/>
                    </div>
                </form>
                <a href="#" data-dismiss="modal" class="dismiss">NO THANKS</a>
                <p class="small">We Promise don't spam<span class="hidden-xs"> and use your email for weird purpose</span></p>
                <p class="small">See our policy at <a href="term.html">Terms</a> and <a href="privacy.html">Privacy</a></p>
            </div>
            <div class="modal-footer">
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->