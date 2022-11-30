<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Admin\ChartController;

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

require __DIR__ . '/auth.php';

Route::group(['middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::group(['prefix' => 'users', 'controller' => UsersController::class], function () {
        Route::get('', 'index')->name('users.index');
        Route::get('{user}', 'show')->name('users.show');
    });
    Route::group(['prefix' => 'charts', 'controller' => ChartController::class], function () {
        Route::get('', 'index')->name('charts.index');
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('{any}', function () {
    return view('index');
})->where('any', '.*');
