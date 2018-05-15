<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Notes:登录视图
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:29
     * Function Name: index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view("admin.login.login");
    }

    /**
     * Notes:登录
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:29
     * Function Name: login
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $input = $request->except(['_token']);
        //        dump(\Auth::attempt($input));
        if (\Auth::attempt($input)) {
            // 认证通过...
            return redirect("/Admin/");
        }else{
            $this->index();
        }
    }

    /**
     * Notes:注销登录
     * User: Teeoo
     * Date: 2018/4/18
     * Time: 14:30
     * Function Name: logout
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logout()
    {
        \Auth::logout();
        return $this->index();
    }
}
