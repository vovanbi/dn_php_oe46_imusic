<form action="{{ isset($artist) ? route('artist.update',$artist->id) :route('artist.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
        @isset($artist)
            @method('PUT')
        @endisset
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="form-group">
                <label for="name"> @lang('artist.name'):</label>
                <input type="text" class="form-control" placeholder="@lang('artist.name')" value="{{ old('name',isset($artist->name) ? $artist->name : '')}}" name="name" >
                    @if($errors->has('name'))
                        <span class="error-text">
                            {{ $errors->first('name') }}
                        </span>
                    @endif
            </div>
            <div class="form-group">
                <div class="form-group">
                    <img id="out_img" src="{{ asset('image/unnamed.png') }}">
                </div>
                <label for="name"> @lang('artist.img') :</label>
                <input type="file" class="form-control" placeholder="" value="" name="avatar"  id="input_img">
            </div>
            <div class="form-group">
                <label for="name"> @lang('artist.info'):</label>
                <textarea class="form-control" id="a_content" cols="30" rows="3" placeholder="@lang('artist.desc')" name="info">{{ old('name',isset($artist->info) ? $artist->info : '')}}</textarea>
                    @if($errors->has('info'))
                        <span class="error-text">
                            {{ $errors->first('info') }}
                        </span>
                    @endif
            </div>
                <button type="submit" class="btn btn-success"> @lang('artist.submit')</button>
        </div>
    </div>
</form>

