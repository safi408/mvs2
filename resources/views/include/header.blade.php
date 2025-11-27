<nav class="app-header navbar navbar-expand bg-body shadow-sm">
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>
        <!--end::Start Navbar Links-->

        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">

            <!-- LMS Notifications -->
           

            <!-- Fullscreen -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>

        <!-- User Menu -->
<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://via.placeholder.com/120' }}" class="user-image rounded-circle shadow me-2" alt="User Image" width="32" height="32"/>
        <span class="d-none d-md-inline">{{ Auth::user()->name ?? 'Admin - LMS' }}</span>
    </a>

    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow">
        <!-- User Header -->
        <li class="user-header text-bg-primary text-center p-3">
            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://via.placeholder.com/120' }}" class="rounded-circle shadow mb-2" alt="User Image" width="80" height="80"/>
            <p class="mb-0 fw-bold">
                {{ Auth::user()->name ?? 'Alexander Pierce' }}
            </p>
            <small>Member since {{ Auth::user()->created_at->format('M Y') ?? 'Jan. 2024' }}</small>
        </li>

        <!-- Divider -->
        <li><hr class="dropdown-divider"></li>

        <!-- Menu Body -->
  
@if (Auth::user()->role_id === 10)
    {{-- 🔹 Admin Profile --}}
    <li>
        <a href="{{ route('admin.profile') }}" class="dropdown-item">
            <i class="bi bi-person-circle me-2 text-primary"></i> Admin Profile
        </a>
    </li>

@elseif (Auth::user()->role_id === 7)
    {{-- 🔹 User Profile --}}
    <li>
        <a href="{{ route('user.profile') }}" class="dropdown-item">
            <i class="bi bi-person-circle me-2 text-primary"></i> User Profile
        </a>
    </li>

@elseif (Auth::user()->role_id === 8)
    {{-- 🔹 Vendor Profile --}}
    <li>
        <a href="{{ route('vendor.profile') }}" class="dropdown-item">
            <i class="bi bi-person-circle me-2 text-primary"></i> Vendor Profile
        </a>
    </li>

@else
    {{-- 🔹 Default Profile (For Developer, Manager, or Any New Role) --}}
    <li>
        <a href="{{route('default.profile')}}" class="dropdown-item">
            <i class="bi bi-person-circle me-2 text-primary"></i> Profile
        </a>
    </li>
@endif

        @if (Auth::user()->role_id === 10 )
         <li>
            <a href="{{ route('admin.change') }}" class="dropdown-item">
                <i class="bi bi-lock-fill me-2 text-warning"></i> Change Password
            </a>
        </li>
        @endif

        <!-- Divider -->
        <li><hr class="dropdown-divider"></li>

        <!-- Menu Footer-->
        <li class="user-footer text-center p-2">
            <a href="{{ route('logout') }}" class="btn btn-danger btn-sm w-100"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</li>

        </ul>
        <!--end::End Navbar Links-->
    </div>
</nav>