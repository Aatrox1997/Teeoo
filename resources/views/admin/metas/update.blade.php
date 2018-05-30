@extends("layouts.app")

@section("css")
    <link rel="stylesheet" href="/admin/css/black/jqadmin.css">
    <link rel="stylesheet" type="text/css" href="/admin/css/main.css?v2.0.1-simple" media="all">
@endsection
@section('content')
    <section class="panel panel-padding">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
            <legend>修改分类  -- {{$metas->types}}</legend>
        </fieldset>
        <div class="layui-fluid larry-wrapper">
            <div class="update-subcat">
                <form id="form1" class="layui-form" action="/Admin/metas/update/{{$metas->id}}" method="post">
                    <div class="layui-form-item">
                        <label class="layui-form-label">父级分类</label>
                        <div class="layui-input-inline">
                            <select name="parent" id="pid-select" jq-verify="required" jq-error="请输入分类"
                                    lay-filter="pid-select">
                                <option value="0">顶级分类</option>
                                @foreach($metas_all as $me)
                                    @if($me->id==$metas->parent)
                                        <option selected value="{{$me->id}}">{{$me->types}}</option>
                                        @else
                                        <option value="{{$me->id}}">{{$me->types}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">分类名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="types" value="{{$metas->types}}" placeholder="请输入分类名称"
                                   autocomplete="off" class="layui-input ">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">别名</label>
                        <div class="layui-input-block">
                            <input type="text" name="slug" value="{{$metas->slug}}" placeholder="请输入分类名称"
                                   autocomplete="off"
                                   class="layui-input ">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">排序</label>
                        <div class="layui-input-inline">
                            <input type="text" name="order" value="{{$metas->order}}" placeholder="分类排序"
                                   autocomplete="off"
                                   class="layui-input ">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">icon</label>
                        <div class="layui-input-inline">
                            <input type="text" name="icon" value="{{$metas->icon}}"
                                   placeholder="page-icon icon-category"
                                   autocomplete="off"
                                   class="layui-input ">
                        </div>
                    </div>
                    {{--{!! csrf_field() !!}--}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                    <div class="layui-form-item">
                        <label class="layui-form-label">描述</label>
                        <div class="layui-input-block">
                            <textarea name="description" class="layui-textarea">{{$metas->description}}</textarea>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" id="btnsave" type="submit">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section("js")
    <script src="/admin/js/common.js?v=2.0.1"></script>
    <script>
        layui.use('cat-list');
        layui.use('layer', function () {
            var layer = layui.layer;
            //字段验证
            @if($errors->any())
            @foreach($errors->all() as $error)
            layer.msg('{{ $error }}', {icon: 5}, {anim: 1});
            @endforeach
            @endif

        });
    </script>
@endsection