<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Public routes
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/checktoken', function (Request $request) {
        return response()->json([
            'message' => 'Token is valid',
            'user' => $request->user(),
        ]);
    });
});
