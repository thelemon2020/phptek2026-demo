<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthCheckController;
use App\Http\Controllers\CacheController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\MirrorController;
use App\Http\Controllers\PrivateController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DemoController::class, 'home']);

Route::get('/about', [RedirectController::class, 'about']);
Route::get('/contact', [RedirectController::class, 'contact']);
Route::get('/services', [RedirectController::class, 'services']);
Route::get('/promotions', [RedirectController::class, 'promotions']);
Route::get('/artist-formerly-known-as-prince', [RedirectController::class, 'artistFormerlyKnownAsPrince']);

Route::get('/albums/{id}', [CacheController::class, 'product']);

Route::get('/search', [SearchController::class, 'index']);

Route::get('/private', [PrivateController::class, 'index']);
Route::get('/auth', [AuthCheckController::class, 'check']);

Route::get('/admin', [AdminController::class, 'index']);

Route::get('/shop', [ShopController::class, 'index']);

Route::get('/checkout', [CheckoutController::class, 'index']);

Route::get('/mirror-log', [MirrorController::class, 'index']);
Route::post('/mirror-log', [MirrorController::class, 'store']);
Route::get('/do-mirror', [MirrorController::class, 'store']);
