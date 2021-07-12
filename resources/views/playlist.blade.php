@if(Auth::check())
    <div class="music">
        <div class="album">
            <h2>@lang('playlist.myPlaylist')</h2>
            <div class="row">
                @if(isset($playlists))
                    @foreach ($playlists as $playlist)
                        <div class="playlist-box" id="playlist-{{ $playlist->id }}">
                            <span class="del-playlist" data-id="{{ $playlist->id }}"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                            <a class="box_music play-playlist" data-id="{{ $playlist->id }}" href="">
                                <img src="" alt="Playlist">
                                <h3>{{ $playlist->name }}</h3>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="artist">
            <h2>@lang('playlist.favoriteAlbum')</h2>
            <div class="row">
                @if(isset($albums))
                    @foreach ($albums as $album)
                        <div class="playlist-box" id="playlist-{{ $album->id }}">
                            <span class="del-favAlbum" data-id="{{ $album->id }}"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                            <a class="box_music play-favAlbum" data-id="{{ $album->id }}" href="">
                                <img src="{{ $album->image }}" alt="Death Cab fot Cutie">
                                <h3>{{ $album->name }}</h3>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endif


