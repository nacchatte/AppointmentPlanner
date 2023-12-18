<!DOCTYPE html>
<html lang="en">

<head>
    @include('Backend.Layout.common-head')
</head>

<body >
    {{-- class="g-sidenav-show  bg-gray-200" in body tag--}}
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        @include('Backend.Layout.header')
        @include('Backend.Layout.sidebar')

        <div class="page-wrapper">
            @section('main-content')
            @show
            @include('Backend.Layout.footer')
        </div>
    </div>

    @include('Backend.Layout.common-end')
    @stack('custom-scripts')
</body>

</html>
