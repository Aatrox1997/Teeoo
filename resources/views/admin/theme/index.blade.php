@extends("layouts.app")

@section("title","主题")

@section("content")
    <section class="panel panel-padding">
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
            <legend>主题</legend>
        </fieldset>
        @foreach($array as $value)
            <table class="layui-table" lay-even="" lay-skin="nob">
                <tr>
                    <th>截图</th>
                    <th>详情</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <img style="max-width: 500px;" src="/themes/{{$value["slug"]}}/{{$value["printscreen"]}}" alt="">
                    </td>
                    <td>
                        <h3>{{$value["name"]}}</h3>
                        <p>作者: <a href="{{$value["web"]}}" target="_blank">{{$value["author"]}}</a></p>
                        <p>版本: {{$value["version"]}}</p>
                        <p>描述: {{$value["description"]}}</p>
                    </td>
                    <td>
                        @if(env("APP_THEME")!=$value["slug"])
                            <a href="/Admin/themes/set_theme/{{$value["slug"]}}"><span class="layui-badge">启用</span></a>
                        @else
                            <span class="layui-badge layui-bg-gray">启用</span>
                        @endif
                    </td>
                </tr>
            </table>
            <hr class="layui-bg-gray">
        @endforeach
    </section>
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