<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TableController;

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

    // ROLE ROUTES
    Route::prefix('roles')->group(function(){
        Route::get('/', [RoleController::class, 'all']);
        Route::post('/', [RoleController::class, 'save']);
        Route::get('/{id}', [RoleController::class, 'find'])->where('id', '[0-9]+');
        Route::delete('/{id}', [RoleController::class, 'delete'])->where('id', '[0-9]+');
        Route::get('/role-users', [RoleController::class, 'getRoleUsers']);
    });

    // TABLE ROUTES
    Route::prefix('tables')->group(function(){
        Route::get('/', [TableController::class, 'all']);
        Route::post('/', [TableController::class, 'save']);
        Route::get('/{id}', [TableController::class, 'find'])->where('id', '[0-9]+');
        Route::delete('/{id}', [TableController::class, 'delete'])->where('id', '[0-9]+');
    });
});