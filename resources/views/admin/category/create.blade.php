@extends('admin.layout.app')

@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        @lang('category.category')
                    </h1>
                    <ol class="breadcrumb">
                        <li class="">
                            <i class="fa fa-dashboard"></i> @lang('category.homePage')
                        </li>
                        <li class="">
                            <i class="fa fa-dashboard"></i> <a href="{{ route('categories.index') }}">@lang('category.category')</a>
                        </li>
                        <li class="active">
                            <i class="fa fa-dashboard"></i> @lang('category.addNew')
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    @include('admin.category.form')
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

@stop
