<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Info Gue @yield('title')</title>
    <meta name="description" content="Social news portal gives the most update information">
    <meta name="keywords" content="article, blog, news, portal, technology, health, science, economic, entertainment">
    <meta name="author" content="Angga Ari Wijaya">
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="icon" href="favicon.ico">

    <link rel="stylesheet" href="/library/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="/library/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>

<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="admin_dashboard.html">
                <img src="images/misc/logo-administrator.png">
            </a>
        </div>
        <div class="sidebar-statistic">
            <div>
                <h3>345K</h3>
                <p>ARTICLES</p>
            </div>
            <div>
                <h3>63K</h3>
                <p>MEMBERS</p>
            </div>
        </div>
        <a href="admin_article_create.html" class="btn btn-outline btn-light create">CREATE ARTICLE</a>
        <nav role="navigation">
            <ul>
                <li><a href="admin_dashboard.html"><i class="fa fa-home"></i>Dashboard</a></li>
                <li><a href="admin_setting.html"><i class="fa fa-wrench"></i>Setting<span class="badge pull-right new">42</span></a></li>
                <li><a href="admin_contributor.html"><i class="fa fa-child"></i>Contributor</a></li>
                <li><a href="admin_article.html"><i class="fa fa-file-text-o"></i>Article</a></li>
                <li><a href="admin_category.html"><i class="fa fa-bars"></i>Category</a></li>
                <li><a href="admin_feedback.html"><i class="fa fa-comments-o"></i>Feedback</a></li>
                <li class="active"><a href="admin_about.html"><i class="fa fa-info-circle"></i>About</a></li>
                <li class="visible-xs"><a href="admin_login.html"><i class="fa fa-sign-out"></i>Sign Out</a></li>
            </ul>
        </nav>

        <div class="copyright">
            <img src="images/misc/logo-small.png"/>
            <p>&copy; 2016 All Rights Reserved.</p>
        </div>
    </div>
    <!-- End of sidebar-wrapper -->

    <!-- Page Content -->

    @yield('content')

    <!-- End of page-content-wrapper -->

</div> <!-- End of wrapper -->

<script src="/library/jquery/dist/jquery.min.js"></script>
<script src="/library/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="/library/echojs/dist/echo.min.js"></script>
<script src="/library/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/library/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
<script src="/library/waypoints/lib/jquery.waypoints.min.js"></script>

<script src="/js/admin.js"></script>

</body>
</html>