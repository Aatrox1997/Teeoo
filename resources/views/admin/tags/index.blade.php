@extends("layouts.app")

@section("css")
    <link rel="stylesheet" type="text/css" href="/admin/css/main.css?v2.0.1-simple" media="all">
    <link href="https://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
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
                                data-params='{"content":".add-subcat","area":"350px,230px","title":"添加标签","action":"add"}'>
                            <i class="iconfont">&#xe649;</i> 添加
                        </button>
                    </div>
                    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
                        <legend>标签列表</legend>
                    </fieldset>
                    <div class="layui-form">
                        <div class="layui-form">
                            <table class="layui-table" lay-even="" lay-skin="nob">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>添加时间</th>
                                    <th>最后更新时间</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                @foreach($tags as $val)
                                    <tr>
                                        <td>{{$val->id}}</td>
                                        <td>{{$val->name}}</td>
                                        <td>{{$val->created_at}}</td>
                                        <td>{{$val->updated_at}}</td>
                                        <td>
                                            <a data-id="{{$val->id}}" data-params='{"content": ".edit-subcat","area":"350px,230px", "title": "编辑标签"}'
                                               href="javascript:;"
                                               class="layui-btn-sm modal layui-badge layui-badge layui-bg-blue edit">编辑</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            {!! $tags->links() !!}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    {{--添加页面--}}
    <div class="add-subcat">
        <form id="form1" class="layui-form" action="/Admin/tags/store" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">标签名称</label>
                <div class="layui-input-block">
                    <input type="text" name="name" placeholder="请输入标签名称" autocomplete="off" class="layui-input ">
                </div>
            </div>
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" type="submit">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>
    {{--修改页面--}}
    <div class="edit-subcat" style="display: none;padding: 20px">
        <form id="form1" class="layui-form" action="/Admin/tags/edit" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label">标签名称</label>
                <div class="layui-input-block">
                    <input type="text" id="name" name="name" placeholder="请输入标签名称" autocomplete="off" class="layui-input ">
                </div>
            </div>
            <input type="hidden" id="id" name="id">
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
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
    <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
    <script src="/admin/js/common.js?v=2.0.1"></script>
    <script>
        $(function () {
           $('.edit').click(function () {
               var id = $(this).data('id');
               $.ajax({
                   type:'get',
                   url:'show/'+id,
                   dataType:'json',
                   success:function (de) {
                       //console.log(de);
                       $('#id').val(de['data'].id);
                       $('#name').val(de['data'].name);
                   }
               });
           });
        });
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
