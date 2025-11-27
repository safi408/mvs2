@extends('layouts.masterlayout')

@section('content')
<div class="container py-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0 text-primary">
            <i class="bi bi-shop me-2"></i>My Store & Vendor Information
        </h3>
        <a href="{{ route('vendor.dashboard') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    {{-- STORE INFORMATION --}}
    <div class="card border-0 shadow-lg rounded-3 mb-4">
        <div class="card-header text-white" style="background: linear-gradient(45deg, #007bff, #6610f2);">
            <h5 class="mb-0"><i class="bi bi-building me-2"></i>Store Details</h5>
        </div>

        <div class="card-body">
            <div class="row align-items-center">
                {{-- Store Logo --}}
                <div class="col-md-3 text-center mb-3 mb-md-0">
                    <div class="border rounded p-2 bg-light">
                        @if($vendor->store_logo)
                            <img src="{{ asset('storage/'.$vendor->store_logo) }}" class="img-fluid rounded" style="max-height: 160px;">
                        @else
                            <img src="{{ asset('assets/img/default-store.png') }}" class="img-fluid rounded" style="max-height: 160px;">
                        @endif
                    </div>

                    {{-- Status --}}
                    <div class="mt-2">
                        @if($vendor->status == 'active')
                            <span class="badge bg-success px-3 py-2">Active</span>
                        @elseif($vendor->status == 'pending')
                            <span class="badge bg-warning text-dark px-3 py-2">Pending Approval</span>
                        @else
                            <span class="badge bg-danger px-3 py-2">Blocked</span>
                        @endif
                    </div>
                    <div class="mt-2">
                        @if($vendor->is_verified)
                            <span class="badge bg-info px-3 py-2"><i class="bi bi-patch-check"></i> Verified Store</span>
                        @else
                            <span class="badge bg-secondary px-3 py-2"><i class="bi bi-x-circle"></i> Not Verified</span>
                        @endif
                    </div>
                </div>

                {{-- Store Info --}}
                <div class="col-md-9">
                    <h4 class="fw-semibold text-dark">{{ $vendor->store_name ?? 'Unnamed Store' }}</h4>
                    <p class="text-muted mb-1"><i class="bi bi-geo-alt me-1"></i><strong>Address:</strong> {{ $vendor->address ?? 'Not provided' }}</p>
                    <p class="text-muted mb-1"><i class="bi bi-telephone me-1"></i><strong>Phone:</strong> {{ $vendor->phone ?? 'Not provided' }}</p>
                    <p class="text-muted mb-1"><i class="bi bi-envelope me-1"></i><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p class="text-muted mb-1"><i class="bi bi-flag me-1"></i><strong>City:</strong> {{ $vendor->city ?? 'Not provided' }}</p>
                    <p class="text-muted mb-1"><i class="bi bi-globe me-1"></i><strong>Country:</strong> {{ $vendor->country ?? 'Not provided' }}</p>
                    <p class="text-muted mb-1"><i class="bi bi-percent me-1"></i><strong>Commission Rate:</strong> 
                        {{ $vendor->commission_rate ? $vendor->commission_rate.'%' : 'Not set' }}
                    </p>
                    <p class="text-muted mb-0"><i class="bi bi-calendar-check me-1"></i><strong>Joined:</strong> {{ $vendor->created_at->format('d M, Y') }}</p>
                    <p class="text-muted mb-0"><i class="bi bi-calendar-check me-1"></i><strong>status:</strong> {{ $vendor->status }}</p>
                </div>
            </div>

            {{-- Description --}}
            @if($vendor->store_description)
                <hr>
                <p class="mt-2 mb-0"><strong>Store Description:</strong></p>
                <p class="text-muted">{!! $vendor->store_description !!}</p>
            @endif
        </div>
    </div>

    {{-- VENDOR (USER) PROFILE --}}
    <div class="card border-0 shadow-lg rounded-3">
        <div class="card-header text-white" style="background: linear-gradient(45deg, #28a745, #20c997);">
            <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i>Vendor Profile</h5>
        </div>

        <div class="card-body">
            <div class="row align-items-center">
                {{-- Vendor Photo --}}
                <div class="col-md-3 text-center mb-3 mb-md-0">
                    <div class="border rounded-circle overflow-hidden d-inline-block bg-light p-2" style="width: 150px; height: 150px;">
        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://via.placeholder.com/120' }}"  class="img-fluid rounded-circle w-100 h-100 object-fit-cover" alt="User Image" width="80" height="80"/>

                    </div>
                </div>

                {{-- Vendor Info --}}
                <div class="col-md-9">
                    <h5 class="fw-semibold">{{ Auth::user()->name }}</h5>
                    <p class="text-muted mb-1"><i class="bi bi-envelope me-1"></i><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p class="text-muted mb-1"><i class="bi bi-phone me-1"></i><strong>Phone:</strong> {{ Auth::user()->phone ?? 'Not provided' }}</p>
                    <p class="text-muted mb-1"><i class="bi bi-geo-alt me-1"></i><strong>Address:</strong> {{ $vendor->address ?? 'Not provided' }}</p>
                    <p class="text-muted mb-0"><i class="bi bi-clock me-1"></i><strong>Member Since:</strong> {{ Auth::user()->created_at->format('d M, Y') }}</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
