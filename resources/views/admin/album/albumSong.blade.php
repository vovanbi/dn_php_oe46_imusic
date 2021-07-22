@extends('admin.layout.app')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ $album->name }}</h1>
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
                @lang('album.albAddSong')<a href="{{ route('getAddSong', ['album' => $album->id]) }}"><i class="fa fa-plus-circle"></i></a>
            </h3>
            <table id="dtBasicExample" class="table table-striped table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">@lang('album.stt')</th>
                        <th class="th-sm">@lang('album.albSong')</th>
                        <th class="th-sm">@lang('artist.name')</th>
                        <th class="th-sm">@lang('album.albAction')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($songs))
                        @foreach ($songs as $song)
                            <tr id="song-{{ $song->id }}">
                                <td>{{ loopNo($songs, $loop) }}</td>
                                <td>{{ $song->name }}</td>
                                <td>{{ $song->artist->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger del-album-song"
                                        data-song = "{{ $song->id }}" data-album= "{{ $album->id }}">
                                        <i class="fa fa-trash" aria-hidden="true"></i>  @lang('album.albDelete')
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $songs->links() }}
        </div>
        <!-- /.row -->
    </div>
@stop
