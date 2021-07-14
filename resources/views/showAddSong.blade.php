<div class="container-fluid bg-white">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group">
                <label for="search-song"><h4>@lang('playlist.enterSong')</h4></label>
                <input type="text" class="form-control" id="search-song" data-id="{{ $id }}" placeholder="{{ trans('playlist.enterSong') }}">
            </div>
        </div>
    </div>
    <table class="table table-striped songs-result">
        <thead>
            <tr>
                <th>@lang('playlist.songName')</th>
                <th>@lang('playlist.songSinger')</th>
                <th>@lang('playlist.action')</th>
            </tr>
        </thead>
        <tbody id="song-search">
            <tr>
                <td colspan="3">@lang('playlist.noResult')</td>
            </tr>
        </tbody>
    </table>
</div>
