{{--@widget('heder')--}}
<div class="mdui-container">
    <h1 class="h1">最新文章</h1>
    @foreach($content as $con)
        <div class="mdui-card main_te mdui-hoverable">
            <div class="mdui-card-media">
                <img src="/themes/bulma/assets/img/8.jpg"/>
                <div class="mdui-card-media-covered mdui-card-media-covered-transparent">
                    <div class="mdui-card-primary">
                        <div class="mdui-card-primary-title">{{$con->title}}</div>
                    </div>
                </div>
            </div>
            <div class="mdui-card-actions">
                <div class="mdui-card-content p_p">
                    {!! str_limit(Parsedown::instance()->setMarkupEscaped(true)->text($con->text),70,"...") !!}
                </div>
                <div class="mdui-divider"></div>
                <div class="mdui-card-content">
                    <p style="opacity: .4">
                        <span><i class="mdui-icon material-icons">access_time</i>{{$con->created_at}}</span>
                        <a href="/archives/{{$con->slug}}.html" class="mdui-float-right mdui-text-color-pink">戳进去</a>
                    </p>
                </div>
            </div>
        </div>
    @endforeach
</div>
<button class="mdui-fab mdui-color-theme-accent mdui-fab-fixed mdui-fab-hide btn">
    <i class="mdui-icon material-icons">arrow_upward</i>
</button>