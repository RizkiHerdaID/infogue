@extends('public')

@section('title', '- My Article')

@section('content')

    <div class="back-gray">
        <section class="container content-wrapper">
            <div class="row">

                @include('contributor._sidebar')

                <div class="col-md-8 no-padding-mobile">
                    <div class="account-profile">
                        <div class="profile-wrapper">
                            <section class="list-data">
                                <h3 class="title">ARTICLE</h3>
                                <div class="data-filter mbn">
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
                                    <div class="sort">
                                        <p class="hidden-xs">Sort By</p>
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown-sort-type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Date
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdown-sort-type">
                                                <li><a href="#">Title</a></li>
                                                <li><a href="#">Category</a></li>
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
                                            <ul class="dropdown-menu" aria-labelledby="dropdown-sort">
                                                <li><a href="#">Ascending</a></li>
                                                <li><a href="#">Descending</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="article-preview landscape mini">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-5">
                                                <div class="featured-image">
                                                    <img src="images/misc/preloader.gif" alt="Featured 9" data-echo="images/featured/image9.jpg"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-7">
                                                <div class="title-wrapper">
                                                    <p class="category hidden-xs"><a href="category.html">Sport</a></p>
                                                    <h1 class="title">
                                                        <a href="article.html">
                                                            Extreme sport now more popular lately
                                                        </a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>Extreme Sport</li>
                                                        <li>22 April 2016</li>
                                                        <li class="hidden-xs">34 Views</li>
                                                    </ul>
                                                </div>
                                                <div class="rating-wrapper" data-rating="2"></div>
                                                <div class="text-right control">
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            ACTION
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                                            <li class="dropdown-header">CONTROL</li>
                                                            <li><a href="#"><i class="fa fa-eye"></i> View</a></li>
                                                            <li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                                            <li><a href="#"><i class="fa fa-trash"></i> Delete</a></li>
                                                            <li class="dropdown-header">QUICK ACTION</li>
                                                            <li><a href="#"><i class="fa fa-edit"></i> Set as Draft</a></li>
                                                            <li><a href="#"><i class="fa fa-share-alt"></i> Share</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="article-preview landscape mini">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-5">
                                                <div class="featured-image">
                                                    <img src="images/misc/preloader.gif" alt="Featured 10" data-echo="images/featured/image10.jpg"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-7">
                                                <div class="title-wrapper">
                                                    <p class="category hidden-xs"><a href="category.html">Health</a></p>
                                                    <h1 class="title">
                                                        <a href="article.html">
                                                            Young people in Indonesia introduce importance of exercise
                                                        </a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>Lifestyle</li>
                                                        <li>11 March 2016</li>
                                                        <li class="hidden-xs">734 Views</li>
                                                    </ul>
                                                </div>
                                                <div class="rating-wrapper" data-rating="2"></div>
                                                <div class="text-right control">
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            ACTION
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                                            <li class="dropdown-header">CONTROL</li>
                                                            <li><a href="#"><i class="fa fa-eye"></i> View</a></li>
                                                            <li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                                            <li><a href="#"><i class="fa fa-trash"></i> Delete</a></li>
                                                            <li class="dropdown-header">QUICK ACTION</li>
                                                            <li><a href="#"><i class="fa fa-edit"></i> Set as Draft</a></li>
                                                            <li><a href="#"><i class="fa fa-share-alt"></i> Share</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="article-preview landscape mini">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-5">
                                                <div class="featured-image">
                                                    <img src="images/misc/preloader.gif" alt="Featured 12" data-echo="images/featured/image12.jpg"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-7">
                                                <div class="title-wrapper">
                                                    <p class="category hidden-xs"><a href="category.html">Economic</a></p>
                                                    <h1 class="title">
                                                        <a href="article.html">
                                                            Grand opening new coffee shop at corner of the city of light
                                                        </a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>Finance</li>
                                                        <li>25 January 2016</li>
                                                        <li class="hidden-xs">941 Views</li>
                                                    </ul>
                                                </div>
                                                <div class="rating-wrapper" data-rating="2"></div>
                                                <div class="text-right control">
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            ACTION
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                                            <li class="dropdown-header">CONTROL</li>
                                                            <li><a href="#"><i class="fa fa-eye"></i> View</a></li>
                                                            <li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                                            <li><a href="#"><i class="fa fa-trash"></i> Delete</a></li>
                                                            <li class="dropdown-header">QUICK ACTION</li>
                                                            <li><a href="#"><i class="fa fa-edit"></i> Set as Draft</a></li>
                                                            <li><a href="#"><i class="fa fa-share-alt"></i> Share</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="article-preview landscape mini">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-5">
                                                <div class="featured-image">
                                                    <img src="images/misc/preloader.gif" alt="Featured 11" data-echo="images/featured/image11.jpg"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-7">
                                                <div class="title-wrapper">
                                                    <p class="category hidden-xs"><a href="category.html">Science</a></p>
                                                    <h1 class="title">
                                                        <a href="article.html">
                                                            New reality and old one blend to the nature
                                                        </a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>Research</li>
                                                        <li>11 February 2016</li>
                                                        <li class="hidden-xs">34 Views</li>
                                                    </ul>
                                                </div>
                                                <div class="rating-wrapper" data-rating="2"></div>
                                                <div class="text-right control">
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            ACTION
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                                            <li class="dropdown-header">CONTROL</li>
                                                            <li><a href="#"><i class="fa fa-eye"></i> View</a></li>
                                                            <li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                                            <li><a href="#"><i class="fa fa-trash"></i> Delete</a></li>
                                                            <li class="dropdown-header">QUICK ACTION</li>
                                                            <li><a href="#"><i class="fa fa-edit"></i> Set as Draft</a></li>
                                                            <li><a href="#"><i class="fa fa-share-alt"></i> Share</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="article-preview landscape mini">
                                        <div class="row">
                                            <div class="col-sm-4 col-xs-5">
                                                <div class="featured-image">
                                                    <img src="images/misc/preloader.gif" alt="Featured 22" data-echo="images/featured/image22.jpg"/>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 col-xs-7">
                                                <div class="title-wrapper">
                                                    <p class="category hidden-xs"><a href="category.html">Health</a></p>
                                                    <h1 class="title">
                                                        <a href="article.html">
                                                            Doctor is the one of exellent job can make you rich
                                                        </a>
                                                    </h1>
                                                    <ul class="timestamp">
                                                        <li>Lifestyle</li>
                                                        <li>22 January 2016</li>
                                                        <li class="hidden-xs">941 Views</li>
                                                    </ul>
                                                </div>
                                                <div class="rating-wrapper" data-rating="2"></div>
                                                <div class="text-right control">
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            ACTION
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-sort-type">
                                                            <li class="dropdown-header">CONTROL</li>
                                                            <li><a href="#"><i class="fa fa-eye"></i> View</a></li>
                                                            <li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                                                            <li><a href="#"><i class="fa fa-trash"></i> Delete</a></li>
                                                            <li class="dropdown-header">QUICK ACTION</li>
                                                            <li><a href="#"><i class="fa fa-edit"></i> Set as Draft</a></li>
                                                            <li><a href="#"><i class="fa fa-share-alt"></i> Share</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <ul class="pagination">
                                        <li>
                                            <a href="#" aria-label="First">FIRST</a>
                                        </li>
                                        <li class="disabled">
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
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection