@extends('admin.layout.app')

@section('content')
    <div id="page-wrapper">
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
                        <li class="">
                            <i class="fa fa-dashboard"></i> <a href="{{ route('songs.index') }}">@lang('song.song')</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-dashboard"></i> @lang('song.addNew')
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.song.form')
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

@stop
