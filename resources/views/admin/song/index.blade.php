@extends('admin.layout.app')
@section('content')
  <div class="container-fluid">
      <!-- Page Heading -->
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">
                @lang('song.song')
              </h1>
              <ol class="breadcrumb">
                  <li class="">
                    <i class="fa fa-dashboard"></i> @lang('song.homePage')
                  </li>
                  <li class="active">
                      <i class="fa fa-dashboard"></i> @lang('song.song')
                  </li>
              </ol>
          </div>
      </div>
      <!-- /.row -->

      <div class="table-responsive">
          <h3>@lang('song.songManage')<a href="{{ route('songs.create') }}" ><i class="fa fa-plus-circle"></i></a> </h3>
          <table id="dtBasicExample" class="table table-striped table-sm" cellspacing="0" width="100%">
              <thead>
              <tr>
                <th class="th-sm">@lang('song.stt')</th>
                <th class="th-sm">@lang('song.songCate')</th>
                <th class="th-sm">@lang('song.songName')</th>
                <th class="th-sm">@lang('song.songArtist')</th>
                <th class="th-sm">@lang('song.image')</th>
                <th class="th-sm">@lang('song.songLink')</th>
                <th class="th-sm">@lang('song.songView')</th>
                <th class="th-sm">@lang('song.songHot')</th>
                <th colspan="2" class="th-sm">@lang('song.songAction')</th>
              </tr>
              </thead>
              <tbody>
                @if (isset($songs))
                  @foreach ($songs as $song)
                    <tr id="song-{{$song->id}}">
                        <td>{{ loopNo($songs, $loop) }}</td>
                        <td> {{ $song->category->name }} </td>
                        <td> {{ $song->name }} </td>
                        <td> {{ $song->artist->name }} </td>
                        <td> <img id="song-image" src="storage/{{ $song->image }}" alt=""> </td>
                        <td> {{ $song->link }} </td>
                        <td> {{ $song->view }} </td>
                        <td>
                          <a href="{{ route('songs.action',['hot',$song->id]) }}" class="btn {{$song->hot == 1 ? 'btn-danger' :'btn-success'}}">
                            {{ $song->hot == 1 ? 'hot' :  'not' }}
                          </a>
                        </td>
                        <td><a class="btn btn-info" href=" {{ route('songs.edit', ['song' => $song->id]) }} "><i class="fa fa-pencil" aria-hidden="true"></i>   @lang('song.songEdit')</a></td>
                        <td><button type="button" class="btn btn-danger del-song-btn" data-id="{{ $song->id }}"><i class="fa fa-trash" aria-hidden="true"></i>  @lang('song.songDelete')</button></td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
          </table>
          {{ $songs->links() }}
      </div>
      <!-- /.row -->
  </div>
  <!-- /.container-fluid -->

@stop
