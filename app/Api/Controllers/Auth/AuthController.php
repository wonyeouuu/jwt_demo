<?php

namespace App\Api\Controllers\Auth;

use JWTAuth;
use App\Models\User;
use Dingo\Api\Http\Request;
use App\Api\Controllers\BaseController;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends BaseController
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->response->errorUnauthorized();
            }
        } catch (JWTException $e) {
            return $this->response->errorInternal();
        }
        return $this->response->array(compact('token'))->setStatusCode(200);
    }

    public function register(Request $request)
    {
        try {
            User::create($request->all());
        } catch (\Exception $e) {
            return $this->response->errorInternal($e->getMessage());
        }
        return $this->response->created('Created.');
    }
}