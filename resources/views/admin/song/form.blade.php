<form action="{{ isset($song) ? route('songs.update', ['song' => $song->id]) : route('songs.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @if (isset($song))
        @method('put')    
    @endif
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            @if (count($errors) > 0) 
                <!-- Form Error List -->
                <div class="alert alert-danger">
                    <strong>{{ trans('song.errorAlert') }}</strong>

                    <br><br>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <div class="form-group">
            <label for="exampleFormControlSelect1">@lang('song.songCate')</label>
            <select class="form-control" name="cate_id">
                @if (isset($song))
                    <option value="{{ $song->category->id }}">{{ $song->category->name }}</option>
                @else 
                    <option value="0">@lang('song.cateSelect')</option>
                @endif
                @if (isset($categories))
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}" >{{ $cate->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="name">@lang('song.songName')</label>
            <input type="text" class="form-control" placeholder="{{ trans('song.songName') }}" value="{{ isset($song) ? $song->name : '' }}" name="name" >
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">@lang('song.songArtist')</label>
            <select class="form-control" name="art_id">
                @if (isset($song))
                    <option value="{{ $song->artist->id }}">{{ $song->artist->name }}</option>
                @else 
                    <option value="0">@lang('song.artSelect')</option>
                @endif
                @if (isset($artists))
                    @foreach ($artists as $art)
                        <option value="{{ $art->id }}" >{{ $art->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="name">@lang('song.songLink')</label>
            <input type="text" class="form-control" value="{{ isset($song) ? $song->link : '' }}" name="link" >
        </div>
        <div class="form-group">
            <label for="name">@lang('song.image')</label>
            <input type="file" class="form-control" value="" name="image" >
        </div>
        <div class="form-group">
            <img id="out_img" src="{{ asset('image/unnamed.png') }}">
        </div>
        <div>
            <button type="submit" class="btn btn-success"> @lang('song.saveBtn')</button>
        </div>
    </div>
</form>
