<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongListController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\PageDetailController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\LyricController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('change-language/{language}', [App\Http\Controllers\HomeController::class,
    'changeLanguage'])->name('change-language');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::resource('categories', CategoryController::class);
    Route::resource('albums', AlbumController::class);
    Route::resource('songs', SongController::class);

    Route::resource('user', App\Http\Controllers\Admin\UserController::class)->except('show');
    Route::resource('lyric', App\Http\Controllers\Admin\LyricController::class)->except('show');
    Route::get('lyric/{action}/{id}', [LyricController::class, 'action'])->name('lyric.action');
    Route::resource('artist', App\Http\Controllers\Admin\ArtistController::class)->except('show');
});
Route::get('/', [App\Http\Controllers\HomeController::class,'index'])->name('home');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'getRegister'])->name('get.register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'postRegister'])->name('post.register');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'getLogin'])->name('get.login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'postLogin'])->name('post.login');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/get-song-by-category/{id}', [App\Http\Controllers\HomeController::class, 'getSong']);

Route::get('/show-category', [App\Http\Controllers\HomeController::class, 'renderHome']);

Route::get('album-detail/{album}', [PageDetailController::class, 'showAlbum'])->name('showAlbum');
Route::get('artist-detail/{artist}', [PageDetailController::class, 'showArtist'])->name('showArtist');

Route::get('/{id}', [App\Http\Controllers\HomeController::class, 'songPlaying']);

Route::get('/detail-song/{id}', [App\Http\Controllers\SongController::class, 'detailSong'])
->name('detail-song')-> middleware('auth');
Route::post('/song-comment', [App\Http\Controllers\SongController::class, 'storeComent']);
