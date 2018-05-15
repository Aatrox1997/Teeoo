@extends("layouts.app")
@section("css")
    <link rel="stylesheet" href="/admin/css/black/jqadmin.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/main.css?v2.0.1-simple" media="all">
@endsection
@section("content")
<div class="layui-fluid larry-wrapper">
    <div class="layui-row layui-col-space30">

        <div class="layui-col-xs6 layui-col-sm4 layui-col-md2">
            <section class="panel">
                <div class="symbol bgcolor-dark-green"> <i class="iconfont">&#xe6bc;</i>
                </div>
                <div class="value tab-menu">
                    <a href="javascript:;" data-url="#" data-parent="true" data-title="文章总数"> <i class="iconfont " data-icon='&#xe6bc;'></i>
                        <h1>{{$content_count}}</h1>
                    </a>
                    <a href="javascript:;" data-url="#" data-parent="true" data-title="文章总数"> <i class="iconfont " data-icon='&#xe6bc;'></i><span>文章总数</span></a>
                </div>
            </section>
        </div>

        <div class="layui-col-xs6 layui-col-sm4 layui-col-md2">
            <section class="panel">
                <div class="symbol bgcolor-yellow-green"> <i class="iconfont icon-shengqian"></i>
                </div>
                <div class="value tab-menu">
                    <a href="javascript:;" data-url="#" data-parent="true" data-title="Tag总数"> <i class="iconfont " data-icon='&#xe649;'></i>
                        <h1>{{$tag_count}}</h1>
                    </a>
                    <a href="javascript:;" data-url="#" data-parent="true" data-title="Tag总数"> <i class="iconfont " data-icon='&#xe649;'></i><span>Tag总数</span></a>
                </div>
            </section>
        </div>

        <div class="layui-col-xs6 layui-col-sm4 layui-col-md2">
            <section class="panel">
                <div class="symbol bgcolor-orange"> <i class="iconfont">&#xe638;</i>
                </div>
                <div class="value tab-menu">
                    <a href="javascript:;" data-url="#" data-parent="true" data-title="评论总数"> <i class="iconfont " data-icon='&#xe638;'></i>
                        <h1>{{$comment_count}}</h1>
                    </a>
                    <a href="javascript:;" data-url="#" data-parent="true" data-title="评论总数"> <i class="iconfont " data-icon='&#xe638;'></i><span>评论总数</span></a>
                </div>
            </section>
        </div>

        <div class="layui-col-xs6 layui-col-sm4 layui-col-md2">
            <section class="panel">
                <div class="symbol bgcolor-yellow"> <i class="iconfont">&#xe669;</i>
                </div>
                <div class="value tab-menu">
                    <a href="javascript:;" data-url="user-info.html" data-parent="true" data-title="今日评论"> <i class="iconfont " data-icon='&#xe669;'></i>
                        <h1>10</h1>
                    </a>
                    <a href="javascript:;" data-url="user-info.html" data-parent="true" data-title="今日评论"> <i class="iconfont " data-icon='&#xe669;'></i><span>今日评论</span></a>
                </div>
            </section>
        </div>

    </div>
    <div class="layui-row layui-col-space10">
        <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">

            <section class="panel log">
                <div class="panel-heading">
                    更新日志
                    <a href="javascript:;" class="pull-right panel-toggle"><i class="iconfont">&#xe604;</i></a>
                </div>
                <div class="panel-body">
                    <h2>Teeoo 2018-04-13</h2>
                    <ul>
                        <li>Teeoo v1.0 发布</li>
                    </ul>
                    <h2>Teeoo 2018-04-14</h2>
                    <ul>
                        <li>完成Tag,文章等等CURD</li>
                        <li>完成评论邮件通知</li>
                        <li>修改iconfont</li>
                        <li>完成基本设置Mysql版本需要大于等于5.7</li>
                        <li>修复若干BUG</li>
                    </ul>
                    <h2>Teeoo 2018-04-16</h2>
                    <ul>
                        <li>更新个人设置</li>
                        <li>修改文章修改BUG</li>
                        <li>一些配置放入.env中</li>
                    </ul>
                </div>
            </section>
        </div>
        <div class="layui-col-xs12 layui-col-sm12 layui-col-md6">
            <section class="panel">
                <div class="panel-heading">
                    网站信息
                    <a href="javascript:;" class="pull-right panel-toggle"><i class="iconfont">&#xe604;</i></a>
                </div>
                <div class="panel-body">
                    <table class="layui-table" lay-even="" lay-skin="nob">
                        <tbody>
                        <tr>
                            <td>
                                <strong>软件名称</strong>：
                            </td>
                            <td>
                                <a href="https://github.com/iatw/Teeoo">Teeoo</a>
                            </td>
                        </tr>
                        @foreach($info as $k=>$v)
                            <tr>
                                <td>
                                    <strong>{{$k}}</strong>：
                                </td>
                                <td>
                                    <strong>{{$v}}</strong>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection()