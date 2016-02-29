<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>InfoGue.id</h2>

<div>
    Infogue! Password Recovery
    <h3>Hi, {!! $name !!}</h3>
    <p>We will help you recover your password by clicking link bellow</p>
    <p>{!! "<a href='localhost:8000/auth/reset/".$token."'>RESET MY PASSWORD</a>" !!}"</p>
</div>

</body>
</html>