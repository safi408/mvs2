<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ProductBrandController;
use App\Http\Controllers\Vendor\VendorDashboardController;
use App\Http\Controllers\Admin\VenderStoreController;
use App\Http\Controllers\Vendor\VendorProductController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\Home\ShopCollectionController;
use App\Http\Controllers\Admin\Home\TestimonialController;
use App\Http\Controllers\Admin\Home\OfferBannerController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\Home\StoreFeatureController;
use App\Http\Controllers\Admin\Blog\BlogController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\About\AboutController;
use App\Http\Controllers\Admin\About\CustomerReviewController;
use App\Http\Controllers\Admin\AboutSectionController;
use App\Http\Controllers\Admin\About\TeamController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\TermController;
use App\Http\Controllers\Admin\Order\OrderController;




use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     if (Auth::check()) {
//         // Agar user already login hai, to dashboard par redirect karo
//         return redirect()->route('dashboard');
//     }

//     // Agar login nahi hai, to login page dikhao
//     return view('auth.login');
// });


// Route::get('/', function () {
//     return view('welcome');
// });





Route::get('/', function () {
   return view('auth.login');
});


Route::middleware(['auth'])->group(function() {
      Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.dashboard');
});


Route::prefix('admin')->middleware(['auth','role:admin'])->group(function() {
 
   Route::get('-profile', [DashboardController::class,  'profile'])->name('admin.profile');
    Route::post('/update-profile', [DashboardController::class, 'update'])->name('admin.profile.update');
    Route::get('/change-password', [DashboardController::class, 'change'])->name('admin.change');
    Route::post('/update/password', [DashboardController::class, 'updatePassword'])->name('admin.password.update');




});



Route::middleware(['auth'])->group(function() {
  Route::get('/profile', [DefaultController::class,'profile'])->name('default.profile');
Route::put('/profile/update', [DefaultController::class, 'update'])->name('profile.update');
});


Route::prefix('admin')->middleware(['auth'])->group(function (){

    Route::get('/settings', [SettingController::class, 'setting'])->name('settings')->middleware(['permission:settings']);
    Route::post('/settings/update', [SettingController::class, 'store'])->name('admin.setting.store');


  // banner section //

  Route::prefix('banners')->group(function() {
      Route::get('/banner/create', [BannerController::class, 'create'])->name('banner.create');
      Route::post('/banners/store', [BannerController::class, 'store'])->name('store.banner');
      Route::get('/banner/show', [BannerController::class, 'index'])->name('banner.index');
      Route::delete('/banners/{id}', [BannerController::class, 'destroy'])->name('delete.banner');
      Route::get('/banner/edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
      Route::put('/banners/{id}/update', [BannerController::class, 'update'])->name('admin.update.banner');
      Route::put('/banners/{id}/toggle', [BannerController::class, 'toggleStatus'])->name('admin.toggle.banner');

  });


  Route::prefix('shops')->group(function() {
      Route::get('/shop/create', [ShopCollectionController::class, 'create'])->name('admin.shop.collection');
      Route::post('/shop/store', [ShopCollectionController::class, 'store'])->name('admin.shop.store');
      Route::get('shop/show', [ShopCollectionController::class, 'show'])->name('admin.shop.show');
      Route::delete('/shop/{id}', [ShopCollectionController::class, 'delete'])->name('admin.delete.shop');
      Route::get('/shop/edit/{id}', [ShopCollectionController::class, 'edit'])->name('admin.edit.shop');
      Route::post('/shop/update/{id}', [ShopCollectionController::class, 'update'])->name('admin.update.shop');
  });


  Route::prefix('stores')->group(function() {
     Route::get('/create', [StoreFeatureController::class, 'create'])->name('admin.feature.create');
     Route::post('/store', [StoreFeatureController::class, 'store'])->name('admin.feature.store');
     Route::get('/show', [StoreFeatureController::class, 'show'])->name('admin.feature.index');
     Route::delete('/delete{id}', [StoreFeatureController::class, 'delete'])->name('delete.feature');
     Route::get('/edit/{id}', [StoreFeatureController::class, 'edit'])->name('feature.edit');
     Route::post('/update/{id}', [StoreFeatureController::class, 'update'])->name('admin.feature.update');
  });


  Route::prefix('testimonials')->group(function() {
        Route::get('/testimonial/create', [TestimonialController::class,'create'])->name('admin.testimonial.create');
        Route::post('/testimonial/store', [TestimonialController::class,'store'])->name('admin.testimonial.store');
        Route::get('/testimonial/show', [TestimonialController::class, 'show'])->name('admin.testimonial.show');
        Route::delete('/admin/testimonial/{id}', [TestimonialController::class, 'destroy'])->name('admin.testimonial.destroy');
        Route::get('/testimonial/{id}/edit', [TestimonialController::class, 'edit'])->name('admin.testimonial.edit');
        Route::put('/testimonial/{id}/update', [TestimonialController::class, 'update'])->name('admin.testimonial.update');
  });


  Route::prefix('offers')->group(function() {
      Route::get('/offer', [OfferBannerController::class, 'edit'])->name('admin.offer.edit');
      Route::get('/offer/view', [OfferBannerController::class, 'show'])->name('admin.offer.view');
      Route::post('/offer/update', [OfferBannerController::class, 'update'])->name('admin.offer.update');
  });


  //  Start Blogs Sections //

  Route::prefix('blogs')->group(function() {
    Route::get('/blog/banner', [BlogController::class, 'banner'])->name('admin.blog.banner');
    Route::put('/blog/update', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('/blog/store', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/blog/manage,', [BlogController::class, 'show'])->name('admin.blog.index');
    Route::get('/blog/{id}', [BlogController::class, 'view'])->name('admin.view.blog');
    Route::delete('/blog/{id}', [BlogController::class, 'delete'])->name('admin.blog.delete');
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('admin.edit.blog');
    Route::put('blog/update/{id}', [BlogController::class, 'addupdate'])->name('admin.update.blog');
  });
 
  // End Blogs Sections //


  // Start About Section //
  Route::prefix('abouts')->group(function() {
     Route::get('/edit/banner', [AboutController::class, 'edit'])->name('admin.about.edit');
     Route::put('banner/update', [AboutController::class, 'update'])->name('admin.about.update');
     Route::get('/brand/create', [AboutController::class, 'create'])->name('admin.about.create');
     Route::post('/brand/store', [AboutController::class, 'store'])->name('admin.brand.store');
     Route::get('/brands', [AboutController::class, 'brand'])->name('admin.about.brand');
     Route::get('/brands/{id}', [AboutController::class, 'editBrand'])->name('brands.edit');
     Route::delete('brands/{id}', [AboutController::class, 'destroy'])->name('brands.destroy');
     Route::post('/brands/update/{id}', [AboutController::class, 'updateBrand'])->name('admin.brand.update');
     Route::get('customer/review/create', [CustomerReviewController::class, 'create'])->name('admin.about.customer.review');
     Route::get('customer/review/show', [CustomerReviewController::class, 'show'])->name('admin.about.customer.show');
     Route::post('/customer/store', [CustomerReviewController::class, 'store'])->name('store'); 
     Route::get('/customer/edit/{id}', [CustomerReviewController::class, 'edit'])->name('reviews.edit');
     Route::delete('/customer/delete/{id}', [CustomerReviewController::class, 'destroy'])->name('reviews.destroy');
     Route::put('/customer/update/{id}', [CustomerReviewController::class, 'update'])->name('reviews.update');
     Route::get('/sections', [AboutSectionController::class, 'AboutSection'])->name('admin.about.section.edit');
     Route::put('/sections/update', [AboutSectionController::class, 'update'])->name('admin.about.section.update');
     Route::get('/teams', [TeamController::class, 'AboutTeam'])->name('admin.about.team.edit');
     Route::put('/teams/update', [TeamController::class, 'update'])->name('admin.team.update');
  });
  // End About Section //

  // Start FAQS Section //
  Route::prefix('faqs')->group(function() {
     Route::get('/edit', [FaqController::class, 'edit'])->name('admin.faq.edit');
     Route::get('/faq/create', [FaqController::class, 'create'])->name('admin.faq.create');
     Route::post('/faq/store', [FaqController::class, 'store'])->name('admin.faq.store');
     Route::get('/faq/show', [FaqController::class, 'show'])->name('admin.faq.index');
      Route::delete('/faq/delete/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');
      Route::get('/faqs/edit/{id}', [FaqController::class, 'edit2'])->name('admin.faq.edit2');
      Route::post('/faq/update2/{id}', [FaqController::class, 'update2'])->name('admin.faq.update2');
     Route::put('/banner/update', [FaqController::class, 'update'])->name('admin.faq.banner.update');
     Route::post('/faq/update', [FaqController::class, 'updatefaq'])->name('admin.faq.update');
  });

  // End FAQS Section //

  // Start TERMS Section //
Route::prefix('terms')->group(function() {
  Route::get('/edit', [TermController::class, 'edit'])->name('admin.term.edit');
  Route::get('term', [TermController::class, 'terms'])->name('admin.term.index');
  Route::put('banner/update', [TermController::class, 'update'])->name('admin.term.update');
  Route::post('term/update', [TermController::class, 'Addterm'])->name('term.update');
});

  // End TERMS Setion //


    // roles heere //
    Route::prefix('roles')->middleware(['permission:user_mangement'])->group(function (){
    Route::get('/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/manage', [RoleController::class, 'index'])->name('role.manage');
    Route::delete('/roles/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
    Route::get('/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('/{id}', [RoleController::class, 'update'])->name('roles.update.role');
    });

    Route::prefix('contacts')->group(function() {
       Route::get('/edit', [ContactController::class, 'edit'])->name('admin.contact.edit');
        Route::put('/update', [ContactController::class, 'update'])->name('admin.contact.update');
        Route::get('/show', [ContactController::class, 'show'])->name('admin.contact.index');
        Route::delete('/admin/contact/{id}/delete', [ContactController::class, 'destroy'])->name('admin.contact.delete');
    });

    // permissions here //

    Route::prefix('permissions')->middleware(['permission:user_mangement'])->group(function () {
       Route::get('/create', [PermissionController::class, 'create'])->name('permission.create');
       Route::post('/store', [PermissionController::class, 'store'])->name('permission.store');
       Route::get('/show', [PermissionController::class, 'index'])->name('permission.index');
       Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
       Route::put('/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
       Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    });

    // Grands Permission //

    Route::prefix('grandpermission')->middleware(['permission:user_mangement'])->group(function () {
          // Show assign permissions form
    Route::get('/roles/{id}/grant', [RolePermissionController::class, 'grant'])->name('roles.grant');

    // Update permissions
    Route::post('/roles/{id}/update-permissions', [RolePermissionController::class, 'update'])->name('roles.updatePermissions');
    });


    // users here //
    Route::prefix('users')->middleware(['permission:user_mangement'])->group(function (){
         Route::get('/create', [UserController::class,'create'])->name('user.create');
         Route::post('/store', [UserController::class,  'store'])->name('user.store'); 
         Route::get('/manage', [UserController::class, 'index'])->name('user.manage');
         Route::get('/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');  
    });

    // Categories here //
    Route::prefix('categories')->middleware(['permission:manage_category'])->group(function (){
       Route::get('/create', [CategoryController::class, 'category'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
       Route::get('/show', [CategoryController::class, 'index'])->name('category.manage');
       Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
       Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
      Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
    });


    // Product Brands //

    Route::prefix('brands')->middleware(['permission:products_brand'])->group(function() {
       Route::get('/create', [ProductBrandController::class ,'create'])->name('admin.productbrand.create');
       Route::post('/store', [ProductBrandController::class, 'store'])->name('admin.productbrand.store');
       Route::get('/show', [ProductBrandController::class, 'show'])->name('admin.productbrand.index');
       Route::get('/edit/{id}', [ProductBrandController::class, 'edit'])->name('admin.productbrand.edit');
       Route::post('/update/{id}', [ProductBrandController::class, 'update'])->name('admin.productbrand.update');
       Route::delete('/delete/{id}', [ProductBrandController::class, 'destroy'])->name('admin.productbrand.delete');
    });


    // subcategories here //
    Route::prefix('subcategories')->middleware(['permission:manage_subcategory'])->group(function() {
    Route::get('/create',[SubCategoryController::class, 'subcategory'])->name('subcategory.create');
    Route::get('/show', [SubCategoryController::class, 'index'])->name('subcategory.manage');
    Route::post('/store', [SubCategoryController::class, 'store'])->name('subcategories.store');
    Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
    Route::post('/update/{id}', [SubCategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('/delete/{id}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');
    });

    Route::prefix('childcategories')->middleware('permission:child_category')->group(function() {
       Route::get('/create', [ChildCategoryController::class, 'create'])->name('childcategory.create');
       Route::post('/store', [ChildCategoryController::class, 'store'])->name('childcategory.store');
       Route::get('/show', [ChildCategoryController::class, 'show'])->name('childcategory.manage');
       Route::delete('/delete/{id}', [ChildCategoryController::class, 'destroy'])->name('childcategory.destroy');
       Route::get('/edit/{id}', [ChildCategoryController::class, 'edit'])->name('childcategory.edit');
       Route::post('/update/{id}', [ChildCategoryController::class, 'update'])->name('childcategory.update');
    });


    // Products here //
    Route::prefix('products')->middleware(['permission:admin_products'])->group(function() {
      Route::get('/create', [AdminProductController::class, 'create'])->name('admin.create.product');
      Route::post('/store', [AdminProductController::class, 'store'])->name('admin.product.store');
      Route::get('/show', [AdminProductController::class, 'show'])->name('admin.show.product');
      Route::delete('/{product}', [AdminProductController::class, 'destroy'])->name('product.destroy');
      Route::get('/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
      Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');      
    });

    
   
    Route::prefix('orders')->group(function () { 
      Route::get('/show', [OrderController::class, 'index'])->name('admin.orders.index');
      Route::get('/pending', [OrderController::class, 'pending'])->name('admin.orders.pending');
      Route::get('/completed', [OrderController::class, 'completed'])->name('admin.orders.completed');
       Route::get('/cancelled', [OrderController::class, 'cancelled'])->name('admin.orders.cancelled');
       Route::get('-{id}', [OrderController::class, 'show'])->name('admin.orders.show');

       });





    // vendors Store here //
    Route::prefix('vendors')->middleware(['permission:vendors'])->group(function() {
       Route::get('/vendor/list', [VenderStoreController::class, 'vendor'])->name('vendor.list')->middleware(['permission:admin_products']);
       Route::get('/vendor/store/{id}', [VenderStoreController::class, 'create'])->name('vendor.create')->middleware(['permission:admin_products']);
       Route::post('/vendor/store', [VenderStoreController::class, 'store'])->name('vendor.store')->middleware(['permission:admin_products']);
       Route::get('/vendor/show', [VenderStoreController::class, 'index'])->name('vendors.index')->middleware(['permission:admin_products']);
       // Edit Vendor Form
      Route::get('/{id}', [VenderStoreController::class, 'edit'])->name('vendor.edit')->middleware(['permission:admin_products']);

      Route::post('/vendor/{id}/update', [VenderStoreController::class, 'update'])->name('vendor.update')->middleware(['permission:admin_products']);

      Route::delete('/vendor/{id}', [VenderStoreController::class, 'destroy'])->name('vendor.destroy')->middleware(['permission:admin_products']);
      Route::get('/vendor/{id}', [VenderStoreController::class, 'show'])->name('vender.view')->middleware(['permission:admin_products']);
      Route::get('/vendor/{id}/status/{status}', [VenderStoreController::class, 'updateStatus'])
      ->name('admin.vendor.status')->middleware(['permission:admin_products']);

    Route::get('/allvendors/show', [VenderStoreController::class, 'vendorProduct'])->name('admin.products.index')->middleware(['permission:admin_products']);
    Route::post('/products/{id}/approve', [VenderStoreController::class, 'approve'])->name('admin.products.approve')->middleware(['permission:admin_products']);
    Route::post('/products/{id}/reject', [VenderStoreController::class, 'reject'])->name('admin.products.reject')->middleware(['permission:admin_products']);

    });


});






Route::prefix('customers')->middleware(['auth','role:customer'])->group(function () {
   Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
   Route::get('/profile', [UserDashboardController::class,  'profile'])->name('user.profile');
   Route::post('/user/profile', [UserDashboardController::class, 'update'])->name('user.profile.update');
   Route::get('/orders', [UserDashboardController::class, 'order'])->name('user.order');
   Route::get('/orders/{id}', [UserDashboardController::class, 'show'])->name('orders.show');
});

Route::prefix('vendors')->middleware(['auth','role:vendor'])->group(function() {

   Route::get('/dashboard',[VendorDashboardController::class, 'dashboard'])->name('vendor.dashboard')->middleware(['permission:vendor_dashboard']);
    Route::get('/vendor/create-store', [VendorDashboardController::class, 'myStore'])->name('vendor.createStore');
    Route::post('/create-store', [VendorDashboardController::class, 'createStore'])->name('createStore');
   Route::get('/my-store', [VendorDashboardController::class, 'myStore'])->name('vendor.store.view')->middleware(['permission:vendor_store']);
   Route::get('/profile', [VendorDashboardController::class, 'profile'])->name('vendor.profile');
   Route::post('/profile/update', [VendorDashboardController::class, 'update'])->name('vendor.profile.update');

   Route::prefix('products')->group(function() {
       Route::get('/create', [VendorProductController::class, 'create'])->name('vendor.product')->middleware(['permission:vendors_product']);
       Route::post('/vendor/store', [VendorProductController::class, 'store'])->name('vendor.products.store');
       Route::get('products', [VendorProductController::class, 'index'])->name('vendor.products.index');
      Route::delete('/vendor/products/{id}', [VendorProductController::class, 'destroy'])->name('vendor.products.destroy');

   });



});


Auth::routes();


