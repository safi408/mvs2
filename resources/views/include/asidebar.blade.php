<style>
  .nav-link.active {
  background-color: #0d6efd !important; /* Bootstrap Primary */
  color: #fff !important;
  border-radius: 8px;
}

</style>
<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand text-center py-3">
    <span class="brand-text fw-light">E-Commerce</span>
  </div>
  <!--end::Sidebar Brand-->

  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

        {{-- ================= ADMIN SIDEBAR ================= --}}
        
         @role('admin')
        @include('layouts.admin');
        @endrole



        {{-- ================= VENDOR SIDEBAR ================= --}}
{{-- @if (Auth::user()->role_id === 8) --}}
@role('vendor')
      @include('layouts.vendor')
 @endrole

        {{-- ================= CUSTOMER SIDEBAR ================= --}}
@if (Auth::user()->role_id === 7)
  <li class="nav-item">
  <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
    <i class="bi bi-speedometer2"></i>
    <p>Customer Dashboard</p>
  </a>
</li>
     
<!-- Wishlist -->
<li class="nav-item">
  <a href="" class="nav-link">
    <i class="bi bi-heart me-2"></i>Wishlist
  </a>
</li>


  <li class="nav-item">
    <a href="{{ route('user.order') }}" class="nav-link {{ request()->routeIs('user.order') ? 'active' : '' }}"><i class="bi bi-bag-check me-2"></i>My Orders</a>
  </li>
  @endif





<!--Default role-->

@if (Auth::user()->role_id != 10 && Auth::user()->role_id !=8 && Auth::user()->role_id !=7)
    <!-- Dashboard -->
<li class="nav-item">
  <a href="{{ route('admin.dashboard') }}" 
     class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <i class="bi bi-speedometer2"></i>
    <p>Dashboard</p>
  </a>
</li>
@can('manage_category')
<li class="nav-item has-treeview 
  {{ request()->routeIs('category.create') || request()->routeIs('category.manage') ? 'menu-open' : '' }}">
  
  <a href="#" class="nav-link 
    {{ request()->routeIs('category.create') || request()->routeIs('category.manage') ? '' : '' }}">
    <i class="bi bi-tags"></i>
    <p>
      Categories
      <i class="nav-arrow bi bi-chevron-right"></i>
    </p>
  </a>

  <ul class="nav nav-treeview ps-3">
    <li>
      <a href="{{ route('category.create') }}" 
         class="nav-link {{ request()->routeIs('category.create') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> Add Category
      </a>
    </li>

    <li>
      <a href="{{ route('category.manage') }}" 
         class="nav-link {{ request()->routeIs('category.manage') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> All Categories
      </a>
    </li>
  </ul>
</li>
@endcan
<!-- Subcategories -->
@can('manage_subcategory')
<li class="nav-item has-treeview {{ request()->routeIs('subcategory.*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->routeIs('subcategory.*') ? '' : '' }}">
    <i class="bi bi-diagram-2"></i>
    <p>Sub Categories <i class="nav-arrow bi bi-chevron-right"></i></p>
  </a>
  <ul class="nav nav-treeview ps-3">
    <li>
      <a href="{{ route('subcategory.create') }}" class="nav-link {{ request()->routeIs('subcategory.create') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i>Add Sub Category
      </a>
    </li>
    <li>
      <a href="{{ route('subcategory.manage') }}" class="nav-link {{ request()->routeIs('subcategory.manage') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i>All Sub Categories
      </a>
    </li>
  </ul>
</li>
@endcan




@can('child_category')
    <!-- Childcategories -->

<li class="nav-item has-treeview {{ request()->routeIs('childcategory.*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->routeIs('childcategory.*') ? '' : '' }}">
    <i class="bi bi-diagram-3"></i>
    <p>
      Child Categories
      <i class="nav-arrow bi bi-chevron-right"></i>
    </p>
  </a>

  <ul class="nav nav-treeview ps-3">
    <li>
      <a href="{{ route('childcategory.create') }}" class="nav-link {{ request()->routeIs('childcategory.create') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i>Add Child Category
      </a>
    </li>
    <li>
      <a href="{{ route('childcategory.manage') }}" class="nav-link {{ request()->routeIs('childcategory.manage') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i>All Child Categories
      </a>
    </li>
  </ul>
</li>
@endcan




@can('admin_products')
    <!-- Products -->
<li class="nav-item has-treeview 
  {{ request()->routeIs('admin.create.product') || request()->routeIs('admin.show.product') || request()->routeIs('admin.products.index') ? 'menu-open' : '' }}">
  
  <a href="#" class="nav-link 
    {{ request()->routeIs('admin.create.product') || request()->routeIs('admin.show.product') || request()->routeIs('admin.products.index') ? '' : '' }}">
    <i class="bi bi-box-seam"></i>
    <p>
      Products
      <i class="nav-arrow bi bi-chevron-right"></i>
    </p>
  </a>

  <ul class="nav nav-treeview ps-3">
    <li>
      <a href="{{ route('admin.create.product') }}" 
         class="nav-link {{ request()->routeIs('admin.create.product') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> Add Product
      </a>
    </li>

    <li>
      <a href="{{ route('admin.show.product') }}" 
         class="nav-link {{ request()->routeIs('admin.show.product') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> All Products
      </a>
    </li>

    <li>
      <a href="{{ route('admin.products.index') }}" 
         class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> Vendor Products
      </a>
    </li>
  </ul>
