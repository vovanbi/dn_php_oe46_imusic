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
            <h3>@lang('category.cateManage')<a href="{{ route('categories.create') }}"><i
                        class="fa fa-plus-circle"></i></a> </h3>
            <table id="dtBasicExample" class="table table-striped table-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="th-sm">@lang('category.stt')</th>
                        <th class="th-sm">@lang('category.cateName')</th>
                        <th class="th-sm">@lang('category.cateParent')</th>
                        <th colspan="2" class="th-sm">@lang('category.cateAction')</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($categories))
                        <?php $no = 1; ?>
                        @foreach ($categories as $cate)
                            <tr id="category-{{ $cate->id }}">
                                <td>{{ $no++ }}</td>
                                <td>{{ $cate->name }}</td>
                                <td><button type="button"
                                        class="btn {{ $cate->parent_id ? 'btn-danger' : 'btn-success' }}">{{ $cate->parent_id ? trans('category.cateChild') : trans('category.cateParent') }}</button>
                                </td>
                                <td><a class="btn btn-primary"
                                        href="{{ route('categories.edit', ['category' => $cate->id]) }}"><i
                                            class="fa fa-pencil" aria-hidden="true"></i>@lang('category.cateEdit')</a></td>
                                <td><button type="button" class="btn btn-danger del-cate-btn"
                                        data-id="{{ $cate->id }}"><i class="fa fa-trash" aria-hidden="true"></i>
                                        @lang('category.cateDelete')</button></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->

@stop
