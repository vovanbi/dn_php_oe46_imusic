@extends('admin.layout.app')
@section('content')
  <div class="container-fluid">
      <!-- Page Heading -->
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">
                   @lang('user.user')
              </h1>
              <ol class="breadcrumb">
                  <li class="">
                    <i class="fa fa-dashboard"></i> @lang('user.home')
                  </li>
                  <li class="active">
                      <i class="fa fa-dashboard"></i> @lang('user.user')
                  </li>
              </ol>
          </div>
      </div>
      <!-- /.row -->

      <div class="table-responsive">
          <h3>@lang('user.manage')  <a href="{{route('user.create')}}" ><i class="fa fa-plus-circle"></i></a> </h3>
          <table id="dtBasicExample" class="table table-striped table-sm" cellspacing="0" width="100%">
              <thead>
              <tr>
                <th class="th-sm">Stt

                </th>
                <th class="th-sm">@lang('user.name')
                <th class="th-sm">Email</th>

                </th>
                <th class="th-sm"> @lang('user.type')</th>
                <th class="th-sm">@lang('user.img')

                </th>
                <th class="th-sm">@lang('user.action')

                </th>
              </tr>
              </thead>
              <tbody>
                @if(isset($users))
                    @foreach($users as $user)
                  <tr id="user-{{ $user->id }}">
                      <td>{{$loop->index + 1}}</td>
                      <td>{{$user->fullname}}</td>
                      <td>{{$user->email}}</td>
                      <td>
                        <button type="button" class="btn {{ $user->is_admin==1 ? 'btn-warning' : 'btn-success' }}">
                           {{ $user->is_admin==1 ? 'Admin' : 'User' }}
                        </button>
                      </td>
                      <td><img src="/storage/{{$user->avatar}}" alt="" class="img_artist"></td>
                      <td>
                        <a class="btn btn-info btn-info-user" href="{{ route('user.edit', $user->id) }}"><i class="fa fa-pencil"></i> @lang('artist.edit')</a>
                        <a class="btn btn-danger btn-delete-user" data-id="{{$user->id}}" ><i class="fa fa-trash"></i> @lang('delete')</a>
                      </td>
                  </tr>
                    @endforeach
                @endif

              </tbody>
          </table>
          {{$users->links()}}
      </div>
  </div>
@stop
