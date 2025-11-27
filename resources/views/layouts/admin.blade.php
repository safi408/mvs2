@if (Auth::user()->role_id == 10)

<!-- Dashboard -->
<li class="nav-item">
  <a href="{{ route('admin.dashboard') }}" 
     class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <i class="bi bi-speedometer2"></i>
    <p>Admin Dashboard</p>
  </a>
</li>

<!-- CMS Management -->
<li class="nav-item has-treeview {{ Request::routeIs('admin.shop.*','admin.offer.*', 'banner.*', 'admin.testimonial.*','admin.feature.*','admin.faq.*','admin.term.*','admin.contact.*','admin.about.*','admin.blog.*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link">
    <i class="bi bi-gear"></i>
    <p>CMS Management<i class="nav-arrow bi bi-chevron-right"></i></p>
  </a>

  <ul class="nav nav-treeview ps-3">

    <!-- Home Page -->
    <li class="nav-item has-treeview {{ Request::routeIs('banner.*', 'admin.shop.*', 'admin.offer.*','admin.feature.*', 'admin.testimonial.*') ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="bi bi-house-door"></i>
        <p>Home Page <i class="nav-arrow bi bi-chevron-right"></i></p>
      </a>
      <ul class="nav nav-treeview ps-3">

        <!-- Slider -->
        <li>
          <a href="{{ route('banner.index') }}" class="nav-link {{ Request::routeIs('banner.index') ? 'active' : '' }}">
            <i class="bi bi-circle me-2"></i> All Slider
          </a>
        </li>

        <!-- Shop Collection -->
        <li>
          <a href="{{ route('admin.shop.collection') }}" class="nav-link {{ Request::routeIs('admin.shop.collection') ? 'active' : '' }}">
            <i class="bi bi-circle me-2"></i> Update Shop Collection
          </a>
        </li>

        <!-- Offer Banner -->
        <li>
          <a href="{{ route('admin.offer.edit') }}" class="nav-link {{ Request::routeIs('admin.offer.edit') ? 'active' : '' }}">
            <i class="bi bi-circle me-2"></i> Update Offer Banner
          </a>
        </li>

        <!-- Store Features -->
        <li>
          <a href="{{ route('admin.feature.index') }}" class="nav-link {{ Request::routeIs('admin.feature.index') ? 'active' : '' }}">
            <i class="bi bi-circle me-2"></i> All Features
          </a>
        </li>

        <!-- Testimonials -->
        <li>
          <a href="{{ route('admin.testimonial.show') }}" class="nav-link {{ Request::routeIs('admin.testimonial.show') ? 'active' : '' }}">
            <i class="bi bi-circle me-2"></i> All Testimonials
          </a>
        </li>

      </ul>
    </li>




    <!-- About Page -->
<li class="nav-item has-treeview {{ Request::routeIs('admin.about.*') ? 'menu-open' : '' }} ">
  <a href="#" class="nav-link">
    <i class="bi bi-info-circle"></i>
    <p>About Page <i class="nav-arrow bi bi-chevron-right"></i></p>
  </a>

  <ul class="nav nav-treeview ps-3">
    <!-- Edit About Page -->
    <li>
    
      <a href="{{ route('admin.about.edit') }}" class="nav-link {{ Request::routeIs('admin.about.edit') ? 'active' : '' }} "> 
        <i class="bi bi-circle me-2"></i> Update About Banner
      </a>
    </li>
       <!-- Edit brand Page -->
    <li>

          <!-- Edit About Page -->
    <li>
    
      <a href="{{ route('admin.about.section.edit') }}" class="nav-link {{ Request::routeIs('admin.about.section.edit') ? 'active' : '' }} "> 
        <i class="bi bi-circle me-2"></i> About Section 
      </a>
    </li>
       <!-- Edit brand Page -->
    <li>

                <!-- Edit About Page -->
    <li>
    
      <a href="{{ route('admin.about.team.edit') }}" class="nav-link {{ Request::routeIs('admin.about.team.edit') ? 'active' : '' }} "> 
        <i class="bi bi-circle me-2"></i> About Team 
      </a>
    </li>
       <!-- Edit brand Page -->
    <li>
    
      <a href="{{ route('admin.about.brand') }}" class="nav-link {{ Request::routeIs('admin.about.brand') ? 'active' : '' }} "> 
        <i class="bi bi-circle me-2"></i> All Brand
      </a>
    </li>
        <li>
    
      <a href="{{ route('admin.about.customer.show') }}" class="nav-link {{ Request::routeIs('admin.about.customer.show') ? 'active' : '' }} "> 
        <i class="bi bi-circle me-2"></i> All Customer review
      </a>
    </li>
  </ul>
