<?php

function Prompt($data, $message, $url)
{
    if ($data) {
        return redirect($url)->with([
                'message' => $message . "成功",
                'icon' => '6'
            ]
        );
    } else {
        return redirect($url)->with([
                'message' => $message . "失败",
                'icon' => '5'
            ]
        );
    }
}

function set_Env(array $data)
{
    $envPath = base_path() . DIRECTORY_SEPARATOR . '.env';

    $contentArray = collect(file($envPath, FILE_IGNORE_NEW_LINES));

    $contentArray->transform(function ($item) use ($data) {
        foreach ($data as $key => $value) {
            if (str_contains($item, $key)) {
                return $key . '=' . $value;
            }
        }

        return $item;
    });

    $content = implode($contentArray->toArray(), "\n");

    return \File::put($envPath, $content);
}

function string_remove_xss($html)
{
    preg_match_all("/\<([^\<]+)\>/is", $html, $ms);
    $searchs[] = '<';
    $replaces[] = '&lt;';
    $searchs[] = '>';
    $replaces[] = '&gt;';
    if ($ms[1]) {
        $allowtags = 'img|a|font|div|table|tbody|caption|tr|td|th|br|p|b|strong|i|u|em|span|ol|ul|li|blockquote';
        $ms[1] = array_unique($ms[1]);
        foreach ($ms[1] as $value) {
            $searchs[] = "&lt;" . $value . "&gt;";

            $value = str_replace('&amp;', '_uch_tmp_str_', $value);
            $value = string_htmlspecialchars($value);
            $value = str_replace('_uch_tmp_str_', '&amp;', $value);
            $value = str_replace(array('\\', '/*'), array('.', '/.'), $value);
            $skipkeys = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate',
                'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange',
                'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick',
                'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate',
                'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete',
                'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel',
                'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart',
                'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop',
                'onsubmit', 'onunload', 'javascript', 'script', 'eval', 'behaviour', 'expression', 'style', 'class');
            $skipstr = implode('|', $skipkeys);
            $value = preg_replace(array("/($skipstr)/i"), '.', $value);
            if (!preg_match("/^[\/|\s]?($allowtags)(\s+|$)/is", $value)) {
                $value = '';
            }
            $replaces[] = empty($value) ? '' : "<" . str_replace('&quot;', '"', $value) . ">";
        }
    }
    $html = str_replace($searchs, $replaces, $html);
    return $html;
}

function string_htmlspecialchars($string, $flags = null)
{
    if (is_array($string)) {
        foreach ($string as $key => $val) {
            $string[$key] = string_htmlspecialchars($val, $flags);
        }
    } else {
        if ($flags === null) {
            $string = str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string);
            if (strpos($string, '&amp;#') !== false) {
                $string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4}));)/', '&\\1', $string);
            }
        } else {
            if (PHP_VERSION < '5.4.0') {
                $string = htmlspecialchars($string, $flags);
            } else {
                if (!defined('CHARSET') || (strtolower(CHARSET) == 'utf-8')) {
                    $charset = 'UTF-8';
                } else {
                    $charset = 'ISO-8859-1';
                }
                $string = htmlspecialchars($string, $flags, $charset);
            }
        }
    }
    return $string;
}

function getSystemInfo()
{
    $systemInfo = array();

    // 系统
    $systemInfo['os'] = PHP_OS;

    // PHP版本
    $systemInfo['phpversion'] = PHP_VERSION;

    // Apache版本
//    $systemInfo['apacheversion'] = apache_get_version();

    // ZEND版本
    $systemInfo['zendversion'] = zend_version();

    // GD相关
    if (function_exists('gd_info')) {
        $gdInfo = gd_info();
        $systemInfo['gdsupport'] = true;
        $systemInfo['gdversion'] = $gdInfo['GD Version'];
    } else {
        $systemInfo['gdsupport'] = false;
        $systemInfo['gdversion'] = '';
    }

    // 安全模式
    $systemInfo['safemode'] = ini_get('safe_mode');

    // 注册全局变量
    $systemInfo['registerglobals'] = ini_get('register_globals');

    // 开启魔术引用
    $systemInfo['magicquotes'] = (function_exists("get_magic_quotes_gpc") && get_magic_quotes_gpc());

    // 最大上传文件大小
    $systemInfo['maxuploadfile'] = ini_get('upload_max_filesize');
    // 脚本运行占用最大内存
    $systemInfo['memorylimit'] = get_cfg_var("memory_limit") ? get_cfg_var("memory_limit") : '-';

    return $systemInfo;
}

function send_em($da, $us)
{
    \Mail::send('send_em',
        [
            'title' => $da->comment_content->title,
            'author' => $da->username,
            'mail' => $da->email,
            'time' => $da->created_at,
            'link' => env("SITE_address") . "/archives/{$da->comment_content->slug}.html#comments-{$da->id}/",
            'content' => $da->content
        ], function ($m) use ($da, $us) {
            $m->to($us->email, $us->name)->subject("[{$da->comment_content->title}]一文有新的评论了！");
        });

}

function reply_em($da,$c)
{
    \Mail::send('reply_em',
        [
            'title' => $da->comment_content->title,
            'author' => $da->username,
            'mail' => $da->email,
            'time' => $da->created_at,
            'link' => env("SITE_address") . "/archives/{$da->comment_content->slug}.html#comments-{$da->id}/",
            'content' => $da->content,
            'y_text' => $c->content
        ], function ($m) use ($da,$c) {
            $m->to($c->email, $c->name)->subject("[{$da->comment_content->title}]一文有新的评论了！");
        });

}



