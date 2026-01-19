@extends('backend.layouts.master')

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


    <!-- Quick Links -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="mb-3">Quick Links</h5>
                    <div class="btn-group d-flex flex-wrap gap-2 mb-5" role="group">
                        <a href="#" class="btn btn-outline-primary active" id="adminTabBtn">Manage Admins</a>
                        <a href="#" class="btn btn-outline-success" id="visitorTabBtn">Visitor Logs</a>
                        <a href="#" class="btn btn-outline-warning flex-fill">System Settings</a>
                        <a href="#" class="btn btn-outline-info flex-fill">Support</a>
                    </div>
                     <!-- TAB CONTENTS -->
                    <div class="tab-content" id="logTabsContent">

                        <!-- TAB 1 → Admin Logs -->
                        <div class="tab-pane fade show active" id="adminLogs">
                            <h5 class="mb-3">Recent Admin Logins</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Admin Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Login Time</th>
                                            <th>IP Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentLogins as $index => $login)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $login['name'] }}</td>
                                            <td>{{ $login['email'] }}</td>
                                            <td>{{ $login['role'] ?? 'Admin' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($login['login_time'])->format('Y-m-d h:i A') }}</td>
                                            <td>{{ $login['ip_address'] }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No admin logins found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- TAB 2 → Visitor Logs -->
                        <div class="tab-pane fade" id="visitorLogs">
                            <h5 class="mb-3">Recent Visitor Logs</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>City</th>
                                            <th>Country</th>
                                            <th>Browser</th>
                                            <th>Date</th>
                                            <th>Total Visits</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentVisitors as $index => $visit)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $visit->city ?? 'N/A' }}</td>
                                            <td>{{ $visit->country ?? 'N/A' }}</td>
                                            <td>{{ $visit->browser ?: 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($visit->date)->format('d M Y') }}</td>
                                            <td class="fw-bold">{{ $visit->total }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">No visitors found</td>
                                        </tr>
                                        @endforelse
                                       
                                        @if($recentVisitors->count())
                                        <tr class="table-secondary fw-bold">
                                            <td colspan="7" class="text-end">Total Visits:</td>
                                            <td>{{ $totalVisitsCount }}</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
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
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const adminBtn = document.getElementById('adminTabBtn');
        const visitorBtn = document.getElementById('visitorTabBtn');
        const adminTab = document.getElementById('adminLogs');
        const visitorTab = document.getElementById('visitorLogs');

        function showTab(tabToShow, btnToActivate) {
            [adminTab, visitorTab].forEach(tab => tab.classList.remove('show', 'active'));
            [adminBtn, visitorBtn].forEach(btn => btn.classList.remove('active'));
            tabToShow.classList.add('show', 'active');
            btnToActivate.classList.add('active');
        }

        adminBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showTab(adminTab, adminBtn);
        });

        visitorBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showTab(visitorTab, visitorBtn);
        });
    });
    </script>
    @endpush