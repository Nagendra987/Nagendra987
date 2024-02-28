<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>18Pixel Pvt Ltd</title>
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="container-scroller">
        @include('layouts.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.sidebar')
            <!-- partial -->
            <div class="main-panel">
                @yield('content')
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">

                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © {{
                            date('Y') }}. All
                            rights reserved.</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <script src="{{ asset('vendors/js/vendor.bundle.base.js')}}"></script>
</body>

</html>