@extends("layouts.app")

@section("css")
    <link rel="stylesheet" type="text/css" href="/admin/css/main.css?v2.0.1-simple" media="all">
@endsection
@section('content')
    <div class="layui-fluid larry-wrapper">
        <div class="layui-row layui-col-space30">
            <div class="layui-col-xs24">
                <section class="panel panel-padding">
                    <form id="form1" class="layui-form" method="post" action="/Admin/Setup/user">
                        <div class="layui-form-item">
                            <label class="layui-form-label">用户名</label>
                            <div class="layui-input-block">
                                <input type="text" name="name" value="{{$user->name}}" autocomplete="off" class="layui-input ">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">密码</label>
                            <div class="layui-input-block">
                                <input type="password" name="password" value="{{$user->password}}" autocomplete="off" class="layui-input ">
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">头像地址</label>
                            <div class="layui-input-block">
                                <input type="text" name="Headportrait" value="{{$user->Headportrait}}" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">邮箱</label>
                            <div class="layui-input-block">
                                <input type="email" name="email" value="{{$user->email}}" autocomplete="off" class="layui-input ">
                            </div>
                        </div>
                        {!! csrf_field() !!}
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <input class="layui-btn" type="submit" value="立即提交"/>
                                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
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
