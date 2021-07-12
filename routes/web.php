<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [App\Http\Controllers\Admin\HomeController::class, 'index']);

Route::get('change-language/{language}', [App\Http\Controllers\HomeController::class,
    'changeLanguage'])->name('change-language');


Route::group(['prefix' => 'admin'], function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('artist', App\Http\Controllers\Admin\ArtistController::class)->except('show', 'detroy');
    Route::resource('user', App\Http\Controllers\Admin\UserController::class)->except('show');
    Route::resource('albums', AlbumController::class);
});
