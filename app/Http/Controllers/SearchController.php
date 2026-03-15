<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /** @var array<int, array{id: int, name: string, price: string}> */
    private static array $products = [
        1 => ['id' => 1, 'name' => 'Pro Headlamp 3000', 'price' => '$49.99'],
        2 => ['id' => 2, 'name' => 'Trail Boots X', 'price' => '$129.99'],
        3 => ['id' => 3, 'name' => 'Hydration Pack 2L', 'price' => '$39.99'],
        4 => ['id' => 4, 'name' => 'Trekking Poles Pro', 'price' => '$79.99'],
        5 => ['id' => 5, 'name' => 'Sleeping Bag -10C', 'price' => '$199.99'],
    ];

    public function index(Request $request): JsonResponse
    {
        $query = $request->query('q', '');

        $results = collect(self::$products)
            ->filter(fn (array $product) => str_contains(strtolower($product['name']), strtolower($query)))
            ->pluck('name')
            ->values()
            ->all();

        return response()->json([
            'query' => $query,
            'results' => $results,
        ]);
    }
}
