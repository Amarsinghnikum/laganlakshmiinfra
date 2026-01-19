<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Laravel Role Admin')</title>
    <link rel="icon" href="{{ url('img/favicon/favicon.png') }}" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('backend.layouts.partials.styles')
    <style>
    /* .sidebar {
        width: 250px;
        background-color: #1c1c1c;
        color: white;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        transition: left 0.3s;
        overflow-y: auto;
    } */
    </style>
    @stack('styles')
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>

    <div id="page-content" class="flex-grow-1">
        <div class="page-container">
            @include('backend.layouts.partials.sidebar')

            <div class="main-content">
                @include('backend.layouts.partials.header')
                @yield('admin-content')
            </div>

            @include('backend.layouts.partials.footer')
        </div>
    </div>

    @include('backend.layouts.partials.offsets')
    @include('backend.layouts.partials.scripts')
   
    @stack('scripts')
</body>

</html>