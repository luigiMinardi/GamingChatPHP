<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('/users/logout', [UserController::class, 'logout']);

    Route::get('/games/{game}/parties', [PartyController::class, 'getByGame']);

    Route::get('/parties/{party}/messages', [MessageController::class, 'getByParty']);
});

Route::post('/users/login', [UserController::class, 'login']);
Route::apiResource('users', UserController::class);

Route::apiResource('games', GameController::class);

Route::apiResource('parties', PartyController::class);

Route::apiResource('messages', MessageController::class);

Route::apiResource('members', MemberController::class)->except(['update']);
