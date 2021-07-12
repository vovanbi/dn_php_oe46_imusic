@extends('admin.layout.app')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        @lang('album.album')
                    </h1>
                    <ol class="breadcrumb">
                        <li class="">
                            <i class="fa fa-dashboard"></i> @lang('album.homePage')
                        </li>
                        <li class="">
                            <i class="fa fa-dashboard"></i> <a href="{{ route('albums.index') }}">@lang('album.album')</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-dashboard"></i> @lang('album.update')
                        </li>
                    </ol>   
                </div>
            </div>  
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.album.form')
                </div>
            </div>
        </div>
    </div>
@stop
