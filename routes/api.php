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
Route::get('users', [UserController::class, 'getAllUsers']);

Route::middleware('auth:api')->group(function () {
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('users/{user}', [UserController::class, 'getUser']);

    Route::prefix('goals')->group(function () {
        Route::get('/', [GoalController::class, 'index']);
        Route::post('/', [GoalController::class, 'store']);

        Route::prefix('{goal}')->group(function () {
            Route::delete('/', [GoalController::class, 'destroy']);
            Route::get('/', [GoalController::class, 'show']);
            Route::put('/', [GoalController::class, 'update']);

            Route::get('/key-results', [KeyResultController::class, 'index']);
            Route::post('/', [KeyResultController::class, 'store']);
        });
    });

    Route::prefix('key-results/{keyResult}')->group(function () {
        Route::delete('/', [KeyResultController::class, 'destroy']);
        Route::put('/', [KeyResultController::class, 'update']);
        Route::get('/', [KeyResultController::class, 'show']);
        Route::post('/add-performers', [KeyResultController::class, 'addUserToPerformers']);
    });
});

