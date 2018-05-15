<table style="width: 99.8%;height:99.8% ">
    <tbody>
    <tr>
        <td style="background:#fafafa url(https://img.vpsmm.com/2018/03/mailimg.png)">
            <div style="border-radius: 10px 10px 10px 10px;font-size:13px;    color: #555555;width: 80%;font-family:'Century Gothic','Trebuchet MS','Hiragino Sans GB',微软雅黑,'Microsoft Yahei',Tahoma,Helvetica,Arial,'SimSun',sans-serif;margin:50px auto;border:1px solid #eee;max-width:100%;background: #ffffff repeating-linear-gradient(-45deg,#fff,#fff 1.125rem,transparent 1.125rem,transparent 2.25rem);box-shadow: 0 1px 5px rgba(0, 0, 0, 0.15);">
                <div style="width:100%;background:#49BDAD;color:#ffffff;border-radius: 10px 10px 0 0;background-image: -moz-linear-gradient(0deg, rgb(67, 198, 184), rgb(255, 209, 244));background-image: -webkit-linear-gradient(0deg, rgb(67, 198, 184), rgb(255, 209, 244));height: 66px;">
                    <p style="font-size:15px;word-break:break-all;padding: 23px 32px;margin:0;background-color: hsla(0,0%,100%,.4);border-radius: 10px 10px 0 0;">
                        您的博客<a style="text-decoration:none;color: #ffffff;" href="{{env("SITE_address")}}"> {{env('SITE_NAME')}} </a>上有新的留言啦！
                    </p>
                </div>
                <div style="margin:40px auto;width:90%">
                    <p>{{$author}} 给您的文章《 {{$title}} 》留言如下：</p>
                    <p style="background: #fafafa repeating-linear-gradient(-45deg,#fff,#fff 1.125rem,transparent 1.125rem,transparent 2.25rem);box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);margin:20px 0px;padding:15px;border-radius:5px;font-size:14px;color:#555555;">
                        {{$content}}</p>
                    <p>邮件：{{$mail}} ，时间：{{$time}} ，地址：<a href="{{$link}}">点击查看详情</a> </p>
                    <style type="text/css">a:link {
                            text-decoration: none
                        }

                        a:visited {
                            text-decoration: none
                        }

                        a:hover {
                            text-decoration: none
                        }

                        a:active {
                            text-decoration: none
                        }</style>
                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>