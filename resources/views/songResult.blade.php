@if (count($songs) > 0)
    @foreach ($songs as $song)
        <tr id="song-{{ $song->id }}">
            <td>{{ $song->name }}</td>
            <td>{{ $song->artist->name }}</td>
            <td>
                <button type="button" class="btn btn-danger add-playlist-song" data-playlist="{{ $playlistId }}" data-song="{{ $song->id }}">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> Add to playlist
                </button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="3">@lang('playlist.noResult')</td>
    </tr>
@endif
