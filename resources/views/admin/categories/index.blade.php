@extends('layouts.app')
@section('content')
@section('title','Categories')



             <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <div class="content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                                            <li class="breadcrumb-item active">@yield('title')</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"> <i data-feather="clipboard"></i> @yield('title')</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            @foreach ($data as $no => $category )
                            <div class="col-lg-4">
                                <div class="card-box project-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle card-drop arrow-none" data-toggle="dropdown" aria-expanded="false">
                                            <span style="font-family: 'Courier New', Courier, monospace; font-style:unset;">{{$no+$data->firstItem()}}</span>
                                        </a>
                                    </div> <!-- end dropdown -->
                                    <!-- Title-->
                                    <h4 class="mt-0"><a href="project-detail.html" class="text-dark"> {{$category->name}} </a></h4>
                                    <p class="text-muted text-uppercase"><i class="mdi mdi-account-circle"></i> <small> {{$category->user->name}} </small></p>
                                    <p class="text-muted text-uppercase"><i class="mdi mdi-calendar"></i> <small> {{$category->created_at}} </small></p>

                                </div> <!-- end card box-->
                            </div>
                            <!-- end col-->
                            @endforeach

                        </div>
                        <!-- end row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="text-center mb-3">
                                    {{$data->links('vendor.pagination.bootstrap-4')}}
                                </div>
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->

                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


@stop
