<?php

use App\Http\Controllers\KeyResultController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('register', [UserController::class, 'register']);
Route::get('login', [UserController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::get('logout', [UserController::class, 'logout']);

    Route::get('goals', [GoalController::class, 'index']);
    Route::post('goals', [GoalController::class, 'store']);

    Route::get('goals/{goal}', [KeyResultController::class, 'show']);
});

