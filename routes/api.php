<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductBrandController;
use App\Http\Controllers\Api\VendorProductController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\Home\ShopController;
use App\Http\Controllers\Api\Home\TestimonialController;
use App\Http\Controllers\Api\Home\OfferBannerController;
use App\Http\Controllers\Api\Home\StoreFeatureController;
use App\Http\Controllers\Api\Blog\BlogController;
use App\Http\Controllers\Api\Contact\ContactController;
use App\Http\Controllers\Api\About\AboutController;
use App\Http\Controllers\Api\About\CustomerReviewController;
use App\Http\Controllers\Api\About\AboutSectionController;
use App\Http\Controllers\Api\About\TeamController;
use App\Http\Controllers\Api\Faq\FaqController;
use App\Http\Controllers\Api\TermController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\User\UserOrderController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/categories', [CategoryController::class, 'store']);



Route::middleware('auth:sanctum')->group(function () {


    Route::get('/profile', [CustomerController::class, 'profile']);
    // Route::post('/profile/update', [CustomerController::class, 'update']);

    // account updated with change passsword //
    Route::post('/profile/update', [CustomerController::class, 'update']);
    

    Route::post('/checkout', [CheckoutController::class, 'checkout']);
    Route::post('/carts', [CheckoutController::class, 'carts']);
    Route::post('/payments', [PaymentController::class, 'storePayment']);

    Route::get('/user-orders', [UserOrderController::class, 'userOrders']);
    Route::get('/user-orders/{id}', [UserOrderController::class, 'userOrderDetails']);
    Route::delete('/user/order/{id}', [UserOrderController::class, 'deleteUserOrder']);

});

Route::post('/logout', [CustomerController::class, 'logout']);



Route::post('/register', [CustomerController::class, 'register']);
Route::post('/login', [CustomerController::class, 'login']);

// Start Home page //
Route::get('/sliders', [SliderController::class, 'index']);
Route::get('/shop/collections', [ShopController::class, 'ShopCollection']);//
Route::get('/testimonials', [TestimonialController::class, 'show']); //
Route::get('/offerbanner', [OfferBannerController::class, 'OfferBanner']);
Route::get('/storefeatures', [StoreFeatureController::class, 'show']);
Route::get('/settings', [SettingController::class, 'setting']);
// End Home Page //

// Start Blogs Sections //
Route::get('/blog-banner', [BlogController::class, 'banner']);
Route::get('/blogs', [BlogController::class, 'show']);
Route::get('/blogs/{id}', [BlogController::class,'view']);
// End Blogs Section //

// Start Contact Sections //
Route::get('/contact-banner', [ContactController::class, 'ContactBanner']);
Route::post('/contact', [ContactController::class, 'contact']);
// End Contact Sections //

// Start About Section //
Route::get('/about-banners', [AboutController::class, 'AboutBanner']);
Route::get('/about-brands', [AboutController::class, 'AboutBrand']);
Route::get('/about-review', [CustomerReviewController::class, 'customerReview']);
Route::get('about-section', [AboutSectionController::class, 'AboutSection']);
Route::get('/about-team', [TeamController::class, 'TeamMember']);

// End About Section //

//Start Faq Section //
Route::get('/faqs-banners', [FaqController::class, 'faqbanner']);
Route::get('/faqs', [FaqController::class, 'faq']);
// End Faq Section //

//Start Terms Section //
Route::get('/terms-banner', [TermController::class, 'termBanner']);
Route::get('/terms', [TermController::class, 'Term']);
//End Terms Section //


Route::get('/get-subcategories/{category_id}', [ApiController::class, 'getSubcategories']);
Route::get('/get-childcategories/{subcategory_id}', [ApiController::class, 'getChildcategories']);

Route::get('/categories', [CategoryController::class, 'category']);
Route::get('/subcategories', [CategoryController::class, 'subcategory']);
Route::get('/childcategories', [CategoryController::class, 'childcategory']);
Route::get('/products/brands', [ProductBrandController::class, 'ProductBrand']);


Route::get('/products/categories/{id}', [VendorProductController::class, 'categoryProducts']);
Route::get('/products/brand/{id}', [ProductBrandController::class, 'BrandsProducts']);
Route::get('/products', [VendorProductController::class, 'index']);
Route::get('/products/{id}', [VendorProductController::class, 'single']);
Route::get('/products/images/{id}', [VendorProductController::class, 'ProductImage']);
Route::get('/products/colors/{id}', [VendorProductController::class, 'ProductVariant']);

Route::get('/products/sizes/{id}', [VendorProductController::class, 'ProductVariantSize']);





