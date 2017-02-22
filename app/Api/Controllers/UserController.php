<?php

namespace App\Api\Controllers;

use JWTAuth;
use App\Models\User;

class UserController extends BaseController
{
    public function index()
    {
        $users = User::all();
        return $this->response->array($users->toArray());
    }

    public function show($id)
    {
        try {
            $user = User::find($id);
        } catch (\Exception $e) {
            return $this->response->errorInternal($e->getMessage());
        }
        return $this->response->array($user->toArray());
    }
}