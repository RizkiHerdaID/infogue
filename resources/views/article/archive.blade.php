@extends('public')

@section('title', '- Archive')

@section('content')

    <section class="container content-wrapper">
        <div class="data-filter">
            <div class="data">
                <p class="hidden-xs">Data Filter</p>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown-data" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        All Data
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-data">
                        <li><a href="#">All Data</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">CATEGORY</li>
                        <li><a href="#">News</a></li>
                        <li><a href="#">Economic</a></li>
                        <li><a href="#">Entertainment</a></li>
                        <li><a href="#">Sport</a></li>
                        <li><a href="#">Health</a></li>
                        <li><a href="#">Science</a></li>
                        <li><a href="#">Technology</a></li>
                        <li><a href="#">Photo</a></li>
                        <li><a href="#">Video</a></li>
                        <li><a href="#">Others</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">HEADLINE</li>
                        <li><a href="#">Trending</a></li>
                        <li><a href="#">Latest</a></li>
                        <li><a href="#">Popular</a></li>
                    </ul>
                </div>
            </div>
            <div class="view hidden-xs">
                <p>View As</p>
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" name="view" id="list" autocomplete="off" checked>
                        <i class="fa fa-reorder"></i>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" name="view" id="grid" autocomplete="off">
                        <i class="fa fa-th"></i>
                    </label>
                </div>
            </div>
            <div class="sort">
                <p class="hidden-xs">Sort By</p>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown-sort-type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Date
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                        <li><a href="#">Date</a></li>
                        <li><a href="#">Stars</a></li>
                        <li><a href="#">Views</a></li>
                        <li><a href="#">Comments</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown-sort-method" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Ascending
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort">
                        <li><a href="#">Ascending</a></li>
                        <li><a href="#">Descending</a></li>
                        <li><a href="#">Shuffle</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="article-wrapper">
            <div id="articles">
                <div class="article-preview landscape">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="featured-image">
                                <img src="images/misc/preloader.gif" alt="Featured 8" data-echo="images/featured/image8.jpg"/>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="title-wrapper">
                                <p class="category"><a href="category.html">Entertainment</a></p>
                                <h1 class="title">
                                    <a href="article.html">
                                        Bicyclist recommend warming up before exercising
                                    </a>
                                </h1>
                                <ul class="timestamp">
                                    <li>By <a href="profile.html">Wanda</a></li>
                                    <li>28 April 2016</li>
                                    <li>48 Views</li>
                                </ul>
                            </div>
                            <article>
                                After success with single Don’t Let You Go, Reika the band from america starting create
                                video clip. Black and white describe about the song that can make fans feel deep and free.
                                This production spend a lot of money, concert in New York last...
                            </article>
                            <div class="rating-wrapper" data-rating="2"></div>
                            <ul class="social text-right">
                                <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="article-preview landscape">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="featured-image">
                                <img src="images/misc/preloader.gif" alt="Featured 9" data-echo="images/featured/image9.jpg"/>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="title-wrapper">
                                <p class="category"><a href="category.html">Entertainment</a></p>
                                <h1 class="title">
                                    <a href="article.html">
                                        Extreme sport now more popular lately
                                    </a>
                                </h1>
                                <ul class="timestamp">
                                    <li>By <a href="profile.html">Angga Ari Wijaya</a></li>
                                    <li>2 May 2016</li>
                                    <li>355 Views</li>
                                </ul>
                            </div>
                            <article>
                                After success with single Don’t Let You Go, Reika the band from america starting create
                                video clip. Black and white describe about the song that can make fans feel deep and free.
                                This production spend a lot of money, concert in New York last...
                            </article>
                            <div class="rating-wrapper" data-rating="2"></div>
                            <ul class="social text-right">
                                <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="article-preview landscape">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="featured-image">
                                <img src="images/misc/preloader.gif" alt="Featured 15" data-echo="images/featured/image15.jpg"/>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="title-wrapper">
                                <p class="category"><a href="category.html">Sport</a></p>
                                <h1 class="title">
                                    <a href="article.html">
                                        Certification become necessary as Coach
                                    </a>
                                </h1>
                                <ul class="timestamp">
                                    <li>By <a href="profile.html">Friska Minima</a></li>
                                    <li>2 April 2016</li>
                                    <li>73 Views</li>
                                </ul>
                            </div>
                            <article>
                                After success with single Don’t Let You Go, Reika the band from america starting create
                                video clip. Black and white describe about the song that can make fans feel deep and free.
                                This production spend a lot of money, concert in New York last...
                            </article>
                            <div class="rating-wrapper" data-rating="2"></div>
                            <ul class="social text-right">
                                <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="article-preview landscape">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="featured-image">
                                <img src="images/misc/preloader.gif" alt="Featured 11" data-echo="images/featured/image11.jpg"/>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="title-wrapper">
                                <p class="category"><a href="category.html">Entertainment</a></p>
                                <h1 class="title">
                                    <a href="article.html">
                                        Young people in Indonesia introduce importance of exercise
                                    </a>
                                </h1>
                                <ul class="timestamp">
                                    <li>By <a href="profile.html">Ajeng Putri</a></li>
                                    <li>12 March 2016</li>
                                    <li>63 Views</li>
                                </ul>
                            </div>
                            <article>
                                After success with single Don’t Let You Go, Reika the band from america starting create
                                video clip. Black and white describe about the song that can make fans feel deep and free.
                                This production spend a lot of money, concert in New York last...
                            </article>
                            <div class="rating-wrapper" data-rating="2"></div>
                            <ul class="social text-right">
                                <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="article-preview landscape">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="featured-image">
                                <img src="images/misc/preloader.gif" alt="Featured 12" data-echo="images/featured/image12.jpg"/>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="title-wrapper">
                                <p class="category"><a href="category.html">Economic</a></p>
                                <h1 class="title">
                                    <a href="article.html">
                                        Micro business now collec money from goverment program
                                    </a>
                                </h1>
                                <ul class="timestamp">
                                    <li>By <a href="profile.html">Diaz Pratama</a></li>
                                    <li>2 May 2016</li>
                                    <li>355 Views</li>
                                </ul>
                            </div>
                            <article>
                                After success with single Don’t Let You Go, Reika the band from america starting create
                                video clip. Black and white describe about the song that can make fans feel deep and free.
                                This production spend a lot of money, concert in New York last...
                            </article>
                            <div class="rating-wrapper" data-rating="2"></div>
                            <ul class="social text-right">
                                <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="article-preview landscape">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="featured-image">
                                <img src="images/misc/preloader.gif" alt="Featured 13" data-echo="images/featured/image13.jpg"/>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="title-wrapper">
                                <p class="category"><a href="category.html">Sport</a></p>
                                <h1 class="title">
                                    <a href="article.html">
                                        Football Supporter are going to watch the biggest game ever
                                    </a>
                                </h1>
                                <ul class="timestamp">
                                    <li>By <a href="profile.html">Angga Ari Wijaya</a></li>
                                    <li>16 February 2016</li>
                                    <li>854 Views</li>
                                </ul>
                            </div>
                            <article>
                                After success with single Don’t Let You Go, Reika the band from america starting create
                                video clip. Black and white describe about the song that can make fans feel deep and free.
                                This production spend a lot of money, concert in New York last...
                            </article>
                            <div class="rating-wrapper" data-rating="2"></div>
                            <ul class="social text-right">
                                <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="article-preview landscape">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="featured-image">
                                <img src="images/misc/preloader.gif" alt="Featured 23" data-echo="images/featured/image23.jpg"/>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="title-wrapper">
                                <p class="category"><a href="category.html">Health</a></p>
                                <h1 class="title">
                                    <a href="article.html">
                                        Surgery team X desease success healing Vcro Virus
                                    </a>
                                </h1>
                                <ul class="timestamp">
                                    <li>By <a href="profile.html">Angga Ari Wijaya</a></li>
                                    <li>26 January 2016</li>
                                    <li>237 Views</li>
                                </ul>
                            </div>
                            <article>
                                After success with single Don’t Let You Go, Reika the band from america starting create
                                video clip. Black and white describe about the song that can make fans feel deep and free.
                                This production spend a lot of money, concert in New York last...
                            </article>
                            <div class="rating-wrapper" data-rating="2"></div>
                            <ul class="social text-right">
                                <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="article-preview landscape">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="featured-image">
                                <img src="images/misc/preloader.gif" alt="Featured 24" data-echo="images/featured/image24.jpg"/>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="title-wrapper">
                                <p class="category"><a href="category.html">Sport</a></p>
                                <h1 class="title">
                                    <a href="article.html">
                                        New begin, Journey to the center of the Earth
                                    </a>
                                </h1>
                                <ul class="timestamp">
                                    <li>By <a href="profile.html">Yoga Azura</a></li>
                                    <li>12 January 2016</li>
                                    <li>364 Views</li>
                                </ul>
                            </div>
                            <article>
                                After success with single Don’t Let You Go, Reika the band from america starting create
                                video clip. Black and white describe about the song that can make fans feel deep and free.
                                This production spend a lot of money, concert in New York last...
                            </article>
                            <div class="rating-wrapper" data-rating="2"></div>
                            <ul class="social text-right">
                                <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="article-preview landscape">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="featured-image">
                                <img src="images/misc/preloader.gif" alt="Featured 24" data-echo="images/featured/image25.jpg"/>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="title-wrapper">
                                <p class="category"><a href="category.html">Entertainment</a></p>
                                <h1 class="title">
                                    <a href="article.html">
                                        Smile and happy make the world better
                                    </a>
                                </h1>
                                <ul class="timestamp">
                                    <li>By <a href="profile.html">Dhika Budi</a></li>
                                    <li>2 February 2016</li>
                                    <li>673 Views</li>
                                </ul>
                            </div>
                            <article>
                                After success with single Don’t Let You Go, Reika the band from america starting create
                                video clip. Black and white describe about the song that can make fans feel deep and free.
                                This production spend a lot of money, concert in New York last...
                            </article>
                            <div class="rating-wrapper" data-rating="2"></div>
                            <ul class="social text-right">
                                <li><a href="http://www.facebook.com/infogue" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="http://www.twitter.com/infogue" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="http://plus.google.com/+infogue" class="googleplus"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="text-center">
                <ul class="pagination">
                    <li>
                        <a href="#" aria-label="First">FIRST</a>
                    </li>
                    <li>
                        <a href="#" aria-label="Previous">PREV</a>
                    </li>
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                        <a href="#" aria-label="Next">NEXT</a>
                    </li>
                    <li>
                        <a href="#" aria-label="Last">LAST</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

@endsection