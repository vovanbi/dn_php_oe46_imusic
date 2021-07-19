<form action="{{ isset($album) ? route('albums.update', ['album' => $album->id]) : route('albums.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @if (isset($album))
        @method('put')    
    @endif
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            @if (count($errors) > 0) 
                <!-- Form Error List -->
                <div class="alert alert-danger">
                    <strong>{{ trans('album.errorAlert') }}</strong>

                    <br><br>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <div class="form-group">
            <label for="name">@lang('album.albName')</label>
            <input type="text" class="form-control" placeholder="{{ trans('album.albName') }}" value="{{ isset($album) ? $album->name : '' }}" name="name" >
        </div>
        <div class="form-group">
            <label for="name">@lang('album.image')</label>
            <input type="file" class="form-control" value="abc.jpg" name="image" id="input_img">
        </div>
        <div class="form-group">
            <img id="out_img" src="{{ asset('image/unnamed.png') }}">
        </div>
        <div>
            <button type="submit" class="btn btn-success"> @lang('album.saveBtn')</button>
        </div>
    </div>
</form>
