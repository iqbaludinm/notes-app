@extends('layouts.app')
@section('content')
@section('title','Notes')



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
                            @foreach ($data as $no => $note )
                            <div class="col-lg-4">
                                <div class="card-box project-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle card-drop arrow-none" data-toggle="dropdown" aria-expanded="false">
                                            <span style="font-family: 'Courier New', Courier, monospace; font-style:unset;">{{$no+$data->firstItem()}}</span>
                                        </a>
                                    </div> <!-- end dropdown -->
                                    <!-- Title-->
                                    <h4 class="mt-0"><a href="project-detail.html" class="text-dark"> {{$note->title}} </a></h4>
                                    <p class="text-muted text-uppercase"><i class="mdi mdi-account-circle"></i> <small> {{$note->user->name}} </small></p>
                                    <div class="badge bg-soft-success text-success mb-3">{{$note->category->name}}</div>
                                    <!-- Desc-->
                                    <p class="text-muted font-13 mb-3 sp-line-2">
                                        {{$note->content}}
                                    </p>
                                    <!-- photo user-->
                                    <div class="avatar-group mb-3">
                                        <a href="javascript: void(0);" class="avatar-group-item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mat Helme">
                                            <img src="../assets/images/users/user-1.jpg" class="rounded-circle avatar-sm" alt="friend">
                                        </a>
                                    </div>
                                    <p class="text-muted text-uppercase"><i class="mdi mdi-calendar"></i> <small> {{$note->created_at}} </small></p>

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
