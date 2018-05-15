<div class="mdui-container-fluid blogBody">
    <div class="bg-ovo"></div>
    <div class="left-page-list mdui-col-md-8">
        <div class="nice">
            <div class="mdui-typo">
                <h4>{!! env('SITE_NAME') !!}</h4>
                <p>{!! env('SITE_describe') !!}</p>
            </div>
        </div>
        @foreach($content as $con)
            <div class="pageTag shadow-5">
                <div class="cardImage">
                    <a href="/archives/{{$con->slug}}.html">
                        @if(is_null($con->cover))
                            <div class="cardImage-img" style="background: url('/themes/snow/assets/img/test.jpg');width: 100%;height: 100%;background-repeat: no-repeat;background-position: center;background-size: cover;transition: all 0.5s;position: absolute;"></div>
                            @else
                            <div class="cardImage-img" style="background: url('{{$con->cover}}');width: 100%;height: 100%;background-repeat: no-repeat;background-position: center;background-size: cover;transition: all 0.5s;position: absolute;"></div>
                        @endif
                        <div class="readMore">
                            <div><i class="mdui-icon material-icons">keyboard_arrow_left</i></div>
                            <div class="sqReadMore"></div>
                        </div>
                    </a>
                    <div class="hiddenSquare"></div>
                </div>
                <div class="cardContent">
                    <div class="mdui-typo">
                        <h4><a href="/archives/{{$con->slug}}.html">{{$con->title}}</a></h4>
                        <div style="margin-bottom: 10px">
                            作者：<a>{{$con->user->name}}</a>&nbsp;
                            时间：<a>{{$con->created_at->diffForHumans()}}</a>&nbsp;
                            分类：<a></a><a href="">{{$con->metas->types}}</a>
                        </div>
                        <p style="font-size: 0.92em">
                            {!! str_limit($con->text,88,"... ...")!!}
                        </p>
                    </div>
                    <div class="ovo">
                        <div class="ovo-icon">
                            <div class="dataIcon mdui-ripple">
                                <i class="mdui-icon material-icons">check</i>
                                <span style="margin: 0 3px">:</span>
                                <span>{{$con->commentsNum}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="nav-position">
            <div class="nav">
                下一页
            </div>
        </div>
    </div>
    <div class="right-pageTagMenu mdui-col-md-3 mdui-col-offset-md-1">
        <div class="vBox">
            <div class="control shadow-2">
                <div class="search">
                    <div class="searchBtn justCenter">
                        <i class="mdui-icon material-icons">search</i>
                    </div>
                    <div class="searchColor"></div>
                    <form action="" method="post">
                        <input type="text" name="s" placeholder="搜索内容" class="searchInput" autocomplete="off"/>
                    </form>
                </div>
                <div class="mdui-divider control-border"></div>
                <div class="mdui-typo">
                    <h4>I'm crying</h4>
                    <div class="sortBy">
                        <div>
                            <button class="mdui-btn mdui-ripple flexTag" value="0">最新回复</button>
                            <div class="cat cat1"></div>
                        </div>
                        <div>
                            <button class="mdui-btn mdui-ripple flexTag" value="1">最新文章</button>
                        </div>
                        <div>
                            <button class="mdui-btn mdui-ripple flexTag" value="2">文章分类</button>
                        </div>
                    </div>
                    <div class="colorBar"></div>
                    <div>
                        <div class="tabCard firstTabCard">
                            <h5>最新回复</h5>
                            <div class="boaCon marCenter">
                                <ul>
                                    @foreach($comments_desc as $comments_descc)
                                        <li>
                                            {{$comments_descc->username}}:
                                            <a href="/archives/{{$comments_descc->comment_content->slug}}.html#comments-{{$comments_descc->id}}">{{str_limit($comments_descc->content,10,"... ...")}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tabCard">
                            @foreach($content_desc as $content_descc)
                                <div class="nextNewPage">
                                    <a href="/archives/{{$content_descc->slug}}.html">
                                        <div>{{$content_descc->title}} {{$content_descc->created_at->toDateString()}}</div>
                                    </a>
                                    <span>{{$content_descc->created_at->toFormattedDateString()}}</span>
                                    <span class="mdui-float-right nextNewPageData">
                                            <i class="mdui-icon material-icons">check</i>
                                            Com：<a>{{$content_descc->commentsNum}}</a>
                                        </span>
                                </div>
                            @endforeach
                        </div>
                        <div class="tabCard">
                            <h5>文章分类</h5>
                            <ul>
                                @if(isset($metas))
                                    @foreach($metas as $me)
                                        <li><a href="http://iatw.cc/index.php/category/default/">{{$me->types}}</a>
                                            ({{$me->content_count}})
                                        </li>
                                    @endforeach
                                @else
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>