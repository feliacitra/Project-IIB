<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon Tags Start -->
    <link rel="shortcut icon" href="{{ asset('back/images/logo/favicon.ico') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="180x180" href="{{ asset('back/images/logo/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('back/images/logo/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ asset('back/images/logo/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('back/images/logo/android-chrome-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('back/images/logo/android-chrome-512x512.png') }}">
    <!-- Favicon Tags End -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('back/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('back/vendors/flatpickr/flatpickr.min.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('back/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('back/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('back/css/main/style.css') }}">
    <!-- End layout styles -->
</head>
<body>
<div class="main-wrapper">

    @if ( auth()->check() )
        @include('layouts.back.sidebar')
    @endif

    <div class="page-wrapper @if ( !auth()->check() ) full-page @endif">

        @if ( auth()->check() )
            @include('layouts.back.navbar')
        @endif

        <div class="page-content @if ( !auth()->check() ) d-flex align-items-center justify-content-center @endif">
            @yield('content')
        </div>

         @if ( auth()->check() )
            @include('layouts.back.footer')
         @endif


    </div>
</div>

<!-- core:js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#logout-btn').click(function() {
            event.preventDefault(); // Prevent default click behavior

            // Find the logout form and submit it
            $('#logout-form').submit();
        });
    });
</script>
<script src="{{ asset('back/vendors/core/core.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="{{ asset('back/vendors/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('back/vendors/apexcharts/apexcharts.min.js') }}"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{ asset('back/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('back/js/template.js') }}"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="{{ asset('back/js/dashboard-light.js') }}"></script>
<!-- End custom js for this page -->



</body>
</html>
