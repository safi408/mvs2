@extends('layouts.masterlayout')

@section('content')

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Welcome, {{ Auth::user()->name }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active" aria-current="page">Vendor Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">

            {{-- ================= Store Status Alert ================= --}}
            @php
                $vendor = \App\Models\Vendor::where('user_id', Auth::id())->first();
            @endphp

            @if($vendor && $vendor->status === 'active')
                <div class="alert alert-success shadow-sm rounded-3">
                    ✅ Your store <strong>{{ $vendor->store_name }}</strong> is <span class="badge bg-success">Active</span>!
                </div>
            @elseif($vendor && $vendor->status === 'pending')
                <div class="alert alert-warning shadow-sm rounded-3">
                    ⚠️ Your store <strong>{{ $vendor->store_name }}</strong> is <span class="badge bg-warning">Pending Approval</span> by Admin.
                </div>
            @else
                <div class="alert alert-secondary shadow-sm rounded-3">
                    🏪 Admin has not created your store yet.
                </div>
            @endif

            <!-- ================== Stats Row ================== -->
            <div class="row mt-3">
                <!-- Vendor Products -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>{{$product}}</h3>
                            <p>My Products</p>
                        </div>
                        <i class="small-box-icon bi bi-box-seam"></i>
                        <div class="small-box-footer">
                            Manage My Products <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Vendor Orders -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>0</h3>
                            <p>My Orders</p>
                        </div>
                        <i class="small-box-icon bi bi-cart-check-fill"></i>
                        <div class="small-box-footer">
                            View My Orders <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Pending Orders -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Pending Orders</p>
                        </div>
                        <i class="small-box-icon bi bi-hourglass-split"></i>
                        <div class="small-box-footer">
                            Process Orders <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Vendor Revenue -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>0</h3>
                            <p>My Revenue</p>
                        </div>
                        <i class="small-box-icon bi bi-currency-dollar"></i>
                        <div class="small-box-footer">
                            View My Reports <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Stats -->

            <!-- Charts & Recent Orders -->
            <div class="row">
                <!-- Vendor Sales Chart -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header"><h3 class="card-title">My Sales Overview</h3></div>
                        <div class="card-body">
                            <div id="vendor-sales-chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header"><h3 class="card-title">Recent My Orders</h3></div>
                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4" class="text-center">No orders found</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="btn btn-sm btn-primary">View All My Orders</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Products -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header"><h3 class="card-title">My Top Selling Products</h3></div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item text-center">No products yet</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Customer Growth -->
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header"><h3 class="card-title">My Customers Growth</h3></div>
                        <div class="card-body">
                            <div id="vendor-customer-chart" style="height: 250px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->

        </div>
    </div>
@endsection
