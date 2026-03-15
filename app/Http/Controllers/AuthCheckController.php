<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthCheckController extends Controller
{
    public function check(Request $request): Response
    {
        $token = $request->header('X-Auth-Token');

        if ($token === config('demo.auth_token')) {
            return response('', 200);
        }

        return response('', 401);
    }
}
