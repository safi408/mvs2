@extends('layouts.masterlayout')

@section('content')
<section class="offer-banner py-5" style="background-color: #f9f9f9;">
  <div class="container">
    @if($banner)
      <div class="row align-items-center justify-content-between">
        
        {{-- Left Section (Text + Button) --}}
        <div class="col-md-6 text-start">
          <h1 class="fw-bold display-5 mb-3" style="color:#111;">
            {{ $banner->title ?? 'Limited-Time Deals On!' }}
          </h1>
          <p class="text-muted fs-5 mb-4">
            {{ $banner->subtitle ?? 'Up to 50% Off Selected Styles. Don’t Miss Out.' }}
          </p>

          @if($banner->button_text)
            <a href="#" class="btn btn-dark btn-lg rounded-pill px-4 d-inline-flex align-items-center">
              {{ $banner->button_text }}
              <i class="bi bi-arrow-up-right ms-2"></i>
            </a>
          @endif
        </div>

        {{-- Right Section (Image + Countdown) --}}
        <div class="col-md-6 text-center">
          @if($banner->image)
            <img src="{{ asset('storage/' . $banner->image) }}" 
                 alt="Offer Image" 
                 class="img-fluid mb-4" 
                 style="max-height: 400px; object-fit: cover;">
          @endif

          <div class="d-flex justify-content-center gap-4 fs-1 fw-bold" id="countdown">
            <div><span id="days">00</span><div class="fs-6 fw-normal text-muted">Days</div></div>
            <div>:</div>
            <div><span id="hours">00</span><div class="fs-6 fw-normal text-muted">Hours</div></div>
            <div>:</div>
            <div><span id="minutes">00</span><div class="fs-6 fw-normal text-muted">Mins</div></div>
            <div>:</div>
            <div><span id="seconds">00</span><div class="fs-6 fw-normal text-muted">Secs</div></div>
          </div>
        </div>
      </div>
    @else
      <div class="alert alert-info text-center">No active offer available right now.</div>
    @endif
  </div>
</section>

{{-- Countdown Script --}}
@if($banner)
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const endDate = new Date("{{ \Carbon\Carbon::parse($banner->end_date)->format('Y-m-d H:i:s') }}").getTime();

    function updateCountdown() {
      const now = new Date().getTime();
      const distance = endDate - now;

      if (distance <= 0) {
        document.getElementById("countdown").innerHTML = "<span class='text-danger fs-3 fw-bold'>Offer Expired</span>";
        return;
      }

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      document.getElementById("days").innerText = days.toString().padStart(2, '0');
      document.getElementById("hours").innerText = hours.toString().padStart(2, '0');
      document.getElementById("minutes").innerText = minutes.toString().padStart(2, '0');
      document.getElementById("seconds").innerText = seconds.toString().padStart(2, '0');
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
  });
</script>
@endif
@endsection
