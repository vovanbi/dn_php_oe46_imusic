@extends('admin.layout.app')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        @lang('lyric.lyric')
                    </h1>
                    <ol class="breadcrumb">
                        <li class="">
                            <i class="fa fa-dashboard"></i> @lang('user.home')
                        </li>
                        <li class="">
                            <i class="fa fa-dashboard"></i> @lang('lyric.lyric')
                        </li>
                        <li class="active">
                            <i class="fa fa-dashboard"></i> @lang('user.add')
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.lyric.form')
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
@stop
