@extends('private')

@section('title', '- Dashboard')

@section('content')

    <div id="content-wrapper">
        <header>
            <a href="#menu-toggle" class="toggle-nav"><i class="fa fa-bars"></i></a>
            <div class="title">
                <h1>Dashboard</h1>
            </div>
            <div class="control hidden-xs">
                <div class="account clearfix">
                    <div class="avatar-wrapper">
                        <img src="images/contributors/cici.png" class="img-circle img-rounded">
                        <div class="notify"></div>
                    </div>
                    <p class="avatar-greeting pull-left hidden-sm">Hi, <strong>Imelda Agustine</strong></p>
                </div>
                <a href="{{ route('admin.login.destroy') }}" class="sign-out"><i class="fa fa-sign-out"></i> SIGN OUT</a>
            </div>
        </header>
        <div class="breadcrumb-wrapper">
            <ol class="breadcrumb mtn">
                <li><a href="index.html">INFOGUE.ID</a></li>
                <li><a href="admin_dashboard.html">Dashboard</a></li>
                <li class="blank"></li>
            </ol>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="title-section">
                        <h1 class="title">Activities</h1>
                        <p class="subtitle">User behavior, logs and activities <a href="#" class="pull-right">235 More</a></p>
                    </div>
                    <div class="content-section">
                        <div class="list-activity">
                            <img src="images/contributors/angga.jpg"/>
                            <div class="info">
                                <p class="name">Angga Ari Wijaya <span class="pull-right timestamp">a moment ago</span></p>
                                <p class="description">Update article <a href="article.html">We do not change the world...</a></p>
                            </div>
                        </div>
                        <div class="list-activity">
                            <img src="images/contributors/cindy.jpg"/>
                            <div class="info">
                                <p class="name">Shangrilla Arina <span class="pull-right timestamp">3 minutes ago</span></p>
                                <p class="description">Now is following <a href="profile.html">Bella Cyntia</a></p>
                            </div>
                        </div>
                        <div class="list-activity">
                            <img src="images/contributors/desi.jpg"/>
                            <div class="info">
                                <p class="name">Bella Cyntia <span class="pull-right timestamp">53 minutes ago</span></p>
                                <p class="description">Creates new articles <a href="article.html">People don’t get it wh...</a></p>
                            </div>
                        </div>
                        <div class="list-activity">
                            <img src="images/contributors/hadi.jpg"/>
                            <div class="info">
                                <p class="name">Shanon Lizarto <span class="pull-right timestamp">4 hours ago</span></p>
                                <p class="description">Delete article <a href="article.html">Sport and soul are definetely...</a></p>
                            </div>
                        </div>
                        <div class="list-activity">
                            <img src="images/contributors/vivi.jpg"/>
                            <div class="info">
                                <p class="name">Bella Cyntia <span class="pull-right timestamp">2 weeks ago</span></p>
                                <p class="description">Now is stop following <a href="profile.html">Angga Ari Wijaya</a></p>
                            </div>
                        </div>
                        <div class="list-activity">
                            <img src="images/contributors/lisna.jpg"/>
                            <div class="info">
                                <p class="name">Arini Minatika <span class="pull-right timestamp">3 months ago</span></p>
                                <p class="description">Creates new articles <a href="profile.html">Captain America now...</a></p>
                            </div>
                        </div>
                        <div class="list-activity">
                            <img src="images/contributors/ratna.jpg"/>
                            <div class="info">
                                <p class="name">Erica Dwi Anjani <span class="pull-right timestamp">2 years ago</span></p>
                                <p class="description">Creates new articles <a href="profile.html">New technology has...</a></p>
                            </div>
                        </div>
                        <div class="list-activity">
                            <img src="images/contributors/iyan.jpg"/>
                            <div class="info">
                                <p class="name">Renton Vikar <span class="pull-right timestamp">2 years ago</span></p>
                                <p class="description">Creates new articles <a href="profile.html">Turn into a monster is...</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="title-section">
                        <h1 class="title">Visitor</h1>
                        <p class="subtitle">Web visitor statistic <a href="#" class="pull-right">View History</a></p>
                    </div>
                    <div class="content-section">
                        <div class="row">
                            <div class="col-sm-1 col-xs-2 prn">
                                <div class="legend-left">
                                    <ul class="list-unstyled">
                                        <li>70</li>
                                        <li>60</li>
                                        <li>50</li>
                                        <li>40</li>
                                        <li>30</li>
                                        <li>20</li>
                                        <li>10</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-11 col-xs-10 pln">
                                <div class="chart">
                                    <div class="bar">
                                        <div class="bar-wrapper">
                                            <div class="base"></div>
                                            <div class="fill" data-value="35"></div>
                                        </div>
                                        <p>04/02</p>
                                    </div>
                                    <div class="bar">
                                        <div class="bar-wrapper">
                                            <div class="base"></div>
                                            <div class="fill" data-value="54"></div>
                                        </div>
                                        <p>05/02</p>
                                    </div>
                                    <div class="bar">
                                        <div class="bar-wrapper">
                                            <div class="base"></div>
                                            <div class="fill" data-value="72"></div>
                                        </div>
                                        <p>06/02</p>
                                    </div>
                                    <div class="bar">
                                        <div class="bar-wrapper">
                                            <div class="base"></div>
                                            <div class="fill" data-value="80"></div>
                                        </div>
                                        <p>07/02</p>
                                    </div>
                                    <div class="bar">
                                        <div class="bar-wrapper">
                                            <div class="base"></div>
                                            <div class="fill" data-value="74"></div>
                                        </div>
                                        <p>08/02</p>
                                    </div>
                                    <div class="bar">
                                        <div class="bar-wrapper">
                                            <div class="base"></div>
                                            <div class="fill" data-value="34"></div>
                                        </div>
                                        <p>09/02</p>
                                    </div>
                                    <div class="bar md-screen sm-screen">
                                        <div class="bar-wrapper">
                                            <div class="base"></div>
                                            <div class="fill" data-value="23"></div>
                                        </div>
                                        <p>10/02</p>
                                    </div>
                                    <div class="bar md-screen sm-screen">
                                        <div class="bar-wrapper">
                                            <div class="base"></div>
                                            <div class="fill" data-value="50"></div>
                                        </div>
                                        <p>11/02</p>
                                    </div>
                                    <div class="bar sm-screen">
                                        <div class="bar-wrapper">
                                            <div class="base"></div>
                                            <div class="fill" data-value="35"></div>
                                        </div>
                                        <p>12/02</p>
                                    </div>
                                    <div class="bar sm-screen">
                                        <div class="bar-wrapper">
                                            <div class="base"></div>
                                            <div class="fill" data-value="70"></div>
                                        </div>
                                        <p>13/02</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="legend-bottom">
                            <p class="center-block text-center">Daily Visitor report <strong>4 February - 13 February</strong></p>
                            <ul class="list-inline center-block text-center">
                                <li>VISITOR</li>
                                <li>TARGET</li>
                            </ul>
                        </div>
                    </div>
                    <div class="title-section">
                        <h1 class="title">Statistics</h1>
                        <p class="subtitle">Several data information <a href="#" class="pull-right">View Details</a></p>
                    </div>
                    <div class="content-section">
                        <div class="row statistic-box">
                            <div class="col-md-4 col-xs-6">
                                <div class="box">
                                    <h1>346K</h1>
                                    <p>ARTICLES</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-6">
                                <div class="box">
                                    <h1>674</h1>
                                    <p>MEMBERS</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-6">
                                <div class="box">
                                    <h1>62</h1>
                                    <p>CATEGORIES</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-6">
                                <div class="box">
                                    <h1>76K</h1>
                                    <p>MESSAGES</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-6">
                                <div class="box">
                                    <h1>875K</h1>
                                    <p>FEEDBACK</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-6">
                                <div class="box">
                                    <h1>734K</h1>
                                    <p>VISITORS</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> <!-- End of page-content-wrapper -->

@endsection