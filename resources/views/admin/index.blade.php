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

      </div>
  </div>
@stop
