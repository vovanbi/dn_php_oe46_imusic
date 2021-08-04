<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Category\ICategoryRepository::class,
            \App\Repositories\Category\CategoryRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Song\ISongRepository::class,
            \App\Repositories\Song\SongRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Lyric\ILyricRepository::class,
            \App\Repositories\Lyric\LyricRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Playlist\IPlaylistRepository::class,
            \App\Repositories\Playlist\PlaylistRepository::class
        );

        $this->app->singleton(
            \App\Repositories\User\IUserRepository::class,
            \App\Repositories\User\UserRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Album\IAlbumRepository::class,
            \App\Repositories\Album\AlbumRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Artist\IArtistRepository::class,
            \App\Repositories\Artist\ArtistRepository::class
        );

        $this->app->singleton(
            \App\Repositories\Comment\ICommentRepository::class,
            \App\Repositories\Comment\CommentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
