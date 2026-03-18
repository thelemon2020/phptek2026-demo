<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private const BASE_CURRENCY = 'CAD';

    private const BASE_PRICE = 34.99;

    /** @var array<string, array{currency: string, rate: float}> */
    private const COUNTRY_CURRENCY = [
        'US' => ['currency' => 'USD', 'rate' => 0.74],
        'GB' => ['currency' => 'GBP', 'rate' => 0.58],
        'EU' => ['currency' => 'EUR', 'rate' => 0.68],
        'FR' => ['currency' => 'EUR', 'rate' => 0.68],
        'DE' => ['currency' => 'EUR', 'rate' => 0.68],
        'AU' => ['currency' => 'AUD', 'rate' => 1.12],
        'JP' => ['currency' => 'JPY', 'rate' => 110.50],
    ];

    public function index(Request $request): JsonResponse
    {
        $countryCode = $request->header('X-Country-Code');
        $countryName = $request->header('X-Country-Name');
        $city = $request->header('X-City');

        $localCurrency = self::COUNTRY_CURRENCY[$countryCode] ?? null;
        $localPrice = $localCurrency
            ? round(self::BASE_PRICE * $localCurrency['rate'], 2)
            : null;

        $response = [
            'nginx_demo' => 'GeoIP2 headers injected by nginx',
            'country_code' => $countryCode,
            'country_name' => $countryName,
            'city' => $city,
            'original_currency' => self::BASE_CURRENCY,
            'original_price' => self::BASE_PRICE,
            'local_currency' => $localCurrency['currency'] ?? self::BASE_CURRENCY,
            'local_price' => $localPrice ?? self::BASE_PRICE,
        ];

        if ($countryCode === null) {
            $response['note'] = 'GeoIP2 not configured in nginx';
        } elseif ($localCurrency === null) {
            $response['note'] = 'No currency mapping for this country — showing CAD';
        }

        return response()->json($response);
    }
}
