<div class="mdui-container pageBody shadow-2">
    <div class="bg-ovo"></div>
    <div class="mdui-typo pageHead">
        <h3>{{$content->title}}</h3>
        <div class="taptap">
            <div>
                <span><i class="mdui-icon material-icons">check</i>View：<a>{{$content->commentsNum}} 条评论</a></span>
                <span><i class="mdui-icon material-icons">change_history</i>所属分类：<a
                            href="/">{{$content->metas->types}}</a></span>
                <span>
                    <i class="mdui-icon material-icons">change_history</i>Tags：
                    @foreach($content->tags as $tag)
                        <a href=""><i class="iconfont icon-biaoqian2"></i>{{$tag->name}}</a>
                    @endforeach
                </span>
            </div>
            <div class="pageDataRight">
                <span>
                    作者 : <a>{{$content->user->name}}</a></span>
                <span>
                    <i class="mdui-icon material-icons">date_range</i>日期 : {{$content->created_at}}</span>
            </div>

        </div>
    </div>
    <div class="mdui-divider" style="margin: 10px 0"></div>
    <div class="mdui-typo pageContent">
        {{--{!!  $content->html !!}--}}
        <div id="test-editormd-view2">
            {!! $content->html!!}
        </div>
    </div>
</div>
@if($content->criticism=="2")
    <div class="mdui-container sibi shadow-2 mdui-typo">
        <div class="pageHead" id="respond-post-1">
            <h4 class="mdui-text-center">作者不准你评论怪我咯！</h4>
            <div class="mdui-divider"></div>
            <div class="newBB mdui-col-md-12 mdui-text-center">
                惊不惊喜,意不意外！
            </div>
        </div>
    </div>
@else
    <div class="mdui-container sibi shadow-2 mdui-typo">
        <div class="pageHead" id="respond-post-1">
            @if($content->commentsNum==0)
                <h4>好桑心竟然没有人评论</h4>
            @elseif($content->commentsNum<5)
                <h4>哎!终于有{{$content->commentsNum}}条评论了</h4>
            @else
                <h4>有{{$content->commentsNum}}条评论了,不服有种你在评论一条啊</h4>
            @endif
            <div class="mdui-divider"></div>
            <div class="newBB mdui-col-md-12">
                <form method="post" action="/comment/{{$content->id}}" style="width: 100%" role="form"
                      id="comment_form">
                    <div class="userIC">
                        @if(is_null(session('user_info')))
                            <div class="mdui-col-xs-12 mdui-col-md-3 getData-input" id="userName">
                                <input type="text" placeholder="昵称" name="username" value="" required="">
                            </div>
                            <div class="mdui-col-xs-12 mdui-col-md-3 getData-input" id="mail">
                                <input type="email" placeholder="邮箱" name="email" value="" required="">
                            </div>
                            <div class="mdui-col-xs-12 mdui-col-md-4 getData-input" id="urls">
                                <input type="text" name="url" id="urls" placeholder="http://" value="">
                            </div>
                        @else
                            <p>登录身份:
                                <a href="#">{{session('user_info')['username']}}</a>.
                                <a href="/logout/{{$content->id}}" title="Logout">退出 » </a></p>
                        @endif
                    </div>
                    <div class="mdui-col-xs-12 mdui-col-md-10 getData-input" id="content">
                        <textarea name="content" id="textarea" class="textarea"
                                  placeholder="评论内容,支持Markdown语法,代码高亮请使用<pre><code class=‘language-你的语言’>你的内容</code></pre>"
                                  required=""></textarea>
                    </div>
                    {!! csrf_field() !!}
                    <div class="mdui-col-xs-12 mdui-col-md-2" id="subBtn">
                        <button class="mdui-ripple shadow-1" type="submit">提交评论</button>
                    </div>
                </form>

            </div>
        </div>
        <div class="comments">
            {{--@partial('children',['collections'=>'Hello'])--}}
            {{--children--}}
            {{--{{dump($commentss->id)}}--}}
            @foreach($commentss as $comments)
                <div class="userBB mdui-col-md-12 shadow-12 mdui-hoverable">
                    <div class="colorBar"></div>
                    <div class="userData" id="comments-{{$comments["id"]}}">
                        {{--{{ Gravatar::src('thomaswelton@me.com') }}--}}
                        <div class="userIcon"
                             style="width: 100px;height: 100px;border-radius: 50%;position: relative;background: url('{{ Gravatar::src('$comments->email') }}') no-repeat center / cover;">
                            <div class="userName">
                                <div class="name">
                                    <a href="#" rel="external nofollow">{{$comments["username"]}}</a><a class="add_c"
                                                                                                        uid="{{$comments["id"]}}">回复</a>
                                </div>
                                <div class="Jurisdiction">{{$comments["created_at"]}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="userBB-Content mdui-text-left">
                        {!!$comments["content"]!!}
                        @if(!isset($comments["children"]))

                        @else
                            <children>
                                @partial('children',['children'=>$comments["children"],'content'=>$content])
                            </children>
                        @endif
                        <div class="mdui-divider"></div>
                        <div style="padding-bottom:10px;display: none"
                             class="newBB h{{$comments["id"]}} mdui-col-md-12">
                            <form method="post" action="/comment/{{$content->id}}" style="width: 100%" role="form"
                                  id="comment_form">
                                <input hidden="hidden" type="text" name="parent" value="{{$comments["id"]}}">
                                <div class="userIC">
                                    @if(is_null(session('user_info')))
                                        <div class="mdui-col-xs-12 mdui-col-md-3 getData-input" id="userName">
                                            <input type="text" placeholder="昵称" name="username" value=""
                                                   required="">
                                        </div>
                                        <div class="mdui-col-xs-12 mdui-col-md-3 getData-input" id="mail">
                                            <input type="email" placeholder="邮箱" name="email" value="" required="">
                                        </div>
                                        <div class="mdui-col-xs-12 mdui-col-md-4 getData-input" id="urls">
                                            <input type="text" name="url" id="urls" placeholder="http://" value="">
                                        </div>
                                    @else
                                        <p>登录身份:
                                            <a href="#">{{session('user_info')['username']}}</a>.
                                            <a href="/logout/{{$content->id}}" title="Logout">退出 » </a></p>
                                    @endif
                                </div>
                                <div class="mdui-col-xs-12 mdui-col-md-10 getData-input" id="content">
                    <textarea name="content" id="textarea" class="textarea"
                              placeholder="评论内容,支持Markdown语法,代码高亮请使用<pre><code class=‘language-你的语言’>你的内容</code></pre>"
                              required=""></textarea>
                                </div>
                                {!! csrf_field() !!}
                                <div class="mdui-col-xs-12 mdui-col-md-2" id="subBtn">
                                    <button class="mdui-ripple shadow-1" type="submit">提交评论</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif