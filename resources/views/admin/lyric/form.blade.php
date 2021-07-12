<form action="{{ isset($lyric) ? route('lyric.update',$lyric->id) :route('lyric.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
        @isset($user)
            @method('PUT')
        @endisset
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
             <div class="form-group">
                <label for="name"> @lang('lyric.lyricname'):</label>
                <select  id="" class="form-control" required="" name="song_id">
                    <option >--@lang('lyric.select')-</option>
                    <option value="1" >--Bai hat 1-</option>
                    <option value="2" >--Bai hat 2-</option>
                </select>
                 @if($errors->has('is_admin'))
                    <span class="text-danger">
                        {{ $errors->first('is_admin)') }}
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="lyric"> @lang('lyric.content') :</label><br>
                <textarea name="content" id="content" placeholder="Loi bai hat" rows="3" cols="81"></textarea>
            </div>
              <button type="submit" class="btn btn-success"> @lang('artist.submit')</button>
        </div>
    </div>
</form>

