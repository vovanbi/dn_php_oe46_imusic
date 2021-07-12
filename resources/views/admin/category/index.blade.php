@extends('admin.layout.app')
@section('content')
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
                  <li class="active">
                      <i class="fa fa-dashboard"></i> @lang('category.category')
                  </li>
              </ol>
          </div>
      </div>
      <!-- /.row -->

      <div class="table-responsive">
          <h3>Q@lang('category.cateManage') <a href="" ><i class="fa fa-plus-circle"></i></a> </h3>
          <table id="dtBasicExample" class="table table-striped table-sm" cellspacing="0" width="100%">
              <thead>
              <tr>
                <th class="th-sm">@lang('category.stt')

                </th>
                <th class="th-sm">@lang('category.cateName')

                </th>
                <th class="th-sm">@lang('category.cateParent')

                </th>
                <th class="th-sm">@lang('category.cateAction')

                </th>
              </tr>
              </thead>
              <tbody>

                  <tr>
                      <td></td>
                      <td></td>
                      <td>

                      </td>
                      <td>

                      </td>
                  </tr>

              </tbody>
          </table>
      </div>
      <!-- /.row -->
  </div>
  <!-- /.container-fluid -->

@stop
