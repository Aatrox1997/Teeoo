<?php

namespace App\Http\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends BaseContoller
{
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (!$token = \Auth::guard('api')->attempt($credentials)) {
            return $this->response->error("用户名或密码错误",222    );
        }
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ])->setStatusCode(201);
    }

    public function sendLoginResponse(Request $request, $token)
    {
        $this->clearLoginAttempts($request);

        return $this->authenticated($token);
    }

    public function authenticated($token)
    {
        return $this->response->array([
            'token' => $token,
            'status_code' => 200,
            'message' => 'User Authenticated'
        ]);
    }

    public function sendFailedLoginResponse()
    {
        throw new UnauthorizedHttpException("Bad Credentials");
    }

    public function logout()
    {
        $this->guard()->logout();
    }
}
