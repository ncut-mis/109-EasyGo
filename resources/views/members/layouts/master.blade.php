<!DOCTYPE html>
<html  class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('page-title')</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ asset('css/admin-styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <!--Bootstrap Css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    @livewireStyles
</head>
<body>
<!-- Navigation-->
@include('members.layouts.shared.navbar')

<!-- Header-->
<!-- Page Content-->
@yield('content')

<!-- Footer-->
@include('members.layouts.shared.footer')

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{asset('js/scripts.js')}}"></script>

@livewireScripts

</body>
{{--<body class="sb-nav-fixed">--}}
{{--    @include('members.layouts.shared.navbar')--}}
{{--    <div id="layoutSidenav">--}}
{{--        @include('members.layouts.shared.sidenav')--}}
{{--        <div id="layoutSidenav_content">--}}
{{--            <main>--}}
{{--                @yield('page-content')--}}
{{--            </main>--}}
{{--            @include('members.layouts.shared.footer')--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>--}}
{{--    <script src="{{ asset('js/admin-scripts.js') }}"></script>--}}
{{--</body>--}}
</html>
