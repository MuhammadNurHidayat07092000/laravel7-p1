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
    return view('welcome', ['title' => 'Yayat Belajar']);
});

Route::get('home', function () {
    return view('home');
});

Route::get('edulevel', 'EdulevelController@data');
Route::get('edulevel/add', 'EdulevelController@add');
Route::post('edulevel', 'EdulevelController@addProses');
Route::get('edulevel/edit/{id}', 'EdulevelController@edit');
Route::patch('edulevel/{id}', 'EdulevelController@editProses');
Route::delete('edulevel/{id}', 'EdulevelController@delete');

Route::resource('programs', 'ProgramController');
