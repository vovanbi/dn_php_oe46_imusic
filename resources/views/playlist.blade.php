@if(Auth::check())
    <div class="music">
        <div class="album">
            <h2>@lang('playlist.myPlaylist')</h2>
            <div class="row">
                @if(isset($playlists))
                    @foreach ($playlists as $playlist)
                        <a class="box_music" href="">
                            <img src="" alt="Playlist">
                            <h3>{{ $playlist->name }}</h3>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="artist">
            <h2>@lang('playlist.favoriteAlbum')</h2>
            <div class="row">
                @if(isset($albums))
                    @foreach ($albums as $album)
                        <a class="box_music" href="">
                            <img src="{{ $album->image }}" alt="Death Cab fot Cutie">
                            <h3>{{ $album->name }}</h3>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endif


