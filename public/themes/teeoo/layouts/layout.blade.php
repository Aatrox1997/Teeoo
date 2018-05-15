<!DOCTYPE html>
<html lang="en">

    <head>
        {!! meta_init() !!}
        <meta name="viewport" content="initial-scale=1,maximum-scale=1, minimum-scale=1">
        <meta name="keywords" content="@get('keywords')">
        <meta name="description" content="@get('description')">
        <meta name="author" content="@get('author')">
        <title>@get('title')</title>
        <link rel="stylesheet" href="//cdn.bootcss.com/mdui/0.4.1/css/mdui.min.css">
        <script src="//cdn.bootcss.com/mdui/0.4.1/js/mdui.min.js"></script>

        @styles()
        
    </head>

    <body class="mdui-theme-primary-indigo mdui-theme-accent-pink">
         @partial('header')

         @content()

         @partial('footer')

         @scripts()
    </body>

</html>
