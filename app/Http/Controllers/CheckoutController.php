<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /** @var array<string, string> */
    private static array $variantDescriptions = [
        'checkout_v2' => 'Simplified one-page checkout',
        'checkout_v3' => 'Express checkout with saved addresses',
        'control' => 'Standard multi-step checkout',
    ];

    public function index(Request $request): JsonResponse
    {
        $variantFromServer = $request->server('HTTP_X_AB_VARIANT', 'not set');
        $variantFromCookie = $request->cookie('ab_variant', 'not set');

        $activeVariant = $variantFromCookie !== 'not set' ? $variantFromCookie : $variantFromServer;
        $description = self::$variantDescriptions[$activeVariant] ?? 'Unknown variant';

        return response()->json([
            'nginx_demo' => 'split_clients — A/B variant assignment',
            'variant_from_server_var' => $variantFromServer,
            'variant_from_cookie' => $variantFromCookie,
            'variant_description' => $description,
        ]);
    }
}
