<form action="{{ isset($user) ? route('user.update',$user->id) :route('user.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
        @isset($user)
            @method('PUT')
        @endisset
    <div class="row">
        <div class="col-sm-7">
            <div class="form-group">
                <label for="fullname"> @lang('user.name'):</label>
                <input type="text" class="form-control" placeholder="@lang('user.name')" value="{{ old('fullname',isset($user->fullname) ? $user->fullname : '') }}" name="fullname" >
                @if($errors->has('fullname'))
                    <span class="text-danger">
                        {{ $errors->first('fullname') }}
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="name"> @lang('user.email'):</label>
                <input type="text" class="form-control" placeholder="@lang('user.email')" value="{{ old('email',isset($user->email) ? $user->email : '') }}" name="email" >
                @if($errors->has('email'))
                    <span class="text-danger">
                        {{ $errors->first('email') }}
                    </span>
                @endif
            </div>
             <div class="form-group">
                <label for="password"> @lang('user.password'):</label>
                <input type="password" class="form-control" placeholder="@lang('user.password')" value="{{ old('password',isset($user->password) ? $user->password : '') }}" name="password" >
                @if($errors->has('password'))
                    <span class="text-danger">
                        {{ $errors->first('password') }}
                    </span>
                @endif
            </div>
              <div class="form-group">
                <label for="phone"> @lang('user.phone'):</label>
                <input type="number" class="form-control" placeholder="Phone" value="{{ old('phone',isset($user->phone) ? $user->phone : '') }}" name="phone" >
                @if($errors->has('phone'))
                    <span class="text-danger">
                        {{ $errors->first('phone') }}
                    </span>
                @endif
            </div>

        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="name"> @lang('user.user'):</label>
                <select  id="" class="form-control" required="" name="is_admin">
                    <option >--Chọn user-</option>
                    <option value="1" {{ old('is_admin',isset($user->is_admin) ? $user->is_admin : '') == '1' ?  "selected='selected'" : "" }}>--Admin-</option>
                    <option value="0" {{ old('is_admin',isset($user->is_admin) ? $user->is_admin : '') == '0' ?  "selected='selected'" : "" }}>--User-</option>
                </select>
                 @if($errors->has('is_admin'))
                    <span class="text-danger">
                        {{ $errors->first('is_admin)') }}
                    </span>
                @endif
            </div>
            <div class="form-group">
                <img id="out_img" src="{{ asset('image/unnamed.png') }}">
            </div>
            <div class="form-group">
                <label for="name"> @lang('user.img'):</label>
                <input type="file" id="input_img" name="avatar" class="form-control" multiple value="{{ old('avatar',isset($user->avatar) ? $user->avatar : '') }}">
                 @if($errors->has('avatar'))
                    <span class="text-danger">
                        {{ $errors->first('avatar)') }}
                    </span>
                @endif
            </div>
              <button type="submit" class="btn btn-success"> @lang('artist.submit')</button>
        </div>
    </div>
</form>

