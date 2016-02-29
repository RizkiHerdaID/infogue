<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>InfoGue.id</h2>

<div>
    Welcome to Infogue!
    <h3>Hi, {!! $name !!}</h3>
    <p>Please activate your email by clicking link bellow</p>
    <p style="margin-bottom: 10px"><a href="http://localhost:8000/auth/activate/{{ $token }}">ACTIVATE</a></p>
    <p>If the link doesn't work, please copy the link text bellow to your browser address bar</p>
    <p>localhost:8000/auth/activate/{!! $token !!}</p>
</div>

</body>
</html>