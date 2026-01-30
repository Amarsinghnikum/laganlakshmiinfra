@extends('backend.layouts.admin')

@section('title')
Dashboard Page - Admin Panel
@endsection

@push('styles')
<!-- Start datatable css -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
<link rel="stylesheet" href="{{url('backend/assets/css/dashboard.css')}}">
@endpush

@section('admin-content')
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">{{ __('Dashboard') }}</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li><span>{{ __('Overview') }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            @include('backend.layouts.partials.logout')
        </div>
    </div>
</div>

<!-- main content -->
<div class="main-content-inner">

    <!-- Metrics -->
    <div class="row">
        <!-- Total Users -->
        <div class="col-md-3 col-sm-6 mt-4">
            <div class="card text-white bg-primary shadow text-center">
                <div class="card-body d-flex flex-column justify-content-center align-items-center"
                    style="height: 150px;">
                    <h5 class="card-title mb-2 text-white">Total Users</h5>
                    <h3 class="mb-0 text-white">{{ $totalUsers ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="col-md-3 col-sm-6 mt-4">
            <div class="card text-white bg-success shadow text-center">
                <div class="card-body d-flex flex-column justify-content-center align-items-center"
                    style="height: 150px;">
                    <h5 class="card-title mb-2 text-white">Total Orders</h5>
                    <h3 class="mb-0 text-white">{{ $totalOrders ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="col-md-3 col-sm-6 mt-4">
            <div class="card text-white bg-warning shadow text-center">
                <div class="card-body d-flex flex-column justify-content-center align-items-center"
                    style="height: 150px;">
                    <h5 class="card-title mb-2 text-white">Total Revenue</h5>
                    <h3 class="mb-0 text-white">${{ number_format($totalRevenue ?? 0, 2) }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="col-md-3 col-sm-6 mt-4">
            <div class="card text-white bg-danger shadow text-center">
                <div class="card-body d-flex flex-column justify-content-center align-items-center"
                    style="height: 150px;">
                    <h5 class="card-title mb-2 text-white">Total Products</h5>
                    <h3 class="mb-0 text-white">{{ $totalProducts ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('scripts')
    <!-- Start datatable js -->
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @endpush