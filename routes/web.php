<?php

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

Auth::routes();

Route::put('/themes', function(Request $request) {
    $request->validate([
       'theme' => ['required', Rule::in(['darkly', 'cerulean'])]
    ]);
 
    session(['theme' => $request->theme]);
    return back();
 });

Route::get('home', 'HomeController@home')->name('home');

Route::get('/ris', 'HomeController@reizigersinformatie')->name('ris');
Route::get('/ris/board-setup', 'SplitflapController@board_setup')->name('ris/board-setup');
Route::get('/ris/board-info', 'SplitflapController@board_info')->name('ris/board-info');
Route::post('/ris/splitflap', 'SplitflapController@store');
Route::post('/ris/preview', 'SplitflapController@preview');

Route::get('/map', 'MapController@trainmap')->name('map');

Route::view('/files', 'files');