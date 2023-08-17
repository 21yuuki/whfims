<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::group(['middleware' => ['auth:api', 'cors']], function(){

    // USER ROUTES
    Route::prefix('users')->group(function(){
        Route::get('/', [UserController::class, 'all']);
        Route::post('/', [UserController::class, 'save']);
        Route::get('/{id}', [UserController::class, 'find'])->where('id', '[0-9]+');
        Route::delete('/{id}', [UserController::class, 'delete'])->where('id', '[0-9]+');
        Route::get('/current-user', [UserController::class, 'getAuthenticatedUser']);
        Route::post('/logout', [UserController::class, 'logout']);
    });
});