@extends("layouts.app")

@section("css")
    <link rel="stylesheet" href="/admin/css/black/jqadmin.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/main.css?v2.0.1-simple" media="all">
@endsection
@section('content')
    <div class="layui-fluid larry-wrapper">
        <div class="layui-row layui-col-space30">
            <div class="layui-col-xs24">
                <section class="panel panel-padding">
                    <div class="group-button">
                        <button class="layui-btn layui-btn-sm layui-btn-primary">
                            <i class="iconfont">&#xe626;</i> 删除
                        </button>

                        <button class="layui-btn layui-btn-sm layui-btn-primary">
                            <i class="layui-icon">&#x1005;</i> 状态
                        </button>
                        <button class="layui-btn layui-btn-primary layui-btn-sm modal"
                                data-params='{"content": "/Admin/content/add","type":"2", "title": "添加文章"}'>
                            <i class="iconfont">&#xe649;</i> 添加
                        </button>
                    </div>
                    <div class="layui-form">
                        <div class="layui-form">
                            <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
                                <legend>评论列表</legend>
                            </fieldset>
                            <table class="layui-table" lay-even="" lay-skin="nob">
                                <thead>
                                <tr>
                                    <th>文章标题</th>
                                    <th>评论作者</th>
                                    <th>内容</th>
                                    <th>邮箱地址</th>
                                    <th>评论时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                @foreach($comment as $val)
                                    <tr>
                                        <td>{{$val->comment_content->title}}</td>
                                        <td>{{$val->username}}</td>
                                        <td>
                                            {{ str_limit($val->content,60,'......')}}
                                            <a href="">查看详情</a>
                                        </td>
                                        <td><a href="">{!! $val->email !!}</a></td>
                                        <td>{{$val->created_at->diffForHumans()}}</td>
                                        <td>

                                            <a href="/Admin/comment//{{$val->id}}" class="layui-badge layui-badge layui-bg-blue">编辑</a>
                                            <a href="/Admin/comment//{{$val->id}}" class="layui-badge layui-bg-cyan">回复</a>
                                            <a href="/Admin/comment/delete/{{$val->id}}" class="layui-btn-sm  layui-badge">删除</a>


                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            {!! $comment->links() !!}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@section("js")
    <script src="/admin/js/common.js?v=2.0.1"></script>
    <script>
        layui.use('cat-list');
        layui.use('layer', function () {
            var layer = layui.layer;
            //提示
            @if(Session::has('message'))
            layer.msg("{{Session::get('message')}}", {icon: "{{Session::get('icon')}}"}, function () {
            });
            @endif
            //字段验证
            @if($errors->any())
            @foreach($errors->all() as $error)
            layer.msg('{{ $error }}', {icon: 5}, {anim: 1});
            @endforeach
            @endif

        });
    </script>
@endsection
