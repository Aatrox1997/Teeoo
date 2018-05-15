<!DOCTYPE html>
<html lang="en">

<head>
    {!! meta_init() !!}
    {{--<meta name="keywords" content="@get('keywords')">--}}
    {{--<meta name="description" content="@get('description')">--}}
    {{--<meta name="author" content="@get('author')">--}}
    {!! SEO::generate() !!}

    @styles()

</head>

<body class="mdui-theme-primary-indigo mdui-theme-accent-pink mdui-loaded ">
@partial('header')

<main id="pjax">
    @content()
</main>

@partial('footer')

@scripts()
</body>
<script>
    var $$ = mdui.JQ;
    $(function () {
        window.scrollBy(0, -90);
        console.log("\n %c Teeoo v1.0 Pro %c byTeeoo<www.iatw.cc>\n\n", "color:#444;background:#eee;padding:5px 0;", "color:#eee;background:#444;padding:5px 0;");
        // pjax
        $(document).on('pjax:start', function () {
            NProgress.start();
        });
        $(document).pjax('a', '#pjax');
        $.pjax.reload('#pjax');
        $(document).on('pjax:success', function (data) {
            // console.log(data);
        });
        $(document).on('pjax:complete', function () {
            NProgress.done(true);
            $('pre').addClass("line-numbers").css("white-space", "pre-wrap");
            Prism.highlightAll();
        });
        $(document).on('pjax:popstate', function () {
            $$(".sortBy").mutation();
        });
        $(document).on('pjax:end', function () {
            $('.flexTag').click(function () {
                nowCard = $(this).val();
                $('.cat').remove();
                $(this).after('<div class="cat"></div>');
                $('.cat').animate({
                    top: '0',
                    opacity: '1'
                });
                allHidden();
                $('.tabCard').eq(nowCard).css({
                    display: 'block'
                })
            });
            $(".add_c").click(function () {
                $(".h" + $(this).attr("uid")).toggle(function () {
                    $(".h" + $(this).attr("uid")).show();
                }, function () {
                    $(".h" + $(this).attr("uid")).hide();
                });
            });
        });

    });

    foo = false;
    $(window).scroll(function () {
        var sS = document.documentElement.scrollTop;
        var sSs = window.innerHeight;
        var ssr = sS + sSs;
        var sH = document.documentElement.scrollHeight;
        // console.log(sS+' '+sSs+'>>'+sH);
        // console.log(ssr);
        // console.log('foo :'+foo);
        if (ssr === sH && foo == false) {
            $('footer').stop(true, false).animate({
                opacity: '1',
                bottom: '0'
            }, function () {
                foo = true;
            })
        } else if (ssr < (sH - 60) && foo == true) {
            $('footer').stop(true, false).animate({
                opacity: '0',
                bottom: '-50px'
            }, function () {
                foo = false;
            })
        }
    });
</script>

</html>
