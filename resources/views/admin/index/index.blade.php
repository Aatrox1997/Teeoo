@extends("layouts.app")
@section("css")
    <link rel="stylesheet" href="/admin/css/black/jqadmin.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/main.css?v2.0.1-simple" media="all">
@endsection
@section("content")
    <ul class='right-click-menu'>
        <li><a href='javascript:;' data-event='fresh'>刷新</a></li>
        <li><a href='javascript:;' data-event='close'>关闭</a></li>
        <li><a href='javascript:;' data-event='other'>关闭其它</a></li>
        <li><a href='javascript:;' data-event='all'>全部关闭</a></li>
    </ul>
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <!-- logo区域 -->
            <div class="jqadmin-logo-box">
                <a class="logo" href="#" title="jQAdmin">
                    <h1>iatw</h1>
                </a>

            </div>
            <!-- 主菜单区域 -->
            <div class="jqadmin-main-menu">
                <ul class="layui-nav clearfix" id="menu" lay-filter="main-menu">
                    <li class="layui-nav-item layui-this">
                        <a href="javascript:;" data-title="控制台"><i class="iconfont">&#xe637;</i><span>控制台</span></a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" data-title="撰写"><i class="iconfont icon-zhuanxierizhi"></i><span>撰写</span></a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" data-title="管理"><i class="iconfont icon-guanli"></i><span>管理</span></a>
                    </li>
                    <li class="layui-nav-item">
                        <a href="javascript:;" data-title="设置"><i class="iconfont">&#xe689;</i><span>设置</span></a>
                    </li>
                </ul>

            </div>
            <!-- 头部右侧导航 -->
            <div class="header-right">
                <ul class="layui-nav jqadmin-header-item right-menu">
                    {{--<li class="layui-nav-item first">--}}
                        {{--<a href="javascript:;">--}}
                            {{--<cite> 主题 </cite>--}}
                            {{--<span class="layui-nav-more"></span>--}}
                        {{--</a>--}}
                        {{--<dl class="layui-nav-child theme">--}}
                            {{--<dd>--}}
                                {{--<a href="javascript:;" data-href="/admin/css/blue/jqadmin.css">蓝色</a>--}}
                            {{--</dd>--}}
                            {{--<dd>--}}
                                {{--<a href="javascript:;" data-href="/admin/css/black/jqadmin.css">黑色</a>--}}
                            {{--</dd>--}}
                            {{--<dd>--}}
                                {{--<a href="javascript:;" data-href="/admin/css/gray/jqadmin.css">灰色</a>--}}
                            {{--</dd>--}}
                        {{--</dl>--}}
                    {{--</li>--}}

                    <li class="layui-nav-item first">
                        <a href="javascript:;">
                            <cite>{{Auth::user()->name}}</cite>
                            <span class="layui-nav-more"></span>
                        </a>
                        <dl class="layui-nav-child">
                            <dd class="tab-menu">
                                <a href="javascript:;" data-url="/Admin/Setup/user" data-title="个人信息"> <i class="iconfont "
                                                                                                       data-icon='&#xe672;'>&#xe672; </i><span>个人信息</span></a>
                            </dd>
                            <dd>
                                <a href="/Admin/login/logout"><i class="iconfont ">&#xe64b; </i>退出</a>
                            </dd>
                        </dl>
                    </li>
                </ul>
                <button title="刷新" class="layui-btn layui-btn-sm  jq-btn-primary fresh-btn"><i
                            class="iconfont">&#xe62e; </i></button>
            </div>
        </div>
        <!-- 左侧导航-->
        <div class="layui-side layui-bg-black jqamdin-left-bar">
            <div class="layui-side-scroll">
                <div id="submenu">
                    <div class="sub-menu" style="display: block;">
                        <ul class="layui-nav layui-nav-tree">
                            <li class="layui-nav-item layui-nav-itemed">
                                <a href="javascript:;" data-title="控制台"> <i class="iconfont">&#xe637;</i>
                                    <span>控制台</span> <em class="layui-nav-more"></em> </a>
                                <dl class="layui-nav-child">
                                    <dd class="layui-this">
                                        <a href="javascript:;" data-url="article.html" data-title="概要"> <i
                                                    class="iconfont" data-icon="&#xe62a;">&#xe62a;</i> <span>概要</span>
                                        </a>
                                    </dd>
                                    <dd>
                                        <a href="javascript:;" data-url="/Admin/Setup/user" data-title="个人设置"> <i
                                                    class="iconfont" data-icon="&#xe635;">&#xe635;</i> <span>个人设置</span>
                                        </a>
                                    </dd>
                                    <dd>
                                        <a href="javascript:;" data-url="/Admin/themes/" data-title="主题"> <i
                                                    class="iconfont icon-theme"></i> <span>主题</span>
                                        </a>
                                    </dd>
                                    {{--<dd>--}}
                                    {{--<a href="javascript:;" data-url="/log-viewer" data-title="日志"> <i class="iconfont" data-icon="&#xe632;">&#xe632;</i> <span>日志</span> </a>--}}
                                    {{--</dd>--}}
                                </dl>
                            </li>
                            <span class="layui-nav-bar"></span></ul>
                    </div>
                    <div class="sub-menu">
                        <ul class="layui-nav layui-nav-tree">
                            <li class="layui-nav-item">
                                <a href="javascript:;" data-url="/Admin/content/add" data-title="撰写文章"> <i class="iconfont icon-wenzhang-copy"></i>
                                    <span>撰写文章</span> </a>
                            </li>
                            <li class="layui-nav-item">
                                <a href="javascript:;" data-url="brand.html" data-title="撰写页面"> <i class="iconfont icon-xinjianyemiantianjia"></i>
                                    <span>撰写页面</span> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="sub-menu">
                        <ul class="layui-nav layui-nav-tree">
                            <li class="layui-nav-item layui-nav-itemed">
                                <a href="javascript:;" data-title="管理"> <i class="iconfont icon-guanli"></i> <span>管理</span>
                                    <em class="layui-nav-more"></em> </a>
                                <dl class="layui-nav-child">
                                    <dd>
                                        <a href="javascript:;" data-url="/Admin/metas/" data-title="分类管理"> <i
                                                    class="iconfont icon-fenlei"></i> <span>分类管理</span>
                                        </a>
                                    </dd>
                                    <dd>
                                        <a href="javascript:;" data-url="/Admin/tags/" data-title="标签管理">
                                            <i class="iconfont icon-biaoqiantags3"></i><span>标签管理</span> </a>
                                    </dd>
                                    <dd>
                                        <a href="javascript:;" data-url="/Admin/content/" data-title="文章管理"> <i
                                                    class="iconfont icon-wenzhang-copy "></i> <span>文章管理</span>
                                        </a>
                                    </dd>
                                    <dd>
                                        <a href="javascript:;" data-url="/Admin/comment/" data-title="评论管理"> <i
                                                    class="iconfont icon-pinglun2"></i> <span>评论管理</span>
                                        </a>
                                    </dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                    <div class="sub-menu">
                        <ul class="layui-nav layui-nav-tree">
                            <li class="layui-nav-item layui-nav-itemed">
                                <a href="javascript:;" data-title="系统管理"> <i class="iconfont">&#xe646;</i>
                                    <span>系统管理</span> <em class="layui-nav-more"></em> </a>
                                <dl class="layui-nav-child">
                                    <dd>
                                        <a href="javascript:;" data-url="/Admin/Setup/Basicsetup" data-title="基本设置"> <i
                                                    class="iconfont" data-icon="&#xe689;">&#xe689;</i> <span>基本设置</span>
                                        </a>
                                    </dd>
                                </dl>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- 左侧侧边导航结束 -->
        <!-- 右侧主体内容 -->
        <div class="layui-body jqadmin-body">

            <div class="layui-tab layui-tab-card jqadmin-tab-box" id="jqadmin-tab" lay-filter="tabmenu"
                 lay-notAuto="true">
                <div class="menu-type"><i class="iconfont icon-htmal5icon35"></i></div>
                <ul class="layui-tab-title">
                    <li class="layui-this" id="admin-home" lay-id="0" fresh=1><i
                                class="iconfont">&#xe622;</i><em>概要</em></li>
                </ul>

                <div class="layui-tab-content">
                    <div class="layui-tab-item layui-show">
                        <iframe class="jqadmin-iframe" data-id='0' src="/Admin/baic"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul class="menu-list" id="menu-list"></ul>
@endsection()