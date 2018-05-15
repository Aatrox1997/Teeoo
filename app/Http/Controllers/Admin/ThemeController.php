<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ThemeController extends Controller
{
    /**
     * Notes:主题列表
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:41
     * Function Name: index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $theme_name = array_diff(scandir(public_path("themes")), [".", ".."]);
        foreach ($theme_name as $item) {
            $array[] = \Theme::theme($item)->info();
        }
        return view("admin.theme.index", compact('array'));
    }

    /**
     * Notes:设置主题
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:41
     * Function Name: set_theme
     * @param $theme
     * @return \Illuminate\Http\RedirectResponse
     */
    public function set_theme($theme)
    {
        set_Env(["APP_THEME" => $theme]);
        \Artisan::call('config:clear');
        \Artisan::call('cache:clear');
        \Artisan::call('view:clear');
        return Prompt(1, "主题修改", "Admin/themes/");
    }
}
