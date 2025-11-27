@extends('layouts.masterlayout')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Welcome, {{ Auth::user()->name }}</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active" aria-current="page">Customer Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">

            <!--begin::Row - Stats Boxes-->
            <div class="row">
                <!-- My Orders -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>8</h3>
                            <p>My Orders</p>
                        </div>
                        <i class="small-box-icon bi bi-cart-fill"></i>
                        <div class="small-box-footer">
                            View Orders <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Wishlist -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>5</h3>
                            <p>Wishlist Items</p>
                        </div>
                        <i class="small-box-icon bi bi-heart-fill"></i>
                        <div class="small-box-footer">
                            View Wishlist <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Profile -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>Profile</h3>
                            <p>Update Info</p>
                        </div>
                        <i class="small-box-icon bi bi-person-circle"></i>
                        <div class="small-box-footer">
                            Edit Profile <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Support -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>Help</h3>
                            <p>Customer Support</p>
                        </div>
                        <i class="small-box-icon bi bi-headset"></i>
                        <div class="small-box-footer">
                            Contact Support <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row">
                <!-- Recent Orders -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header"><h3 class="card-title">My Recent Orders</h3></div>
                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>101</td>
                                        <td>2025-09-25</td>
                                        <td><span class="badge bg-success">Delivered</span></td>
                                        <td>$120</td>
                                    </tr>
                                    <tr>
                                        <td>102</td>
                                        <td>2025-09-26</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                        <td>$75</td>
                                    </tr>
                                    <tr>
                                        <td>103</td>
                                        <td>2025-09-27</td>
                                        <td><span class="badge bg-danger">Cancelled</span></td>
                                        <td>$40</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-sm btn-primary">View All Orders</button>
                        </div>
                    </div>
                </div>

                <!-- Account Info -->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header"><h3 class="card-title">My Profile</h3></div>
                        <div class="card-body text-center">
                            <img src="{{ Auth::user()->image ? asset('storage/'.Auth::user()->image) : asset('assets/img/avatar.png') }}" 
                                 class="rounded-circle mb-3" width="100" height="100" alt="Profile">
                            <h5>{{ Auth::user()->name }}</h5>
                            <p class="text-muted mb-1">{{ Auth::user()->email }}</p>
                            <p class="text-muted">Phone: {{ Auth::user()->phone ?? 'N/A' }}</p>
                            {{-- <a href="{{route('user.profile')}}" class="btn btn-outline-primary btn-sm">Edit Profile</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->

        </div>
    </div>
@endsection
