@extends('layouts.masterlayout')

@section('content')
<div class="container py-5">
  <div class="card shadow-sm rounded-4 p-4">
    <h3 class="fw-bold mb-4">Website Settings</h3>

    <form action="{{ route('admin.setting.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row g-3">

        {{-- Logo Upload --}}
        <div class="col-md-4">
          <label class="form-label fw-semibold">Site Logo</label>
          <input type="file" name="image" class="form-control">
        </div>

        {{-- Site Name --}}
        <div class="col-md-4">
          <label class="form-label fw-semibold">Site Name</label>
          <input type="text" name="site_name" value="{{ old('site_name', $setting->site_name ?? '') }}" class="form-control">
          @error('site_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        {{-- Email --}}
        <div class="col-md-4">
          <label class="form-label fw-semibold">Email</label>
          <input type="email" name="email" value="{{ old('email', $setting->email ?? '') }}" class="form-control">
          @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        {{-- Phone --}}
        <div class="col-md-4">
          <label class="form-label fw-semibold">Phone</label>
          <input type="text" name="phone" value="{{ old('phone', $setting->phone ?? '') }}" class="form-control">
          @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        {{-- Contact --}}
        <div class="col-md-4">
          <label class="form-label fw-semibold">Contact Number</label>
          <input type="text" name="contact" value="{{ old('contact', $setting->contact ?? '') }}" class="form-control" placeholder="Enter alternate contact number">
          @error('contact') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        {{-- Direction Address --}}
        <div class="col-md-4">
          <label class="form-label fw-semibold">Direction Address</label>
          <input type="text" name="direction_address" value="{{ old('direction_address', $setting->direction_address ?? '') }}" class="form-control" placeholder="e.g. Lahore, Pakistan">
          @error('direction_address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        {{-- Direction Link --}}
        <div class="col-md-12">
          <label class="form-label fw-semibold">Get Direction Link</label>
          <input type="text" name="direction_link" value="{{ old('direction_link', $setting->direction_link ?? '') }}" class="form-control" placeholder="https://www.google.com/maps/dir/?api=1&destination=Lahore">
          @error('direction_link') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <hr class="my-4">

        <h5 class="fw-bold mb-3">Social Links</h5>

        <div class="col-md-4">
          <label class="form-label">Facebook</label>
          <input type="url" name="facebook" value="{{ old('facebook', $setting->facebook ?? '') }}" class="form-control">
        </div>

        <div class="col-md-4">
          <label class="form-label">X (Twitter)</label>
          <input type="url" name="x" value="{{ old('x', $setting->x ?? '') }}" class="form-control">
        </div>

        <div class="col-md-4">
          <label class="form-label">Instagram</label>
          <input type="url" name="instagram" value="{{ old('instagram', $setting->instagram ?? '') }}" class="form-control">
        </div>

        <div class="col-md-4">
          <label class="form-label">TikTok</label>
          <input type="url" name="tiktok" value="{{ old('tiktok', $setting->tiktok ?? '') }}" class="form-control">
        </div>

        <div class="col-md-4">
          <label class="form-label">YouTube</label>
          <input type="url" name="youtube" value="{{ old('youtube', $setting->youtube ?? '') }}" class="form-control">
        </div>

        <div class="col-md-4">
          <label class="form-label">Pinterest</label>
          <input type="url" name="pinterest" value="{{ old('pinterest', $setting->pinterest ?? '') }}" class="form-control">
        </div>

        <div class="col-md-12">
          <label class="form-label fw-semibold">Address</label>
          <input type="text" name="address" value="{{ old('address', $setting->address ?? '') }}" class="form-control">
          @error('address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        {{-- Open Times --}}
        <div class="col-md-6">
          <label class="form-label fw-semibold">Open Hours (Mon - Sat)</label>
          <input type="text" name="open_time_weekdays"
                 value="{{ old('open_time_weekdays', $setting->open_time_weekdays ?? 'Mon - Sat: 7:30am - 8:00pm PST') }}"
                 class="form-control">
          @error('open_time_weekdays') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-6">
          <label class="form-label fw-semibold">Open Hours (Sunday)</label>
          <input type="text" name="open_time_sunday"
                 value="{{ old('open_time_sunday', $setting->open_time_sunday ?? 'Sunday: 9:00am - 5:00pm PST') }}"
                 class="form-control">
          @error('open_time_sunday') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

      </div>

      <div class="mt-4 text-end">
        <button class="btn btn-primary px-4 rounded-pill fw-bold">Update Settings</button>
      </div>
    </form>
  </div>
</div>
@endsection
