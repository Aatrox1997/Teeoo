<!DOCTYPE html>
<!--[if IE 9]>
<html class="ie9 no-focus" lang="zh"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-focus" lang="zh"> <!--<![endif]-->
<head>
    <meta charset="utf-8">

    <title>跳转提示 </title>

    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">
    <link rel="stylesheet" href="/public//bootstrap.min.css">
    <link rel="stylesheet" id="css-main" href="/public//oneui.css">
    <link rel="stylesheet" id="css-main" href="/public//dolphin.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- END Stylesheets -->
</head>
<body>
<!-- Error Content -->
<div class="content bg-white text-center pulldown overflow-hidden">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <!-- Error Titles -->
            {{--text-success' : 'text-city--}}
            {{--'check' : 'times'--}}
            <h1 class="font-w300 {{$text}}  push-10 animated flipInX"><i
                        class="fa fa-{{$fa}}-circle"></i> {{$message}}</h1>
            <p class="font-w300 push-20 animated fadeInUp">页面自动 <a id="href" href="{{url($url)}}">跳转</a> 等待时间： <b
                        id="wait" class="loginTime">{{$jumpTime}}</b>秒</p>
            <div class="push-50">
                <a class="btn btn-minw btn-rounded btn-success" href="{{url($url)}}"><i
                            class="fa fa-external-link-square"></i> 立即跳转</a>
                <button class="btn btn-minw btn-rounded btn-warning" type="button" onclick="stop()"><i
                            class="fa fa-ban"></i> 禁止跳转
                </button>
                <a class="btn btn-minw btn-rounded btn-default" href="#"><i class="fa fa-home"></i>
                    返回首页</a>
            </div>
            <!-- END Error Titles -->
        </div>
    </div>
</div>
<!-- END Error Content -->

<!-- Error Footer -->
{{--<div class="content pulldown text-muted text-center">--}}
{{--贵州<br>--}}
{{--优米云科技！<br>--}}
{{--<a class="link-effect" href="http://www.umfree.com">http://www.umfree.com</a>--}}
{{--</div>--}}
<!-- END Error Footer -->
<script src="https://cdn.bootcss.com/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        var url = "{{$url}}"
        var loginTime = parseInt($('.loginTime').text());
        var time = setInterval(function () {
            loginTime = loginTime - 1;
            $('.loginTime').text(loginTime);
            if (loginTime == 0) {
                clearInterval(time);
                window.location.href = url;
            }
        }, 1000);
    })
</script>
</body>
</html>