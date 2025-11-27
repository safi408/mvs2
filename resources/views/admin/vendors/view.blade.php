@extends('layouts.masterlayout')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-gradient bg-primary text-white d-flex align-items-center">
                    <i class="bi bi-shop fs-4 me-2"></i>
                    <h5 class="mb-0">Vendor Profile</h5>
                </div>
                <div class="card-body p-4">

                    <!-- Vendor Info Header -->
                    <div class="text-center mb-4">
                        <img src="{{ $vendor->store_logo ? asset('storage/'.$vendor->store_logo) : 'https://via.placeholder.com/120' }}" 
                             class="rounded-circle shadow-sm border mb-3" width="130" height="130">
                        <h3 class="fw-bold">{{ $vendor->store_name ?? 'N/A' }}</h3>
                        <span class="badge bg-secondary">{{ $vendor->store_slug ?? 'No Slug' }}</span>
                    </div>

                    <!-- Grid Layout -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light d-flex align-items-center">
                                <i class="bi bi-person-circle text-primary fs-3 me-3"></i>
                                <div>
                                    <h6 class="mb-1 text-muted">Owner</h6>
                                    <p class="mb-0 fw-semibold">{{ $vendor->user->name }} ({{ $vendor->user->email }})</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light d-flex align-items-center">
                                <i class="bi bi-phone text-success fs-3 me-3"></i>
                                <div>
                                    <h6 class="mb-1 text-muted">Phone</h6>
                                    <p class="mb-0 fw-semibold">{{ $vendor->phone ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="p-3 border rounded bg-light d-flex align-items-start">
                                <i class="bi bi-card-text text-info fs-3 me-3"></i>
                                <div>
                                    <h6 class="mb-1 text-muted">Description</h6>
                                    <p class="mb-0">{!! $vendor->store_description ?? 'Not Provided' !!}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 border rounded bg-light d-flex align-items-center">
                                <i class="bi bi-geo-alt text-danger fs-3 me-3"></i>
                                <div>
                                    <h6 class="mb-1 text-muted">Address</h6>
                                    <p class="mb-0 fw-semibold">{{ $vendor->address ?? 'N/A' }}</p>
                                    <small class="text-muted">{{ $vendor->city ?? '' }} - {{ $vendor->country ?? '' }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="p-3 border rounded bg-light text-center">
                                <i class="bi bi-patch-check text-primary fs-2 mb-2"></i>
                                <h6 class="mb-1 text-muted">Status</h6>
                                @if($vendor->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @elseif($vendor->status == 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @else
                                    <span class="badge bg-danger">Blocked</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="p-3 border rounded bg-light text-center">
                                <i class="bi bi-percent text-success fs-2 mb-2"></i>
                                <h6 class="mb-1 text-muted">Commission</h6>
                                <p class="fw-semibold">{{ $vendor->commission_rate ? $vendor->commission_rate.' %' : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit Vendor
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
