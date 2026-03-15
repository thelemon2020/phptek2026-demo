<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $countryCode = $request->header('X-Country-Code');
        $countryName = $request->header('X-Country-Name');
        $city = $request->header('X-City');
        $region = $request->header('X-Region');
        $timezone = $request->header('X-Timezone');

        $hasGeoHeaders = $countryCode !== null;

        $rawHeaders = array_filter([
            'X-Country-Code' => $countryCode,
            'X-Country-Name' => $countryName,
            'X-City' => $city,
            'X-Region' => $region,
            'X-Timezone' => $timezone,
        ]);

        $response = [
            'nginx_demo' => 'GeoIP2 headers injected by nginx',
            'country_code' => $countryCode,
            'country_name' => $countryName,
            'city' => $city,
            'region' => $region,
            'timezone' => $timezone,
            'raw_headers_received' => $rawHeaders ?: (object) [],
        ];

        if (! $hasGeoHeaders) {
            $response['note'] = 'GeoIP2 not configured in nginx';
        }

        return response()->json($response);
    }
}
