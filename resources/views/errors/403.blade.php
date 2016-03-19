<!DOCTYPE html>
<html>
    <head>
        <title>Forbidden.</title>

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:100">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Open Sans';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            p{
                font-size: 35px;
                margin-bottom: 5px;
                margin-top: 0;
            }

            .title {
                font-size: 60px;
                margin-bottom: 10px;
            }

            span{
                font-size: 25px;
            }

            a{
                color: #4dc4d2;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <p>Are you a hacker?</p>
                <div class="title">Sorry, this page is forbidden.</div>
                <span>If you discover a security vulnerability, please <a href="{{ route('page.contact') }}#feedback">make us better</a></span>
            </div>
        </div>
    </body>
</html>
