@extends('layouts.app')
@section('content')
@section('title','Profile Details')


            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

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
                                            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
                                            <li class="breadcrumb-item active">@yield('title')</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><i class="mdi mdi-account-circle mr-1"></i>@yield('title')</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card-box text-center">
                                    <img src="{{asset('/assets/images/users/user-3.jpg')}}" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image">
                                    <h4 class="mb-0">  {{$user->name}} </h4>
                                    <p class="text-muted">
                                        {{$user->email}}
                                    </p>
                                </div> <!-- end card-box -->
                            </div> <!-- end col-->

                            <div class="col-lg-8 col-xl-8">
                                <div class="card-box">
                                    <ul class="nav nav-pills navtab-bg nav-justified">
                                        <li class="nav-item">
                                            <a href="#settings" data-toggle="tab" aria-expanded="true"  class="nav-link active">
                                                Info
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#timeline" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Change Password
                                            </a>
                                        </li>

                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="timeline">

                                            <form action="#" method="POST">
                                                @csrf
                                                <h5 class="mb-4 text-uppercase"><i class=" fas fa-lock"></i>
                                                    Change Password
                                                </h5>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group {{ $errors->has('current-password') ? ' has-error' : '' }}">
                                                            <label for="userpassword">Old Password</label>
                                                            <div class="input-group input-group-merge">
                                                                <input id="password" type="password" class="form-control"
                                                                placeholder="Old Password" name="current-password" required="">
                                                                @if ($errors->has('current-password'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('current-password') }}</strong>
                                                                </span>
                                                                @endif
                                                                <div class="input-group-append" data-password="false">
                                                                    <div class="input-group-text">
                                                                        <span class="password-eye"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-md-12">
                                                        <div class="form-group {{ $errors->has('new-password') ? ' has-error' : '' }}">
                                                            <label for="lastname">New password</label>
                                                            <div class="input-group input-group-merge">
                                                                <input id="password" type="password" class="form-control"
                                                                placeholder="New password" name="new-password" required="">
                                                                @if ($errors->has('new-password'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('new-password') }}</strong>
                                                                </span>
                                                                @endif
                                                                <div class="input-group-append" data-password="false">
                                                                    <div class="input-group-text">
                                                                        <span class="password-eye"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="lastname">Confirm New Password</label>
                                                            <div class="input-group input-group-merge">
                                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                                                placeholder="confirm new password" name="new-password_confirmation" required="">
                                                                <div class="input-group-append" data-password="false">
                                                                    <div class="input-group-text">
                                                                        <span class="password-eye"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->

                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-warning waves-effect waves-light" disabled>
                                                        <i class="mdi mdi-content-save"></i> Ubah</button>
                                                </div>

                                            </form>

                                        </div>
                                        <!-- end timeline content-->

                                        <div class="tab-pane show active" id="settings">
                                            <form>
                                                <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle mr-1"></i> Info Profile</h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="firstname">Full Name</label>
                                                            <input type="text" class="form-control" name="name"
                                                            value="{{old('name',$user->name)}}"  readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="lastname">E-Mail</label>
                                                            <input type="email" class="form-control" name="email"
                                                            value="{{old('email',$user->email)}}"  readonly>
                                                        </div>
                                                    </div> <!-- end col -->
                                                </div> <!-- end row -->

                                                <div class="text-right">
                                                    <a href="#" class="btn btn-warning waves-effect waves-light mt-2" >
                                                        <i class="mdi mdi-content-save"></i> Edit
                                                    </a>
                                                </div>

                                            </form>
                                        </div>
                                        <!-- end settings content-->

                                    </div> <!-- end tab-content -->
                                </div> <!-- end card-box-->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->

                </div> <!-- content -->


            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

@stop
