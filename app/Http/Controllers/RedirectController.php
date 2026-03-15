<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class RedirectController extends Controller
{
    public function about(): JsonResponse
    {
        return response()->json([
            'page' => 'about',
            'nginx_demo' => 'redirected from /about-us via nginx 301',
        ]);
    }

    public function contact(): JsonResponse
    {
        return response()->json([
            'page' => 'contact',
            'nginx_demo' => 'redirected from /old-contact via nginx map 301',
        ]);
    }

    public function services(): JsonResponse
    {
        return response()->json([
            'page' => 'services',
            'nginx_demo' => 'redirected from /our-services via nginx map 301',
        ]);
    }

    public function promotions(): JsonResponse
    {
        return response()->json([
            'page' => 'promotions',
            'nginx_demo' => 'redirected from /sale via nginx map 301',
        ]);
    }
}
