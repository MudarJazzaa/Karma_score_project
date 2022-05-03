<?php

use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::view('/{any}', 'dashboard')
//     ->where('any', '.*');

// Route::get('user/45/karma-position?num=9', [UserController::class, 'get_karma_position']);
// Route::get('list', [UserController::class, 'list']);

// Route::view('/', 'dashboard');
