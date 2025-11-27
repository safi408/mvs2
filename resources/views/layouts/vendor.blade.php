
    @php
      $vendor = \App\Models\Vendor::where('user_id', Auth::id())->first();
    @endphp

          <!-- Dashboard -->
@can('vendor_dashboard')
<li class="nav-item">
  <a href="{{ route('vendor.dashboard') }}" class="nav-link {{ request()->routeIs('vendor.dashboard') ? 'active' : '' }}">
    <i class="bi bi-speedometer2"></i>
    <p>Vendor Dashboard</p>
  </a>
</li>
@endcan


        <!-- My Store -->
@can('vendor_store')
<li class="nav-item">
  @if ($vendor)
    @if ($vendor->status === 'active')
      <a href="{{ route('vendor.store.view') }}" class="nav-link {{ request()->routeIs('vendor.store.view') ? 'active' : '' }}">
        <i class="bi bi-shop me-2"></i>My Store <span class="badge bg-success">Active</span>
      </a>
    @elseif ($vendor->status === 'pending')
      <a href="{{ route('vendor.store.view') }}" class="nav-link {{ request()->routeIs('vendor.store.view') ? 'active' : '' }}">
        <i class="bi bi-hourglass-split me-2"></i>My Store <span class="badge bg-warning text-dark">Pending</span>
      </a>
    @else
      <a href="#" class="nav-link disabled">
        <i class="bi bi-x-circle me-2"></i>My Store <span class="badge bg-danger">Blocked</span>
      </a>
    @endif
  @else
    <a href="#" class="nav-link disabled">
      <i class="bi bi-shop me-2"></i>My Store <span class="badge bg-secondary">Not Created</span>
    </a>
  @endif
</li>
@endcan

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



<!-- Brands -->

@can('products_brand')
    <li class="nav-item has-treeview {{ request()->routeIs('admin.productbrand.index') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link">
    <i class="bi bi-cpu-fill"></i>
    <p>Product Brands<i class="nav-arrow bi bi-chevron-right"></i></p>
  </a>
  <ul class="nav nav-treeview ps-3">
    <li>
      <a href="{{ route('admin.productbrand.index') }}" class="nav-link {{ request()->routeIs('admin.productbrand.index') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> All brands
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
<li class="nav-item has-treeview {{ request()->routeIs('childcategory.manage') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link">
    <i class="bi bi-diagram-3"></i>
    <p>Child Categories<i class="nav-arrow bi bi-chevron-right"></i></p>
  </a>
  <ul class="nav nav-treeview ps-3">
    <li>
      <a href="{{ route('childcategory.manage') }}" class="nav-link {{ request()->routeIs('childcategory.manage') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> All Child Categories
      </a>
    </li>
  </ul>
</li>
@endcan


        <!-- Vendor Products -->
@can('vendors_product')
@if ($vendor && $vendor->status === 'active')
<li class="nav-item has-treeview {{ request()->routeIs('vendor.product') || request()->routeIs('vendor.products.index') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->routeIs('vendor.product') || request()->routeIs('vendor.products.index') ? '' : '' }}">
    <i class="bi bi-box-seam me-2"></i>Products<i class="nav-arrow bi bi-chevron-right"></i>
  </a>
  <ul class="nav nav-treeview ps-3">
    <li>
      <a href="{{ route('vendor.product') }}" class="nav-link {{ request()->routeIs('vendor.product') ? 'active' : '' }}">
        <i class="bi bi-plus-circle me-2"></i>Add Product
      </a>
    </li>
    <li>
      <a href="{{ route('vendor.products.index') }}" class="nav-link {{ request()->routeIs('vendor.products.index') ? 'active' : '' }}">
        <i class="bi bi-list-ul me-2"></i>All Products
      </a>
    </li>
  </ul>
</li>
@else
<li class="nav-item">
  <a href="#" class="nav-link disabled">
    <i class="bi bi-box-seam me-2"></i>Products <span class="badge bg-secondary">Locked</span>
  </a>
</li>
@endif
@endcan


          <!-- Orders -->
          @if ($vendor && $vendor->status === 'active')
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link"><i class="bi bi-bag-check me-2"></i>Orders<i class="nav-arrow bi bi-chevron-right"></i></a>
              <ul class="nav nav-treeview ps-3">
                <li><a href="#" class="nav-link"><i class="bi bi-list-check me-2"></i>All Orders</a></li>
                <li><a href="#" class="nav-link"><i class="bi bi-check2-circle me-2"></i>Completed Orders</a></li>
              </ul>
            </li>
          @else
            <li class="nav-item"><a href="#" class="nav-link disabled"><i class="bi bi-bag-check me-2"></i>Orders <span class="badge bg-secondary">Locked</span></a></li>
          @endif


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


        {{-- @endif --}}