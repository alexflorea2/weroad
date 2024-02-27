<?php

use App\Http\Controllers\Admin\ToursController as AdminToursController;
use App\Http\Controllers\Admin\TravelsController as AdminTravelsController;
use App\Http\Controllers\Api\v1\ToursController as PublicToursController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Response;
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
    Route::get('/tours/{travelSlug}', [PublicToursController::class, 'list']);

    // Group for protected routes
    Route::middleware('auth:sanctum')->group(function () {
        // Admin routes
        Route::middleware('checkUserRole:admin')->group(function () {
            Route::post('/admin/travels', [AdminTravelsController::class, 'createTravel']);
            Route::post('/admin/tours', [AdminToursController::class, 'createTour']);
        });

        // Editor routes
        Route::middleware('checkUserRole:editor,admin')->group(function () {
            Route::patch('/admin/travels/{travelUuid}', [AdminTravelsController::class, 'updateTravel']);
        });
    });
});

Route::post('/auth/login', [AuthController::class, 'login']);

Route::any('{any}', function () {
    return response()->json(['message' => 'Not Found'], Response::HTTP_NOT_FOUND);
})->where('any', '.*');
