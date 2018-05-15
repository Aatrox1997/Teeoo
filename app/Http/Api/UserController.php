<?php

namespace App\Http\Api;

use App\User;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends BaseContoller
{
    use AuthenticatesUsers;
    use Helpers;

    public function __construct()
    {
        $this->middleware('api.auth');
    }
    public function user(){
        $user = $this->auth->user();

        return $user;
    }
    public function update()
    {
        $token = \Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }

    public function destroy()
    {
        \Auth::logout();
        return $this->response->noContent();
    }
}
