@extends('admin.layout.app')
@section('content')
   <div class="container-fluid">
      <!-- Page Heading -->
      <div class="row">
          <div class="col-lg-12">
              <h1 class="page-header">
                 @lang('home.manage')
              </h1>
              <ol class="breadcrumb">
                  <li class="">
                    <i class="fa fa-dashboard"></i> @lang('home.chart')
                  </li>
                  <li class="active">
                      <i class="fa fa-dashboard"></i> @lang('home.chartSong')
                  </li>
              </ol>
          </div>
      </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> @lang('home.list')
                       </h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('home.Namesong')</th>
                                    <th>@lang('home.category')</th>
                                    <th>@lang('home.listers')</th>
                                </tr>
                                </thead>
                                <tbody>
                                  @foreach($songViews as $song)
                                  <tr>
                                    <td>{{$loop->index + 1 }}</td>
                                    <td>{{$song->name}}</td>
                                    <td>{{$song->category->name}}</td>
                                    <td>{{$song->view}}</td>
                                  </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
            <div class="row">
              <form action="{{route('song-statistical')}}" method="get" id="form_song">
                <div class="col-md-4 mr-3">
                   <select class="custom-select custom-select-lg " name="time">
                      <option selected>@lang('home.choose')</option>
                      <option value="m">@lang('home.month')</option>
                      <option value="Q">@lang('home.quarter')</option>
                      <option value="Y">@lang('home.year')</option>
                    </select>
                </div>
              </form>
            </div>
              @include('admin.layout.songchart')
        </div>
@stop
