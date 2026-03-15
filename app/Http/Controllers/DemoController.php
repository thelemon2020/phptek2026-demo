<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class DemoController extends Controller
{
    public function home(): JsonResponse
    {
        return response()->json([
            'app' => 'NginxMart Demo — Nginx and You @ PHPTek 2026',
            'demos' => [
                'redirects' => [
                    'simple' => 'curl -I /about-us',
                    'rewrite' => 'curl -I /product/1',
                    'map' => 'curl -I /old-contact',
                ],
                'caching' => 'curl -I /products/1',
                'access_control' => ['curl /admin', 'curl /private', 'curl /search (x10)'],
                'geo' => 'curl /shop',
                'split_testing' => 'curl /checkout',
                'mirroring' => 'curl /mirror-log',
            ],
        ]);
    }
}
