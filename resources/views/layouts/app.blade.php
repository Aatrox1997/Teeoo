<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1,user-scalable=no">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <title>@yield("title")</title>
    <!-- load css -->
    <link rel="stylesheet" type="text/css" href="/admin/css/font/iconfont.css?v=1.0.0" media="all">
    <link rel="stylesheet" type="text/css" href="/admin/js/layui/css/layui.css?v=2.2.2" media="all">
    <link rel="stylesheet" type="text/css" href="//at.alicdn.com/t/font_579919_a1t0sl0emuzq6w29.css" media="all">
    {{--<link rel="stylesheet" id="theme" type="text/css" href="/admin/css/blue/jqadmin.css?v=2.0.0-simple" media="all">--}}
    @yield('css')
    <style>
        .editormd-code-toolbar > select{
            display:inline;
        }
    </style>
</head>

<body>
@yield('content')
<script type="text/javascript" src="/admin/js/layui/layui.js?v=2.2.2"></script>
@include("public.version")
@yield('js')
<script>
    var global = {};
    layui.use('index');
</script>
</body>
</html>