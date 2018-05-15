@foreach($children as $cl)
    <div class="userBB mdui-col-md-12 shadow-12 mdui-hoverable">
        <div class="colorBar"></div>
        <div class="userData" id="comments-{{$cl["id"]}}">
            {{--{{ Gravatar::src('thomaswelton@me.com') }}--}}
            <div class="userIcon"
                 style="width: 100px;height: 100px;border-radius: 50%;position: relative;background: url('{{ Gravatar::src('2365160465@qq.com') }}') no-repeat center / cover;">
                <div class="userName">
                    <div class="name">
                        <a href="#" rel="external nofollow">{{$cl["username"]}}</a><a class="add_c" uid="{{$cl["id"]}}">回复</a>
                    </div>
                    <div class="Jurisdiction">{{$cl["created_at"]}}</div>
                </div>
            </div>
        </div>
        <div class="userBB-Content mdui-text-left">
            {!!$cl["content"]!!}
            @if(!isset($cl["children"]))

            @else
                <children>
                    @partial('children',['children'=>$cl["children"],'content'=>$content])
                </children>
            @endif
            <div class="mdui-divider"></div>
            <div style="padding-bottom:10px;display: none"
                 class="newBB h{{$cl["id"]}} mdui-col-md-12">
                <form method="post" action="/comment/{{$content->id}}" style="width: 100%" role="form"
                      id="comment_form">
                    <input hidden="hidden" type="text" name="parent" value="{{$cl["id"]}}">
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