{{--@widget('heder')--}}
<div class="container">
    <!-- START ARTICLE FEED -->
    <main class="articles">
        {{--mdui-shadow-10--}}
        <div class="column is-8 is-offset-2  mdui-shadow-10" style="padding: 0">
            <!-- START ARTICLE -->
            <div class="card article">
                <div id="editormd" class="card-content mdui-typo">
                    {!! $content->html !!}
                </div>
                <div class="mdui-valign">
                    <button class="mdui-fab mdui-color-theme-accent" mdui-dialog="{target: '#exampleDialog'}"
                            mdui-tooltip="{content: '赞赏'}"><i
                                class="mdui-icon material-icons">thumb_up</i>
                    </button>
                    <div class="mdui-dialog" id="exampleDialog">
                        <img style="max-height: 600px" src="/themes/bulma/assets/img/20180526104842.jpg" alt="">
                    </div>
                </div>
                <div class="mdui-typo mdui-m-t-4">
                    <div class="notification">
                        <blockquote>
                            本文采用 <a
                                    href="https://creativecommons.org/licenses/by-nc-sa/3.0/deed.zh" target="_blank">CC
                                BY-NC-SA
                                3.0 Unported</a> 协议进行许可。<br>本文链接: <a href="https://flyhigher.top/develop/1042.html">https://flyhigher.top/develop/1042.html</a>
                        </blockquote>
                    </div>
                    <div class="notification ">
                        @if(!is_null($content->tags))
                            <div class="mdui-p-l-4">
                                @foreach($content->tags as $tags)
                                    <span class="mdui-m-b-2 tag is-{{$tags->color}}">{{$tags->name}}</span>
                                @endforeach
                            </div>

                        @else
                            <span class="tag is-black">木有标签</span>
                        @endif
                        <div class="mdui-divider"></div>
                        <nav class="mdui-p-t-3 breadcrumb has-succeeds-separator" aria-label="breadcrumbs">
                            <ul>
                                <li><a href="#">Bulma</a></li>
                                <li><a href="#">Documentation</a></li>
                                <li><a href="#">Components</a></li>
                                <li class="is-active"><a href="#" aria-current="page">Breadcrumb</a></li>
                            </ul>
                        </nav>
                        <div class="mdui-divider"></div>
                        <h3 style="margin: 20px;font-weight: 400;font-size: 18px;">你可能感兴趣</h3>
                        <div class="columns is-mobile">
                            <div class="column">1</div>
                            <div class="column">2</div>
                            <div class="column">3</div>
                            <div class="column">4</div>
                        </div>
                        <h3 style="margin: 20px;font-weight: 400;font-size: 20px;">
                            发表评论
                        </h3>
                        <form action="/comment/{{$content->id}}" method="post">
                            {!! csrf_field() !!}
                            <div class="mdui-textfield">
                                <i class="mdui-icon material-icons">textsms</i>
                                <textarea name="content" class="mdui-textfield-input" rows="3"
                                          placeholder="说点什么呗....支持Markdown语法"></textarea>
                            </div>
                            @if(is_null(session('user_info')))
                                <div class="mdui-textfield mdui-textfield-floating-label">
                                    <i class="mdui-icon material-icons">account_circle</i>
                                    <label class="mdui-textfield-label">昵称</label>
                                    <input name="username" class="mdui-textfield-input" type="text"/>
                                </div>
                                <div class="mdui-textfield mdui-textfield-floating-label">
                                    <i class="mdui-icon material-icons">email</i>
                                    <label class="mdui-textfield-label">邮箱</label>
                                    <input name="email" class="mdui-textfield-input" type="email">
                                </div>
                                <div class="mdui-textfield mdui-textfield-floating-label">
                                    <i class="mdui-icon material-icons"></i>
                                    <label class="mdui-textfield-label">网站（如果有）http(s)://</label>
                                    <input name="url" class="mdui-textfield-input" type="url">
                                </div>
                            @else
                                <p>登录身份:
                                    <a href="#">{{session('user_info')['username']}}</a>.
                                    <a href="/logout/{{$content->id}}" title="Logout">退出 » </a></p>
                            @endif
                            <button type="submit"
                                    class="mdui-btn mdui-color-theme-accent mdui-ripple mdui-float-right ">发射
                            </button>
                        </form>
                    </div>
                </div>
                <ul class="mdui-list" mdui-collapse="{accordion: true}">
                    @foreach($commentss as $comm)
                        <li class="mdui-list-item" id="li-comment-756">
                            <div class="mdui-list-item-avatar">
                                <img width="80" height="80" src="http://q1.qlogo.cn/g?b=qq&nk=1982890538&s=100" class="avatar"/>
                            </div>
                            <div class="mdui-list-item-content outbu" id="comment-756">
                                <div class="mdui-list-item-title">
                                    <a class="mdui-text-color-pink" href="">{{$comm["username"]}}</a>
                                    <a class="mdui-float-right" style="opacity: .4"
                                       href="#">{{\Carbon\Carbon::now()->diffForHumans($comm["created_at"])}}</a>
                                </div>
                                <div class="mdui-list-item-text mdui-typo">
                                    <p class="mdui-typo">
                                        漂亮
                                    </p>
                                </div>
                                <a href="" class="mdui-float-right mdui-text-color-pink mdui-clearfix">回复</a>
                                {{--<span class="mdx-reply-time">2月前</span>--}}
                            </div>
                        </li>
                    @endforeach
                    {{--<li class="mdui-collapse-item mdui-collapse-item-open">--}}
                        {{--<div class="mdui-collapse-item-header mdui-list-item mdui-ripple">--}}
                            {{--<i class="mdui-list-item-icon mdui-icon material-icons">people</i>--}}
                            {{--<div class="mdui-list-item-content">Audience</div>--}}
                            {{--<i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>--}}
                        {{--</div>--}}
                        {{--<ul class="mdui-collapse-item-body mdui-list mdui-list-dense">--}}
                            {{--<li class="mdui-list-item mdui-ripple">Overview</li>--}}
                            {{--<li class="mdui-list-item mdui-ripple">Language</li>--}}
                            {{--<li class="mdui-list-item mdui-ripple">Location</li>--}}
                            {{--<li class="mdui-list-item mdui-ripple">New vs Returning</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </div>
    </main>
</div>
<div class="mdui-bottom-nav mdui-bottom-nav-text-auto ">

</div>
<button class="mdui-fab mdui-color-theme-accent mdui-fab-fixed mdui-fab-hide btn">
    <i class="mdui-icon material-icons">arrow_upward</i>
</button>