<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PrivateController extends Controller
{
    public function index($request): ResponseFactory|Response|JsonResponse
    {
        $token = $request->header('X-Auth-Token');
        if ($token === config('demo.auth_token')){
            return response()->json([
                'access' => 'granted',
                'message' => 'You are authenticated',
            ]);
        }
        return response('', 401);
    }
}
