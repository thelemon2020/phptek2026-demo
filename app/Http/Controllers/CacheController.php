<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class CacheController extends Controller
{
    /** @var array<int, array{id: int, title: string, artist: string, price: string}> */
    private static array $albums = [
        1 => ['id' => 1, 'title' => 'The Dark Side of the Moon', 'artist' => 'Pink Floyd', 'price' => '$34.99'],
        2 => ['id' => 2, 'title' => 'Kind of Blue', 'artist' => 'Miles Davis', 'price' => '$29.99'],
        3 => ['id' => 3, 'title' => 'Rumours', 'artist' => 'Fleetwood Mac', 'price' => '$31.99'],
        4 => ['id' => 4, 'title' => 'Purple Rain', 'artist' => 'Prince', 'price' => '$27.99'],
        5 => ['id' => 5, 'title' => 'Thriller', 'artist' => 'Michael Jackson', 'price' => '$29.99'],
    ];

    public function product(int $id): JsonResponse
    {
        $album = self::$albums[$id] ?? null;

        if (! $album) {
            return response()->json(['error' => 'Album not found'], 404);
        }

        return response()->json([
            'id' => $album['id'],
            'title' => $album['title'],
            'artist' => $album['artist'],
            'price' => $album['price'],
            'generated_at' => now()->toDateTimeString(),
        ]);
    }
}
