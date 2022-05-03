<?php

use App\Http\Controllers\Api\V1\UserController;
use App\Http\Middleware\APIVersion;
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

Route::get(
  '/user/{id}/karma-position',
  [UserController::class, 'get_karma_position']
);
