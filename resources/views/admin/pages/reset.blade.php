<!DOCTYPE html>
<html class="no-js">
<head lang="en">
    <meta charset="UTF-8">
    <title>Info Gue - Administrator Login</title>
    <meta name="description" content="Social news portal gives the most update information">
    <meta name="keywords" content="article, blog, news, portal, technology, health, science, economic, entertainment">
    <meta name="author" content="Angga Ari Wijaya">
    <meta name="robots" content="noindex, nofollow"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="icon" href="favicon.ico">

    <script src="js/modernizr-custom.js" type="application/javascript"></script>

    <link rel="stylesheet" href="/library/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/library/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>

<div class="login text-center">
    <div class="login-wrapper">
        <img src="images/misc/logo-color.png"/>
        <h3>RESET PASSWORD</h3>

        <form action="admin_login.html">
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email address" value="anggadarkprince@gmail.com" readonly/>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="new-password" placeholder="New password"/>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="retype-password" placeholder="Re-type password"/>
            </div>
            <button class="btn btn-gradient btn-block">CHANGE PASSWORD</button>
            <p class="mtm">Remember your credential? <a href="admin_login.html">Sign here!</a></p>
        </form>
    </div>
    <div class="login-footer">
        <ul class="list-separated hidden-xs">
            <li><a href="/">Home</a></li>
            <li><a href="/editorial">Editorial</a></li>
            <li><a href="/privacy">Privacy</a></li>
            <li><a href="/disclaimer">Disclaimer</a></li>
            <li><a href="/terms">Term</a></li>
            <li><a href="/career">Career</a></li>
            <li><a href="/faq">FAQ</a></li>
            <li><a href="/contact">Contact</a></li>
        </ul>
        <div class="copyright">&copy; Copyright 2016 infogue.com All Rights Reserved.</div>
    </div>
</div>

<script>
    Modernizr.on('backgroundcliptext', function( result ) {
        if (result) {
            // alert('on');
        } else {
            // alert('off');
        }
    });
</script>

<script src="/library/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/library/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/library/bower_components/echojs/dist/echo.min.js"></script>
<script src="/library/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/library/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
<script src="/library/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>

<script src="/js/admin.js"></script>

</body>
</html>