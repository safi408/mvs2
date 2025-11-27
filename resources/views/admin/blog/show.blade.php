@extends('layouts.masterlayout')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

        {{-- Header --}}
        <div class="card-header text-white py-3 px-4" 
             style="background: linear-gradient(90deg, #0d6efd, #6610f2);">
            <h4 class="fw-bold mb-0"><i class="bi bi-eye me-2"></i> View Blog Details</h4>
        </div>

        {{-- Body --}}
        <div class="card-body p-4">

            {{-- 🧾 Title & Author --}}
            <div class="mb-4">
                <h3 class="fw-bold text-primary">{{ $blog->title }}</h3>
                <p class="text-muted mb-0">
                    <i class="bi bi-person"></i> <strong>{{ $blog->author ?? 'Unknown' }}</strong> |
                    <i class="bi bi-calendar"></i> {{ $blog->publish_date ? date('d M Y', strtotime($blog->publish_date)) : 'N/A' }}
                </p>
            </div>

            {{-- 🖼 Blog Images --}}
            <div class="row g-3 mb-4">
                @if($blog->image_1)
                    <div class="col-md-6 text-center">
                        <img src="{{ asset('storage/' . $blog->image_1) }}" 
                             alt="Blog Image 1" 
                             class="img-fluid rounded-4 shadow-sm" 
                             style="max-height: 300px; object-fit: cover;">
                    </div>
                @endif
                @if($blog->image_2)
                    <div class="col-md-6 text-center">
                        <img src="{{ asset('storage/' . $blog->image_2) }}" 
                             alt="Blog Image 2" 
                             class="img-fluid rounded-4 shadow-sm" 
                             style="max-height: 300px; object-fit: cover;">
                    </div>
                @endif
            </div>

            {{-- 📝 Description --}}
            <div class="mb-4">
                <h5 class="fw-semibold text-secondary"><i class="bi bi-textarea-t"></i> Description</h5>
                <p class="text-dark lh-lg">{!! nl2br(e($blog->description)) !!}</p>
            </div>

            {{-- 🔹 Bullets --}}
            @if(!empty($blog->bullets))
                @php
                    $bullets = is_array($blog->bullets) ? $blog->bullets : json_decode($blog->bullets, true);
                @endphp
                <div class="mb-4">
                    <h5 class="fw-semibold text-secondary"><i class="bi bi-list-ul"></i> Key Points</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($bullets as $point)
                            <li class="list-group-item"><i class="bi bi-check-circle text-success me-2"></i>{{ $point }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

      

            {{-- 🔗 Related Posts --}}
            <div class="mb-4">
                <h5 class="fw-semibold text-secondary"><i class="bi bi-link-45deg"></i> Related Posts</h5>
                <div class="d-flex justify-content-between flex-wrap">
                    <div>
                        @if($blog->related_previous_title)
                            <p class="mb-1"><strong>Previous:</strong> 
                                <a href="{{ $blog->related_previous_url ?? '#' }}" target="_blank">
                                    {{ $blog->related_previous_title }}
                                </a>
                            </p>
                        @endif
                    </div>
                    <div>
                        @if($blog->related_next_title)
                            <p class="mb-1"><strong>Next:</strong> 
                                <a href="{{ $blog->related_next_url ?? '#' }}" target="_blank">
                                    {{ $blog->related_next_title }}
                                </a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- 🔙 Back Button --}}
            <div class="text-end mt-4">
                <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="bi bi-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
    </div>
</div>

{{-- 🌈 Style Enhancements --}}
<style>
    .badge.bg-gradient {
        border-radius: 12px;
        color: #fff;
    }
</style>
@endsection