</li>



    <!-- Blog Page -->
    <li class="nav-item has-treeview {{ Request::routeIs('admin.blog.*') ? 'menu-open' : '' }}">
      <a href="#" class="nav-link">
        <i class="bi bi-journal-text"></i>
        <p>Blog Page <i class="nav-arrow bi bi-chevron-right"></i></p>
      </a>
      <ul class="nav nav-treeview ps-3">

        <!-- Blog Banner -->
        <li>
          <a href="{{ route('admin.blog.banner') }}" class="nav-link {{ Request::routeIs('admin.blog.banner') ? 'active' : '' }}">
            <i class="bi bi-circle me-2"></i> Update Blog Banner
          </a>
        </li>


        <!-- All Blogs -->
        <li>
          <a href="{{ route('admin.blog.index') }}" class="nav-link {{ Request::routeIs('admin.blog.index') ? 'active' : '' }}">
            <i class="bi bi-circle me-2"></i> All Blogs
          </a>
        </li>

      </ul>
    </li>

    <!-- Contact Page -->
<li class="nav-item has-treeview {{ Request::routeIs('admin.contact.*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link">
    <i class="bi bi-telephone"></i>
    <p>Contact Page <i class="nav-arrow bi bi-chevron-right"></i></p>
  </a>
  <ul class="nav nav-treeview ps-3">

    <!-- Contact Settings -->
    <li>
      <a href="{{ route('admin.contact.edit') }}" class="nav-link {{ Request::routeIs('admin.contact.edit') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> Update Contact Page
      </a>
    </li>

        <!-- Contact Settings -->
    <li>
      <a href="{{ route('admin.contact.index') }}" class="nav-link {{ Request::routeIs('admin.contact.index') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> All Contact
      </a>
    </li>

  </ul>
</li>


    <!-- FAQS Page -->
<li class="nav-item has-treeview {{ Request::routeIs('admin.faq.*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link">
    <i class="bi bi-question-circle"></i>
    <p>FAQS Page <i class="nav-arrow bi bi-chevron-right"></i></p>
  </a>
  <ul class="nav nav-treeview ps-3">

    <!-- FAQ Settings -->
    <li>
      <a href="{{ route('admin.faq.edit') }}" class="nav-link {{ Request::routeIs('admin.faq.edit') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> Update FAQ Banner
      </a>
    </li>


            <!-- FAQ Settings -->
    <li>
      <a href="{{ route('admin.faq.index') }}" class="nav-link {{ Request::routeIs('admin.faq.index') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> All FAQS
      </a>
    </li>

  </ul>
</li>


    <!-- FAQS Page -->
<li class="nav-item has-treeview {{ Request::routeIs('admin.term.*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link">
    <i class="bi bi-question-circle"></i>
    <p>TERMS Page <i class="nav-arrow bi bi-chevron-right"></i></p>
  </a>
  <ul class="nav nav-treeview ps-3">

    <!-- FAQ Settings -->
    <li>
      <a href="{{ route('admin.term.edit') }}" class="nav-link {{ Request::routeIs('admin.term.edit') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> Update Term Banner
      </a>
    </li>


            <!-- FAQ Settings -->
    <li>
      <a href="{{ route('admin.term.index') }}" class="nav-link {{ Request::routeIs('admin.term.index') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> Update Term
      </a>
    </li>

  </ul>
</li>


  </ul>
</li>


