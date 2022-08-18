<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title> @yield('title') </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="Internship Report" />
        <meta content="Internship Report" name="Johan.Nasendi" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('/assets/images/logo.png')}}">

		<!-- App css -->
		<link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
		<link href="{{asset('/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

		<link href="{{asset('/assets/css/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
		<link href="{{asset('/assets/css/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

		<!-- icons -->
		<link href="{{asset('/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

<body class="loading authentication-bg authentication-bg-pattern">

        @yield('content')

    <footer class="footer footer-alt">
        <script>document.write(new Date().getFullYear())</script> &copy; Internship Report theme by <a href="https://www.instagram.com/johan.nasendi/"  target="_blank" class="text-white-50">J.N</a>
    </footer>


    <!-- Vendor js -->
    <script src="{{asset('/assets/js/vendor.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('/assets/js/app.min.js')}}"></script>
    @include('sweetalert::alert')

</body>
</html>
