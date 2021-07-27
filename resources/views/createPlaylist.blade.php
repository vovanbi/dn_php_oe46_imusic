<div class="row bg-white justify-content-center">
    <div class="col-md-6">
        <form id="create-playlist" method="post">
            <h1><strong>@lang('playlist.createPlaylist')</strong></h1>
            <div class="form-group">
                <label for="email">Playlist Name</label>
                <input type="text" name="name" class="form-control" placeholder="{{ trans('playlist.enterPlaylistName') }}" id="playlist-name">
            </div>
            <button class="btn btn-primary">@lang('playlist.createPlaylist')</button>
        </form>
    </div>
</div>
