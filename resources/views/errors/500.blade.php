<!DOCTYPE html>
<html>
<head>
    <title>Something is getting wrong.</title>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400">

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
            font-size: 25px;
            margin-bottom: 5px;
            margin-top: 0;
        }

        .title {
            font-size: 40px;
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
        <p>Whoops, looks like something went wrong.</p>
        <div class="title">We apologize, there is glitch on our machine.</div>
        <p>Please <a href="{{ route('page.contact') }}#feedback">contact our support</a> if it still continues</p>
        This website currently maintain by <a href="mailto:anggadarkprince@gmail.com">Angga Ari Wijaya</a>
    </div>
</div>
</body>
</html>
