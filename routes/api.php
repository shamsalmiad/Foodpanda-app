<?php

use App\Models\Auth\PersonalAccessToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [App\Http\Controllers\Auth\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\Auth\AuthController::class, 'login']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth.token'])->group(function () {
    Route::get('/dashboard', function () {
        return response()->json([
            'message' => 'Welcome to Foodpanda!',
            'user' => auth()->user(),
        ]);
    });
});


Route::get('/test-token', function(Request $request) {
    $token = $request->bearerToken();

    $pat = PersonalAccessToken::findToken($token);

    if(!$pat) return response()->json(['error' => 'Token not found'], 401);

    return response()->json(['user' => $pat->tokenable,'grettings' => 'Hello!']);
});

Route::get('/debug', function () {
    dd(PersonalAccessToken::all());
    return response()->json([
        'user' => auth()->user(),
        'guard' => get_class(auth()->guard()),
        'token' => request()->bearerToken(),

    ]);
});



