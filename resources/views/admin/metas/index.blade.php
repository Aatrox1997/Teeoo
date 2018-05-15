@extends("layouts.app")

@section("css")
    <link rel="stylesheet" href="/admin/css/black/jqadmin.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/main.css?v2.0.1-simple" media="all">
@endsection
@section('content')
    <div class="layui-fluid larry-wrapper">
        <div class="layui-row layui-col-space30">
            <div class="layui-col-xs24">

            <!--列表-->
                <section class="panel panel-padding">
                    <div class="group-button">
                        <button class="layui-btn layui-btn-sm layui-btn-primary">
                            <i class="iconfont">&#xe626;</i> 删除
                        </button>

                        <button class="layui-btn layui-btn-sm layui-btn-primary">
                            <i class="layui-icon">&#x1005;</i> 状态
                        </button>
                        <button class="layui-btn layui-btn-primary layui-btn-sm modal"
                                data-params='{"content":".add-subcat","area":"750px,550px","title":"添加分类","action":"add"}'>
                            <i class="iconfont">&#xe649;</i> 添加
                        </button>
                    </div>
                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
                        <legend>分类列表</legend>
                    </fieldset>
                    <div class="layui-form">
                        <div class="layui-form">
                            <table class="layui-table" lay-even="" lay-skin="nob">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>别名</th>
                                    <th>子分类数量</th>
                                    <th>icon</th>
                                    <th>文章数量</th>
                                    <th>添加时间</th>
                                    <th>最后更新时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                @foreach($metas as $val)
                                    <tr>
                                        <td>{{$val->id}}</td>
                                        <td>{{$val->types}}</td>
                                        <td>{{$val->slug}}</td>
                                        <td>
                                            @if($val->types_count==0)
                                                <a href=""><span
                                                            class="layui-badge layui-bg-orange">{{$val->types_count}}</span></a>
                                            @else
                                                <span class="layui-badge layui-bg-gray">{{$val->types_count}}</span>
                                            @endif
                                        </td>
                                        <td>{{$val->icon}}</td>
                                        <td>
                                            @if($val->content_count==0)
                                                <a href=""><span
                                                            class="layui-badge layui-bg-orange">{{$val->content_count}}</span></a>
                                            @else
                                                <span class="layui-badge layui-bg-gray">{{$val->content_count}}</span>
                                            @endif
                                        </td>
                                        <td>{{$val->created_at}}</td>
                                        <td>{{$val->updated_at}}</td>
                                        <td>
                                            @if(is_null($val->deleted_at))
                                                <a data-params='{"content": "/Admin/metas/edit/{{$val->id}}","type":"2", "title": "修改分类"}'
                                                   href="javascript:;"
                                                   class="layui-btn-sm modal layui-badge layui-badge layui-bg-blue">修改</a>
                                                <a href="/Admin/metas/destroy/{{$val->id}}" class="layui-btn-sm layui-badge">删除</a>
                                            @else
                                                <a href="/Admin/metas/restore/{{$val->id}}" class="layui-btn-sm layui-bg-blue">恢复</a>
                                                <a href="/Admin/metas/delete/{{$val->id}}" class="layui-btn-sm  layui-badge">彻底删除</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            {!! $metas->links() !!}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class="add-subcat">
        <form id="form1" class="layui-form" action="/Admin/metas/store" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">父级分类</label>
                <div class="layui-input-inline">
                    <select name="parent" id="pid-select" jq-verify="required" jq-error="请输入分类"
                            lay-filter="pid-select">
                        <option value="0">顶级分类</option>
                        @foreach($metas as $me)
                            <option value="{{$me->id}}">{{$me->types}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">分类名称</label>
                <div class="layui-input-block">
                    <input type="text" name="types" placeholder="请输入分类名称" autocomplete="off" class="layui-input ">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">别名</label>
                <div class="layui-input-block">
                    <input type="text" name="slug" placeholder="请输入分类名称" autocomplete="off" class="layui-input ">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-inline">
                    <input type="text" name="order" value="100" placeholder="分类排序" autocomplete="off"
                           class="layui-input ">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">icon</label>
                <div class="layui-input-inline">
                    <input type="text" name="icon" placeholder="page-icon icon-category" autocomplete="off"
                           class="layui-input ">
                </div>
            </div>
            {{--{!! csrf_field() !!}--}}
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="layui-form-item">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <textarea name="description" class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" type="submit">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
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
