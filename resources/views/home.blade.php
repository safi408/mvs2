{{-- 
  @extends('layouts.masterlayout')
@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6"><h3 class="mb-0">Welcome, {{Auth::user()->name}}</h3></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
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
                <!-- Total Products -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-primary">
                        <div class="inner">
                            <h3>120</h3>
                            <p>Total Products</p>
                        </div>
                        <i class="small-box-icon bi bi-box-seam"></i>
                        <div class="small-box-footer">
                            Manage Products <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Orders -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>350</h3>
                            <p>Total Orders</p>
                        </div>
                        <i class="small-box-icon bi bi-cart-fill"></i>
                        <div class="small-box-footer">
                            View Orders <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Customers -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>85</h3>
                            <p>Customers</p>
                        </div>
                        <i class="small-box-icon bi bi-people-fill"></i>
                        <div class="small-box-footer">
                            View Customers <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>

                <!-- Revenue -->
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>$45K</h3>
                            <p>Total Revenue</p>
                        </div>
                        <i class="small-box-icon bi bi-currency-dollar"></i>
                        <div class="small-box-footer">
                            View Reports <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row">
                <!-- Sales Chart -->
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header"><h3 class="card-title">Sales Overview</h3></div>
                        <div class="card-body">
                            <div id="sales-chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>

                <!-- Recent Orders -->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header"><h3 class="card-title">Recent Orders</h3></div>
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
                                        <td>001</td>
                                        <td>Ali Khan</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                        <td>$250</td>
                                    </tr>
                                    <tr>
                                        <td>002</td>
                                        <td>Fatima</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                        <td>$120</td>
                                    </tr>
                                    <tr>
                                        <td>003</td>
                                        <td>John Doe</td>
                                        <td><span class="badge bg-danger">Cancelled</span></td>
                                        <td>$90</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-sm btn-primary" disabled>View All Orders</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row">
                <!-- Top Products -->
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header"><h3 class="card-title">Top Selling Products</h3></div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between">
                                    Laptop <span class="badge bg-primary">150 Sales</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    Headphones <span class="badge bg-primary">120 Sales</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    Smartphone <span class="badge bg-primary">100 Sales</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Customers Growth -->
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-header"><h3 class="card-title">New Customers Growth</h3></div>
                        <div class="card-body">
                            <div id="customer-chart" style="height: 250px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Row-->

        </div>
    </div>
@endsection


 --}}
