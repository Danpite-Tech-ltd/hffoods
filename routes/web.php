<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\GoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/cc', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return "Cleared!";
});

Route::get('/', [WebviewController::class, 'mainview']);

// register otp
Route::post('/send-otp', [WebviewController::class, 'sendCustomerOtp'])->name('sendcustomer.otp');
Route::get('/otp-page', [WebviewController::class, 'customerOtpPage'])->name('customerotppage.otp');
Route::post('/verify-otp', [WebviewController::class, 'verifyCustomerOtp'])->name('verifycustomer.otp');
// forgot password
Route::get('/forgot', [WebviewController::class, 'forgotPage'])->name('forgot.page');
Route::post('/forgot-send-otp', [WebviewController::class, 'sendForgotOtp'])->name('forgot.send.otp');

Route::get('/forgot-verify', [WebviewController::class, 'verifyOtpPage'])->name('forgot.verify.page');
Route::post('/forgot-verify-otp', [WebviewController::class, 'verifyForgotOtp'])->name('forgot.verify.otp');
Route::post('/reset-password', [WebviewController::class, 'resetPassword'])->name('reset.password');

// web view
Route::get('/thebdshop-datafeed.csv', [WebviewController::class, 'datafeed'])->name('datafeed');
Route::get('ip-block', [CartController::class, 'ipblock']);
Route::get('empty-cart', [CartController::class, 'emptycart']);
Route::get('delivery/cities', [CartController::class, 'city']);
Route::get('delivery/zones', [CartController::class, 'zone']);

Route::get('lnpage/{slug}', [CartController::class, 'landingpage']);
Route::post('landing/order', [OrderController::class, 'landingorder']);

Route::get('exist-order', [CartController::class, 'existorder']);
Route::get('incomplete-order', [OrderController::class, 'incomplete']);

Route::get('/set-value/city/{id}', [StockController::class, 'getCityByCurier']);
Route::get('venture/{slug}', [WebviewController::class, 'index']);
Route::post('contact/post', [WebviewController::class, 'contact_post']);
Route::get('about-us',[WebviewController::class,'about']);
Route::get('video-gallery',[WebviewController::class,'video_gallery']);
Route::get('menu/{slug}', [WebviewController::class, 'menuindex']);
Route::get('view-product-load/{slug}', [WebviewController::class, 'productdetailsnew']);
Route::get('product/{slug}', [WebviewController::class, 'productdetails']);
Route::get('view-product/{slug}', [WebviewController::class, 'viewproductdetails'])->name('viewProduct');
Route::get('products/category/{slug}', [WebviewController::class, 'categoryproduct']);
Route::get('products/brand/{slug}', [WebviewController::class, 'brandproduct']);
Route::get('get/products/by-category', [WebviewController::class, 'getcategoryproduct']);
Route::get('get/products/by-subcategory', [WebviewController::class, 'getsubcategoryproduct']);
Route::get('products/sub/category/{slug}', [WebviewController::class, 'subcategoryproduct']);
Route::get('/search', [WebviewController::class, 'search'])->name('search');
Route::get('/live-search', [WebviewController::class, 'liveSearch'])->name('live-search');
Route::get('/combo-offer', [WebviewController::class, 'combo'])->name('combo');
Route::get('load/related-product', [WebviewController::class, 'loadrelatedpro']);

Route::get('quick-shop/{id}', [WebviewController::class, 'quick'])->name('quick');

// wishlist
Route::post('add-to-wishlist', [CartController::class, 'addtowishlist'])->name('wishlist.add');
Route::get('/wishlist', [CartController::class, 'wishlistPage'])->name('wishlist');
Route::get('/wishlist/remove/{id}', [CartController::class, 'removewishlist'])->name('wishlist.remove');

Route::get('category-info-ajax', [WebviewController::class, 'categoryinfoajax']);

Route::get('get/slug/products', [WebviewController::class, 'getslugproduct']);
Route::get('shop', [WebviewController::class, 'shop']);

Route::get('view/categories', [WebviewController::class, 'allcategories']);
Route::post('review/store', [WebviewController::class, 'review'])->name('review.store');
Route::get('load/review', [WebviewController::class, 'loadreview']);
Route::get('give/like', [WebviewController::class, 'givelike']);
Route::get('give/share', [WebviewController::class, 'giveshare']);
Route::get('replay/review', [WebviewController::class, 'repalyreview']);
Route::get('check-coupon', [WebviewController::class, 'couponcheck']);
Route::get('reset-coupon', [WebviewController::class, 'resetcoupon']);
Route::get('give/react/{slug}', [WebviewController::class, 'givereact']);
Route::get('blogs', [WebviewController::class, 'blogs']);
Route::get('multimedia', [WebviewController::class, 'rashi']);

// cart
Route::post('add-to-cart', [CartController::class, 'addtocart']);
Route::post('add-to-cart-new', [CartController::class, 'addtocartnew']);
Route::post('order-to-cart', [CartController::class, 'ordertocart']);
Route::get('get-cart-content', [CartController::class, 'getcartcontent']);
Route::post('remove-cart', [CartController::class, 'destroy']);
Route::get('update-cart', [CartController::class, 'cartcontent']);
Route::get('get-checkcart-content', [CartController::class, 'getcheckcartcontent']);
Route::get('cart', [CartController::class, 'cart']);
Route::get('checkout', [CartController::class, 'checkout']);
Route::get('order-received', [CartController::class, 'payment'])->name('payment.methood');
Route::get('order/complete', [CartController::class, 'complete']);
Route::post('/update-cart', [CartController::class, 'updatecart']);
Route::get('load-cart', [CartController::class, 'loadcart']);
Route::post('press/order', [OrderController::class, 'pressorder']);
Route::post('update/paymentmethood', [OrderController::class, 'updatepaymentmethood']);
Route::get('get-search-content', [WebviewController::class, 'searchcontent']);
Route::get('track-order', [WebviewController::class, 'orderTraking']);
Route::get('order-details/{slug}', [WebviewController::class, 'vieworder']);
Route::post('track-now', [WebviewController::class, 'orderTrakingNow']);

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('user/profile', [WebviewController::class, 'profile']);
    Route::post('update/profile', [WebviewController::class, 'updateprofile']);
    Route::get('user/purchase_history', [WebviewController::class, 'orderhistory']);
    Route::get('user/wallets', [WebviewController::class, 'wallets']);

    Route::put('/customer/profile-update', [WebviewController::class, 'profileUpdate'])
    ->name('customer.profile.update');
});


Route::get('auth/google', [GoogleController::class, 'signInwithGoogle']);
Route::get('callback/google', [GoogleController::class, 'callbackToGoogle']);

Route::get('user/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:web'])->name('dashboard');
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
Route::get('{slug}/products', [WebviewController::class, 'slugProduct']);
