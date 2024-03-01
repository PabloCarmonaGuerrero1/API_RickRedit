<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\FriendshipController;
use App\Http\Controllers\Api\V1\IconsController;
use App\Http\Controllers\Api\V1\ReviewController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'v1',
], function ($router) {
    Route::apiResource('users', UserController::class)->middleware('api');
    Route::apiResource('comments', CommentController::class)->middleware('api');
    Route::apiResource('friendships', FriendshipController::class)->middleware('api'); 
    Route::apiResource('icons', IconsController::class)->middleware('api'); 
    Route::resource('reviews', ReviewController::class);
    Route::get('/friendships/{username}/{friendUsername}', [FriendshipController::class, 'show']);
    Route::delete('/friendships/{username}/{friendUsername}', [FriendshipController::class, 'destroy']); 
});