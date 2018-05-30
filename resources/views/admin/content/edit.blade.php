@extends("layouts.app")

@section("css")
    <link rel="stylesheet" type="text/css" href="/admin/css/main.css?v2.0.1-simple" media="all">
    <link rel="stylesheet" href="/editor/css/editormd.min.css"/>

    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300">--}}
    {{--<link rel="stylesheet" href="https://cdn.rawgit.com/yahoo/pure-release/v0.6.0/pure-min.css">--}}
    <link rel="stylesheet" href="/admin/css/jquery.tag-editor.css">
    <link rel="stylesheet" href="//at.alicdn.com/t/font_579919_o0mndrxy4tmlsor.css"/>
@endsection
@section('content')
    <div class="layui-fluid larry-wrapper">
        <section class="panel panel-padding">
            <form id="form1" class="layui-form " action="/Admin/content/edit/{{$contents->id}}" method="post">
                <div class="layui-row">
                    <div class="layui-col-xs9">
                        <section class="panel panel-padding">
                            <div class="layui-form-item">
                                <label class="layui-form-label">文章标题</label>
                                <div class="layui-input-block">
                                    <input type="text" name="title" value="{{$contents->title}}" placeholder="请输入标题" autocomplete="off" class="layui-input ">
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">URL</label>
                                <div class="layui-input-block" style="padding-top: 10px">
                                <span style="padding-top: 5px">{{env('SITE_HOST')}}/
                                    <input style="width: 25px;border-left: 0px;border-top: 0px;border-right: 0px" type="text" name="slug" value="{{$contents->slug}}">/</span>
                                </div>
                            </div>
                            <div class="layui-form-item">
                                <label class="layui-form-label">内容</label>
                                <div class="layui-input-block">
                                    <div id="my-editormd">
                                    <textarea id="my-editormd-markdown-doc" name="my-editormd-markdown-doc"
                                              style="display:none;">{{$contents->text}}</textarea>
                                        <textarea id="my-editormd-html-code" name="my-editormd-html-code"
                                                  style="display:none;">{!!  $contents->html!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="layui-col-xs3">
                        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
                            <legend>分类与标签</legend>
                        </fieldset>
                        <div class="layui-form-item">
                            <label class="layui-form-label">文章分类</label>
                            <div class="layui-input-block">
                                <select name="metas_id" id="" class="layui-input ">
                                    @foreach($metas as $me)
                                        @if($contents->metas_id == $me->id)
                                            <option value="{{$me->id}}" selected>{{$me->types}}</option>
                                        @else
                                            <option value="{{$me->id}}">{{$me->types}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">Tags</label>
                            <div class="layui-input-block">
                                <textarea id="tags" name="tags" class="layui-textarea">
                                    @if(is_null($contents->tags))
                                        没有标签
                                    @else
                                        @foreach($contents->tags as $tag)
                                            {{$tag->name}},
                                        @endforeach
                                    @endif
                                </textarea>
                            </div>
                        </div>
                        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
                            <legend>更多功能</legend>
                        </fieldset>
                        <div class="layui-form-item">
                            <label class="layui-form-label">公开度</label>
                            <div class="layui-input-block">
                                <select name="status" id="" class="layui-input ">
                                    @if($contents->status  == "publish")
                                        <option value="publish" selected="">公开</option>
                                        <option value="hidden">隐藏</option>
                                        <option value="password">密码保护</option>
                                        <option value="private">私密</option>
                                        <option value="waiting">待审核</option>
                                    @elseif($contents->status == "hidden")
                                        <option value="publish">公开</option>
                                        <option value="hidden" selected="">隐藏</option>
                                        <option value="password">密码保护</option>
                                        <option value="private">私密</option>
                                        <option value="waiting">待审核</option>
                                    @elseif($contents->status =="password")
                                        <option value="publish">公开</option>
                                        <option value="hidden">隐藏</option>
                                        <option value="password" selected="">密码保护</option>
                                        <option value="private">私密</option>
                                        <option value="waiting">待审核</option>
                                    @elseif($contents->status =="private")
                                        <option value="publish">公开</option>
                                        <option value="hidden">隐藏</option>
                                        <option value="password">密码保护</option>
                                        <option value="private" selected="">私密</option>
                                        <option value="waiting">待审核</option>
                                    @elseif($contents->status =="waiting")
                                        <option value="publish">公开</option>
                                        <option value="hidden">隐藏</option>
                                        <option value="password">密码保护</option>
                                        <option value="private">私密</option>
                                        <option value="waiting" selected="">待审核</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">权限</label>
                            <div class="layui-input-block">
                                @if($contents->criticism == "1")
                                    <input type="checkbox" name="criticism" value="1" title="允许评论" checked="">
                                @else
                                    <input type="checkbox" name="criticism" value="2" title="允许评论">
                                @endif
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">引用通告</label>
                            <div class="layui-input-block">
                                <textarea name="quote" placeholder="请输入内容 每一行一个引用地址, 用回车隔开" class="layui-textarea">{{$contents->quote}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" jq-submit jq-filter="submit">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
@endsection
@section("js")
    <script src="/admin/js/common.js?v=2.0.1"></script>
    <script src="https://cdn.bootcss.com/jquery/2.2.0/jquery.min.js"></script>
    <script src="/editor/editormd.min.js"></script>

    {{--<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>--}}
    {{--<script src="https://code.jquery.com/ui/1.10.2/jquery-ui.min.js"></script>--}}
    <script src="https://cdn.bootcss.com/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="/admin/js/jquery.caret.min.js"></script>
    <script src="/admin/js/jquery.tag-editor.js"></script>

    <script>
        // jQuery UI autocomplete extension - suggest labels may contain HTML tags
        // github.com/scottgonzalez/jquery-ui-extensions/blob/master/src/autocomplete/jquery.ui.autocomplete.html.js
        (function ($) {
            var proto = $.ui.autocomplete.prototype, initSource = proto._initSource;

            function filter(array, term) {
                var matcher = new RegExp($.ui.autocomplete.escapeRegex(term), "i");
                return $.grep(array, function (value) {
                    return matcher.test($("<div>").html(value.label || value.value || value).text());
                });
            }

            $.extend(proto, {
                _initSource: function () {
                    if (this.options.html && $.isArray(this.options.source)) {
                        this.source = function (request, response) {
                            response(filter(this.options.source, request.term));
                        };
                    } else {
                        initSource.call(this);
                    }
                }, _renderItem: function (ul, item) {
                    return $("<li></li>").data("item.autocomplete", item).append($("<a></a>")[this.options.html ? "html" : "text"](item.label)).appendTo(ul);
                }
            });
        })(jQuery);

        var cache = {};

        function googleSuggest(request, response) {
            var term = request.term;
            if (term in cache) {
                response(cache[term]);
                return;
            }
        }

        $(function () {
            editormd("my-editormd", {
                width: "100%",
                height: 500,
                syncScrolling: "single",
                path: "/editor/lib/",
                saveHTMLToTextarea: true,
                /**上传图片相关配置*/
                imageUpload: true,
                imageFormats: ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
                imageUploadURL: "/Admin/content/uploadimage",
                emoji: true,//emoji表情，默认关闭
                taskList: true,
                tocm: true, // Using [TOCM]
                tex: true,// 开启科学公式TeX语言支持，默认关闭
                flowChart: true,//开启流程图支持，默认关闭
                sequenceDiagram: true,//开启时序/序列图支持，默认关闭,
                dialogLockScreen: false,//设置弹出层对话框不锁屏，全局通用，默认为true
                dialogShowMask: false,//设置弹出层对话框显示透明遮罩层，全局通用，默认为true
                dialogDraggable: false,//设置弹出层对话框不可拖动，全局通用，默认为true
                dialogMaskOpacity: 0.4, //设置透明遮罩层的透明度，全局通用，默认值为0.1
                dialogMaskBgColor: "#000",//设置透明遮罩层的背景颜色，全局通用，默认为#fff

                codeFold: true,
            });


            $('#tags').tagEditor({
                placeholder: '请输入 tags 回车键添加...',
                autocomplete: {
                    source: googleSuggest,
                    minLength: 3,
                    delay: 250,
                    html: true,
                    position: {collision: 'flip'}
                }
            });

            function tag_classes(field, editor, tags) {
                $('li', editor).each(function () {
                    console.info(this);
                    var li = $(this);
                    if (li.find('.tag-editor-tag').html() == 'red') li.addClass('red-tag');
                    else if (li.find('.tag-editor-tag').html() == 'green') li.addClass('green-tag')
                    else li.removeClass('red-tag green-tag');
                });
            }
        });
        layui.use(['form'], function(){});
    </script>
@endsection
