@extends('layouts.app')
@section('content')
@section('title','Users')


<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active"><a href="#"></a> @yield('title')</li>
                            </ol>
                        </div>
                        <h4 class="page-title"><i class="mdi mdi-account-group mr-1"></i>@yield('title')</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card-box">
                        <br>
                        <div class="table-responsive">
                            @include('admin.users._list',[
                                     'data' => $data
                            ])
                        </div> <!-- end table-responsive-->
                    </div> <!-- end card-box -->
                    {{$data->links('vendor.pagination.bootstrap-4')}}
                </div> <!-- end col -->

            </div>

        </div> <!-- container -->

    </div> <!-- content -->


</div>
@stop
