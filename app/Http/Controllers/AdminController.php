<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'admin' => true,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}