</li>
@endcan




@can('user_mangement')
    <!-- Users Management -->
<li class="nav-item has-treeview {{ request()->routeIs('role.*') || request()->routeIs('user.*') || request()->routeIs('permission.*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->routeIs('role.*') || request()->routeIs('user.*') || request()->routeIs('permission.*') ? '' : '' }}">
    <i class="bi bi-people-fill"></i>
    <p>Users Management <i class="nav-arrow bi bi-chevron-right"></i></p>
  </a>
  <ul class="nav nav-treeview ps-3">

    <!-- Roles -->
    <li class="nav-item has-treeview {{ request()->routeIs('role.*') ? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ request()->routeIs('role.*') ? '' : '' }}">
        <i class="bi bi-person-gear me-2"></i>Roles<i class="nav-arrow bi bi-chevron-right"></i>
      </a>
      <ul class="nav nav-treeview ps-3">
        <li>
          <a href="{{ route('role.create') }}" class="nav-link {{ request()->routeIs('role.create') ? 'active' : '' }}">
            <i class="bi bi-circle me-2"></i>Add Role
          </a>
        </li>
        <li>
          <a href="{{ route('role.manage') }}" class="nav-link {{ request()->routeIs('role.manage') ? 'active' : '' }}">
            <i class="bi bi-circle me-2"></i>All Roles
          </a>
        </li>
      </ul>
    </li>

    <!-- Users -->
    <li class="nav-item has-treeview {{ request()->routeIs('user.*') ? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ request()->routeIs('user.*') ? '' : '' }}">
        <i class="bi bi-person-fill me-2"></i>Users<i class="nav-arrow bi bi-chevron-right"></i>
      </a>
      <ul class="nav nav-treeview ps-3">
        <li>
          <a href="{{ route('user.create') }}" class="nav-link {{ request()->routeIs('user.create') ? 'active' : '' }}">
            <i class="bi bi-circle me-2"></i>Add User
          </a>
        </li>
        <li>
          <a href="{{ route('user.manage') }}" class="nav-link {{ request()->routeIs('user.manage') ? 'active' : '' }}">
            <i class="bi bi-circle me-2"></i>All Users
          </a>
        </li>
      </ul>
    </li>

    <!-- Permissions -->
    <li class="nav-item has-treeview {{ request()->routeIs('permission.*') ? 'menu-open' : '' }}">
      <a href="#" class="nav-link {{ request()->routeIs('permission.*') ? '' : '' }}">
        <i class="bi bi-key-fill me-2"></i>Permissions<i class="nav-arrow bi bi-chevron-right"></i>
      </a>
      <ul class="nav nav-treeview ps-3">
        <li>
          <a href="{{ route('permission.create') }}" class="nav-link {{ request()->routeIs('permission.create') ? 'active' : '' }}">
            <i class="bi bi-circle me-2"></i>Add Permission
          </a>
        </li>
        <li>
          <a href="{{ route('permission.index') }}" class="nav-link {{ request()->routeIs('permission.index') ? 'active' : '' }}">
            <i class="bi bi-circle me-2"></i>All Permissions
          </a>
        </li>
      </ul>
    </li>

  </ul>
</li>
@endcan


<!-- Vendors -->



@can('vendor')
   <li class="nav-item has-treeview {{ request()->routeIs('vendor.*') || request()->routeIs('vendors.*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->routeIs('vendor.*') || request()->routeIs('vendors.*') ? '' : '' }}">
    <i class="bi bi-shop"></i>
    <p>Vendors <i class="nav-arrow bi bi-chevron-right"></i></p>
  </a>
  <ul class="nav nav-treeview ps-3">
    <li>
      <a href="{{ route('vendor.list') }}" class="nav-link {{ request()->routeIs('vendor.list') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i>All Vendors
      </a>
    </li>
    <li>
      <a href="{{ route('vendors.index') }}" class="nav-link {{ request()->routeIs('vendors.index') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i>All Stores
      </a>
    </li>
  </ul>
</li> 
@endcan

@can('settings')
<li class="nav-item">
  <a href="{{ route('settings') }}" class="nav-link {{ request()->routeIs('settings') ? 'active' : '' }}">
    <i class="bi bi-gear-fill"></i>
    <p>Settings</p>
  </a>
</li>
@endcan



        <!-- Logout -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i>
            <p>Logout</p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </li>


@endif





        <!-- Settings -->




      </ul>
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->

</aside>
<!--end::Sidebar-->
