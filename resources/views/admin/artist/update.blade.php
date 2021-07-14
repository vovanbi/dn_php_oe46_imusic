@extends('admin.layout.app')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        @lang('artist.singer')
                    </h1>
                    <ol class="breadcrumb">
                        <li class="">
                            <i class="fa fa-dashboard"></i> @lang('artist.home')
                        </li>
                        <li class="">
                            <i class="fa fa-dashboard"></i> @lang('artist.singer')
                        </li>
                        <li class="active">
                            <i class="fa fa-dashboard"></i> @lang('artist.update')
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.artist.form')
                </div>
            </div>
        </div>
    </div>

@stop
