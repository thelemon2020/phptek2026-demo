<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class PrivateController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'access' => 'granted',
            'message' => 'You are authenticated',
        ]);
    }
}
