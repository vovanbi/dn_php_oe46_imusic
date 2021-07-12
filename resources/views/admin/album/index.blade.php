@extends('admin.layout.app')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@lang('album.album')</h1>
                <ol class="breadcrumb">
                    <li class="">
                        <i class="fa fa-dashboard"></i> @lang('album.homePage')
                    </li>
                    <li class="active">
                        <i class="fa fa-dashboard"></i> @lang('album.album')
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <div class="table-responsive">
            <h3>
                @lang('album.albManage')<a href="{{ route('albums.create') }}"><i class="fa fa-plus-circle"></i></a>
            </h3>
            <table id="dtBasicExample" class="table table-striped table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">@lang('album.stt')</th>
                        <th class="th-sm">@lang('album.albName')</th>
                        <th class="th-sm">@lang('album.albSongManage')</th>
                        <th class="th-sm">@lang('album.image')</th>
                        <th class="th-sm">@lang('album.albSongManage')</th>
                        <th class="th-sm">@lang('album.albHot')</th>
                        <th colspan="2" class="th-sm">@lang('album.albAction')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($albums))
                        @foreach ($albums as $album)
                            <tr id="album-{{ $album->id }}">
                                <td>{{ loopNo($albums, $loop) }}</td>
                                <td>{{ $album->name }}</td>
                                <td><a href="{{ route('albumSong', ['album' => $album->id]) }}">@lang('album.albSongManage')</a></td>
                                <td>
                                    <img id="album-image" src="storage/{{ $album->image }}" alt="" />
                                </td>
                                <td>
                                <a href="{{ route('albums.action',['hot',$album->id]) }}" class="btn {{$album->hot == 1 ? 'btn-danger' :'btn-success'}}">
                                {{ $album->hot == 1 ? 'hot' :  'not' }}
                                </a>
                                </td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('getAddSong', ['album' => $album->id]) }}">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i>  @lang('album.albAddSong')
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('albums.edit', ['album' => $album->id]) }}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>  @lang('album.albEdit')
                                    </a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger del-album-btn"
                                        data-id="{{ $album->id }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>  @lang('album.albDelete')
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $albums->links() }}
        </div>
        <!-- /.row -->
    </div>
@stop
