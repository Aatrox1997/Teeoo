<!DOCTYPE html>
<html lang="en">

<head>
    {!! meta_init() !!}
    <meta name="keywords" content="@get('keywords')">
    <meta name="description" content="@get('description')">
    <meta name="author" content="@get('author')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@get('title')</title>
    @styles()
</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-pink mdui-loaded">
    @partial('header')
    <main id="pjax">
        @content()
    </main>

    @partial('footer')

    @scripts()
</body>
<script>
    // pjax
    $(document).on('pjax:start', function () {
        NProgress.start();

    });
    $(document).pjax('a', '#pjax');
    $.pjax.reload('#pjax');
    $(document).on('pjax:success', function (data) {
        console.log(data);
        $('pre').addClass("line-numbers").css("white-space", "pre-wrap");
    });
    $(document).on('pjax:complete', function () {
        // NProgress.done(true);
    });
    $(document).on('pjax:popstate', function () {
    });
    $(document).on('pjax:end', function () {
        Prism.highlightAll();
        NProgress.done();
        mdui.mutation();
    });
    $(".btn").click(function () {
        $("body,html").animate({scrollTop: 0}, 500);
    });
</script>
</html>
