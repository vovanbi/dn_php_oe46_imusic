@if(\Session::has('success'))
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="Close" aria-hidden="true">&times;</a>
        <strong>@lang('adminhome.success')</strong> {{ \Session::get('success') }}
    </div>
@endif
@if(\Session::has('danger'))
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="Close" aria-hidden="true">&times;</a>
        <strong>@lang('adminhome.danger')</strong> {{ \Session::get('danger') }}
    </div>
@endif
