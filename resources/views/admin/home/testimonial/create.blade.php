@extends('layouts.masterlayout')

@section('title', 'Add Testimonial')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">

            <!-- Card -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <!-- Header -->
                <div class="card-header bg-gradient-primary text-primary py-3 d-flex align-items-center">
                    <i class="bi bi-chat-square-quote fs-4 me-2"></i>
                    <h5 class="mb-0 fw-bold">Add New Testimonial</h5>
                </div>

                <!-- Body -->
                <div class="card-body bg-light p-5">
                    <form action="{{ route('admin.testimonial.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- 🟦 Customer Info -->
                        <h6 class="text-primary fw-bold mb-3"><i class="bi bi-person-lines-fill me-2"></i>Customer Information</h6>
                        <div class="row g-4">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-person-fill text-primary"></i></span>
                                    <input type="text" name="name" class="form-control shadow-sm" placeholder="Customer Name" value="{{ old('name') }}">
                                </div>
                                @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-briefcase-fill text-primary"></i></span>
                                    <input type="text" name="title" class="form-control shadow-sm" placeholder="Title / Designation" value="{{ old('title') }}">
                                </div>
                                @error('title')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-list-ol text-primary"></i></span>
                                    <input type="number" name="order" class="form-control shadow-sm" placeholder="Carousel Order" value="{{ old('order') }}">
                                </div>
                                @error('order')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-list-ol text-primary"></i></span>
                                    <input type="number" name="price" class="form-control shadow-sm" placeholder="Price" value="{{ old('price') }}">
                                </div>
                                @error('price')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                


                        <!-- 🟨 Review Details -->
                        <h6 class="text-primary fw-bold mt-4 mb-3"><i class="bi bi-star-half me-2"></i>Review Details</h6>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="bi bi-chat-text text-primary"></i></span>
                                    <textarea name="message" class="form-control shadow-sm" rows="4" placeholder="Customer review...">{{ old('message') }}</textarea>
                                </div>
                                @error('message')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <span class="input-group-text bg-white"><i class="bi bi-star-fill text-warning"></i></span>
                                    <select name="rating" class="form-select shadow-sm">
                                        @for($i=5; $i>=1; $i--)
                                            <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                                                {{ str_repeat('⭐', $i) }} - {{ $i == 5 ? 'Excellent' : ($i==4?'Good':($i==3?'Average':($i==2?'Poor':'Very Poor'))) }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                @error('rating')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
{{-- 
                                <div class="form-check form-switch mt-3">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
                                    <label class="form-check-label fw-semibold">Active Status</label>
                                </div> --}}
                            </div>
                        </div>

                        <!-- 🟩 Media Uploads -->
                        <h6 class="text-primary fw-bold mt-4 mb-3"><i class="bi bi-images me-2"></i>Media Uploads</h6>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Customer Image</label>
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text bg-white"><i class="bi bi-person-bounding-box text-primary"></i></span>
                                    <input type="file" name="image" class="form-control">
                                </div>
                                @error('image')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                                <small class="text-muted">JPG, PNG, GIF (max 2MB)</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Product Image (Optional)</label>
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text bg-white"><i class="bi bi-box-seam text-primary"></i></span>
                                    <input type="file" name="product_image" class="form-control">
                                </div>
                                @error('product_image')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                                <small class="text-muted">JPG, PNG, GIF (max 2MB)</small>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="text-end mt-5">
                            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                                <i class="bi bi-save2 me-2"></i>Save Testimonial
                            </button>
                            <a href="{{ route('admin.testimonial.show') }}" class="btn btn-outline-secondary px-4 py-2 rounded-pill ms-2">
                                <i class="bi bi-arrow-left-circle me-1"></i>Cancel
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
