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
                            <i class="fa fa-dashboard"></i> @lang('category.category')
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
                    @include('')
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>

@stop
