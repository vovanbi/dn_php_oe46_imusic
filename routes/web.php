<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [App\Http\Controllers\Admin\HomeController::class, 'index']);

Route::get('change-language/{language}', [App\Http\Controllers\HomeController::class,
    'changeLanguage'])->name('change-language');

Route::group(['prefix => admin'], function () {
    Route::resource('artist', App\Http\Controllers\Admin\ArtistController::class)->except('show', 'detroy');
});
