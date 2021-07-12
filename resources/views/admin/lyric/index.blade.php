@extends('admin.layout.app')
@section('content')
  <div class="container-fluid">
      <!-- Page Heading -->
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">
                   @lang('lyric.lyric')
              </h1>
              <ol class="breadcrumb">
                  <li class="">
                    <i class="fa fa-dashboard"></i> @lang('lyric.home')
                  </li>
                  <li class="active">
                      <i class="fa fa-dashboard"></i> @lang('lyric.lyric')
                  </li>
              </ol>
          </div>
      </div>
      <!-- /.row -->

      <div class="table-responsive">
          <h3>@lang('lyric.manage')  <a href="{{route('lyric.create')}}" ><i class="fa fa-plus-circle"></i></a> </h3>
          <table id="dtBasicExample" class="table table-striped table-sm" cellspacing="0" width="100%">
              <thead>
              <tr>
                <th class="th-sm">Stt

                </th>
                <th class="th-sm">@lang('lyric.name')
                </th>
                <th class="th-sm">@lang('lyric.lyric')</th>
                <th class="th-sm">@lang('lyric.status')</th>
                <th class="th-sm">@lang('lyric.user')

                </th>
                <th class="th-sm">@lang('lyric.action')

                </th>
              </tr>
              </thead>
              <tbody>
                @if(isset($artists))
                    @foreach($artists as $artist)
                      <tr id="artist-{{ $artist->id }}">
                          <td>{{$loop->index+1}}</td>
                          <td>{{$artist->name}}</td>
                          <td><img src="/storage/{{$artist->avatar}}" alt="" class="img_artist"></td>
                          <td>
                            <a class="btn btn-info btn-info-artist" href="{{ route('artist.edit', $artist->id) }}"><i class="fa fa-pencil"></i> @lang('artist.edit')</a>
                            <a class="btn btn-danger btn-delete-artist" data-id="{{$artist->id}}" ><i class="fa fa-trash"></i> @lang('delete')</a>
                          </td>
                      </tr>
                    @endforeach
                @endif

              </tbody>
          </table>
      </div>
  </div>
@stop
