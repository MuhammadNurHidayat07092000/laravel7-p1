<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can re78uiloppppppppppppppppppister web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('foo', function () {
    return 'Hello World';
});

Route::redirect('/here', '/foo');

Route::get('user/{name?}', function ($name = 'John') {
    return $name;
});

Route::prefix('admin')->group(function () {
    Route::get('users', function () {
        return "admin > user";
        // Matches The "/admin/users" URL
    });
});
