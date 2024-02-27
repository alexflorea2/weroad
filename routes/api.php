<?php

use App\Http\Controllers\Api\v1\ToursController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// API Version 1
Route::prefix('v1')->group(function () {
    // Public routes
    Route::get('/tours/{tavelSlug}', [ToursController::class, 'list']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        // Admin and editor routes...
    });
});