<!-- Product Management -->
<li class="nav-item has-treeview 
    {{ request()->routeIs([
        'admin.productbrand.index',
        'category.manage',
        'subcategory.manage',
        'childcategory.manage',
        'admin.show.product',
        'admin.products.index'
    ]) ? 'menu-open' : '' }}">

  <a href="#" class="nav-link">
    <i class="bi bi-box-seam"></i>
    <p>Product Management<i class="nav-arrow bi bi-chevron-right"></i></p>
  </a>

  <ul class="nav nav-treeview ps-3">

    <!-- Product Brands -->
    @can('products_brand')
    <li>
      <a href="{{ route('admin.productbrand.index') }}" 
         class="nav-link {{ request()->routeIs('admin.productbrand.index') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> Product Brands
      </a>
    </li>
    @endcan

    <!-- Categories -->
    @can('manage_category')
    <li>
      <a href="{{ route('category.manage') }}" 
         class="nav-link {{ request()->routeIs('category.manage') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> Categories
      </a>
    </li>
    @endcan

    <!-- Subcategories -->
    @can('manage_subcategory')
    <li>
      <a href="{{ route('subcategory.manage') }}" 
         class="nav-link {{ request()->routeIs('subcategory.manage') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> Sub Categories
      </a>
    </li>
    @endcan

    <!-- Child Categories -->
    <li>
      <a href="{{ route('childcategory.manage') }}" 
         class="nav-link {{ request()->routeIs('childcategory.manage') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> Child Categories
      </a>
    </li>

    <!-- All Products -->
    <li>
      <a href="{{ route('admin.show.product') }}" 
         class="nav-link {{ request()->routeIs('admin.show.product') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> All Products
      </a>
    </li>

    <!-- Vendor Products -->
    <li>
      <a href="{{ route('admin.products.index') }}" 
         class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i>All Vendor Products
      </a>
    </li>

  </ul>
</li>



<!-- Orders Management -->
<li class="nav-item has-treeview 
    {{ request()->routeIs([
        'admin.orders.index', 
        'admin.orders.pending', 
        'admin.orders.completed', 
        'admin.orders.cancelled'
    ]) ? 'menu-open' : '' }}">

  <a href="#" class="nav-link">
    <i class="bi bi-cart-check"></i>
    <p>Orders Management<i class="nav-arrow bi bi-chevron-right"></i></p>
  </a>

  <ul class="nav nav-treeview ps-3">

    <!-- All Orders -->
    <li>
      <a href="{{ route('admin.orders.index') }}" 
         class="nav-link {{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> All Orders
      </a>
    </li>

    <!-- Pending Orders -->
    <li>
      <a href="{{ route('admin.orders.pending') }}" 
         class="nav-link {{ request()->routeIs('admin.orders.pending') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> Pending Orders
      </a>
    </li>

    <!-- Completed Orders -->
    <li>
      <a href="{{ route('admin.orders.completed') }}" 
         class="nav-link {{ request()->routeIs('admin.orders.completed') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> Completed Orders
      </a>
    </li>

    <!-- Cancelled Orders -->
    <li>
      <a href="{{ route('admin.orders.cancelled') }}" 
         class="nav-link {{ request()->routeIs('admin.orders.cancelled') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> Cancelled Orders
      </a>
    </li>

  </ul>
</li>




<!-- Users Management -->
@can('user_mangement')
<li class="nav-item has-treeview {{ request()->routeIs('role.manage','user.manage','permission.index') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link">
    <i class="bi bi-people-fill"></i>
    <p>Users Management<i class="nav-arrow bi bi-chevron-right"></i></p>
  </a>
  <ul class="nav nav-treeview ps-3">
    <li>
      <a href="{{ route('role.manage') }}" class="nav-link {{ request()->routeIs('role.manage') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> All Roles
      </a>
    </li>
    <li>
      <a href="{{ route('user.manage') }}" class="nav-link {{ request()->routeIs('user.manage') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> All Users
      </a>
    </li>
    <li>
      <a href="{{ route('permission.index') }}" class="nav-link {{ request()->routeIs('permission.index') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> All Permissions
      </a>
    </li>
  </ul>
</li>
@endcan

<!-- Vendors -->
@can('vendors')
<li class="nav-item has-treeview {{ request()->routeIs('vendor.list','vendors.index') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link">
    <i class="bi bi-shop"></i>
    <p>Vendors<i class="nav-arrow bi bi-chevron-right"></i></p>
  </a>
  <ul class="nav nav-treeview ps-3">
    <li>
      <a href="{{ route('vendor.list') }}" class="nav-link {{ request()->routeIs('vendor.list') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> All Vendors
      </a>
    </li>
    <li>
      <a href="{{ route('vendors.index') }}" class="nav-link {{ request()->routeIs('vendors.index') ? 'active' : '' }}">
        <i class="bi bi-circle me-2"></i> All Stores
      </a>
    </li>
  </ul>
</li>
@endcan

<!-- Settings -->
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
