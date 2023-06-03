<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">


<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Bulk Customer" name="description" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

    @include('admin.includes.styles')

</head>

<body>

<!-- Begin page -->
<div id="layout-wrapper">


    @include('admin.includes.header')

    @include('admin.includes.sidebar')
    <!-- Vertical Overlay-->
    <div class="vertical-overlay"></div>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">


                @yield('content')

            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->



        @include('admin.includes.footer')

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->



<!--start back-to-top-->
<button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->


@include('admin.includes.scripts')
@yield('custom-scripts')
</body>
</html>
