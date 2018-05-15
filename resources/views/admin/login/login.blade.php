<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello Word</title>
    <link rel="stylesheet" type="text/css" href="/admin/login/css/normalize.css"/>
    <link rel="stylesheet" type="text/css" href="/admin/login/css/default.css">
    <link rel="stylesheet" type="text/css" href="/admin/login/css/styles.css">
</head>
<body>
<div class="htmleaf-container">
    <div class="wrapper">
        <div class="container">
            <h1>Welcome</h1>
            <form class="form" action="/Admin/login/login" method="post">
                <input type="text" name="name">
                <input type="password" name="password">
                <button type="submit" id="login-button">登录</button>
                {{csrf_field()}}
            </form>
        </div>
        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
</div>
<script src="http://libs.useso.com/js/jquery/2.1.1/jquery.min.js" type="text/javascript"></script>
</body>
</html>