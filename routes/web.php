<?php

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReportController;


// Route::get('/', function () {
//     return view('welcome');
// });





### All Admin Routes

Route::group(['prefix'=> 'admin', 'middleware' => ['admin:admin']], function(){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:admin'])->group(function(){
    ## Middleware for Admin
    Route::middleware([
        'auth:sanctum,admin',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/admin/admin_master', function () {
            return view('admin.dashboard');
        })->name('admin_dashboard');
    

    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
        
    Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
        
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
        
    Route::post('/admin/profile/update', [AdminProfileController::class, 'adminProfileUpdate'])->name('admin.profile.update');
        
        
    Route::get('/admin/change/password', [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');
        
    Route::post('/admin/password/update', [AdminProfileController::class, 'adminUpdatePassword'])->name('admin.password.update');

    });



    Route::prefix('admin')->group(function(){
        
        Route::prefix('category')->group(function(){
        
            Route::get('/view', [CategoryController::class, 'viewCategory'])->name('all.category');  
        
            Route::post('/store', [CategoryController::class, 'categoryStore'])->name('category.store'); 
            
            Route::get('/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit'); 
        
            Route::post('/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('category.update'); 
        
            Route::get('/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category.delete');
        
        
        
            ## Routes Sub Category Admin
        
            Route::get('/sub/view', [SubCategoryController::class, 'viewsubCategory'])->name('all.subcategory');  
        
            Route::post('/sub/store', [SubCategoryController::class, 'subCategoryStore'])->name('subcategory.store'); 
            
            Route::get('/sub/edit/{id}', [SubCategoryController::class, 'subCategoryEdit'])->name('subcategory.edit'); 
        
            Route::post('/sub/update/{id}', [SubCategoryController::class, 'subCategoryUpdate'])->name('subcategory.update'); 
        
            Route::get('/sub/delete/{id}', [SubCategoryController::class, 'subCategoryDelete'])->name('subcategory.delete');
        
        
        
        
            ## Routes Sub Sub Categories
        
            Route::get('/sub/sub/view', [SubCategoryController::class, 'subSubCategoryview'])->name('all.subsubcategory');  
        
        
            Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'getSubcategoryAjax']); 
            

            
            Route::get('/subsubcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'getSubSubcategoryAjax']);  
            
            Route::post('/sub/sub/store', [SubCategoryController::class, 'subSubcategoryStore'])->name('subsubcategory.store'); 
        
            Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'subSubCategoryEdit'])->name('subsubcategory.edit'); 
        
            Route::post('/sub/sub/update/{id}', [SubCategoryController::class, 'subSubcategoryUpdate'])->name('subsubcategory.update'); 
        
            Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'subSubCategoryDelete'])->name('subsubcategory.delete');
        });
        
        Route::prefix('product')->group(function(){
        
            Route::get('/addProduct', [ProductController::class, 'addProduct'])->name('add.product');  
        
            Route::get('/manage', [ProductController::class, 'manageProduct'])->name('manage.product');
        
            Route::post('/store', [ProductController::class, 'productStore'])->name('store.product');
        
            Route::get('/edit/{id}', [ProductController::class, 'productEdit'])->name('product.edit');
        
            Route::post('/update/data/{id}', [ProductController::class, 'updateDataProduct'])->name('product.data.update');
        
            Route::post('/update/images', [ProductController::class, 'updateDataImages'])->name('images.update');
        
            Route::post('/update/thumbnail/{id}', [ProductController::class, 'updateThumbnail'])->name('thumbnail.update');
        
            Route::get('/imgs/delete/{id}', [ProductController::class, 'imgsDelete'])->name('product.img.delete');
        
            Route::get('/active/{id}', [ProductController::class, 'productActive'])->name('product.active');
        
            Route::get('/inactive/{id}', [ProductController::class, 'productInactive'])->name('product.inactive');
        
            Route::get('/delete/{id}', [ProductController::class, 'productDelete'])->name('product.delete');
        });
        
        Route::prefix('slider')->group(function(){
        
            Route::get('/view', [SliderController::class, 'viewSlider'])->name('manage.slider');
        
            Route::post('/store', [SliderController::class, 'sliderStore'])->name('slider.store');
        
            Route::get('/edit/{id}', [SliderController::class, 'sliderEdit'])->name('slider.edit');
        
            Route::post('/update/{id}', [SliderController::class, 'sliderUpdate'])->name('slider.update');
        
            Route::get('/active/{id}', [SliderController::class, 'sliderActive'])->name('slider.active');
        
            Route::get('/inactive/{id}', [SliderController::class, 'sliderInactive'])->name('slider.inactive');
        
            Route::get('/delete/{id}', [SliderController::class, 'sliderDelete'])->name('slider.delete');
        
        });

        Route::prefix('coupon')->group(function(){
        
            Route::get('/view', [CouponController::class, 'viewCoupon'])->name('manage.coupon');

            Route::post('/store', [CouponController::class, 'storeCoupon'])->name('coupon.store');

            Route::get('/edit/{id}', [CouponController::class, 'editCoupon'])->name('coupon.edit');

            Route::post('/update/{id}', [CouponController::class, 'updateCoupon'])->name('coupon.update');

            Route::get('/delete/{id}', [CouponController::class, 'deleteCoupon'])->name('coupon.delete');
        
        });

        Route::prefix('shipping')->group(function(){
        
            Route::get('/view', [ShippingAreaController::class, 'viewShipping'])->name('manage.area');

            Route::post('/get-regency', [ShippingAreaController::class, 'getRegency'])->name('get.regency');

            Route::post('/get-district', [ShippingAreaController::class, 'getDistrict'])->name('get.district');

            Route::post('/get-village', [ShippingAreaController::class, 'getVillage'])->name('get.village');

            Route::post('/store', [ShippingAreaController::class, 'shippingStore'])->name('shipping.store');

            Route::get('/delete/{id}', [ShippingAreaController::class, 'deleteShipping'])->name('shipping.delete');

            Route::get('/edit/{id}', [ShippingAreaController::class, 'editShipping'])->name('shipping.edit');

            Route::post('/update/{id}', [ShippingAreaController::class, 'updateShipping'])->name('shipping.update');
 
    });


    Route::prefix('order')->group(function(){
        
        Route::get('/', [OrderController::class, 'ordersView'])->name('manage.order');

        Route::get('/detail/{id}', [OrderController::class, 'orderDetail'])->name('admin.detail.order');

        Route::get('/invoice/{id}', [OrderController::class, 'downloadInvoice'])->name('admin.invoice');

    });


    Route::prefix('reports')->group(function(){
        
        Route::get('/reports', [ReportController::class, 'reportView'])->name('admin.reports');

    });
    

});
// Route::middleware('admin:admin')->group(function(){
//     Route::get('admin/login', [AdminController::class, 'loginForm']);
//     Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');
// });








});

## Middleware for user
Route::middleware([
    'auth:sanctum,web', 'verified'
])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('frontend.index', compact('user'));
})->name('index');




// Route All Frontend




Route::get('/', [IndexController::class, 'index'])->name('index');
    
Route::get('/user/logout', [IndexController::class, 'userLogout'])->name('user.logout');

Route::get('/user/profile/edit', [IndexController::class, 'userProfileEdit'])->name('user.profile.edit');

Route::post('/user/profile/edit', [IndexController::class, 'userProfileUpdate'])->name('user.profile.update');

Route::get('/user/change/password', [IndexController::class, 'changePassword'])->name('change.password');

Route::post('/user/update/password', [IndexController::class, 'userUpdatePassword'])->name('user.update.password');

Route::get('/language/ind', [LanguageController::class, 'ind'])->name('language.ind');

Route::get('/language/en', [LanguageController::class, 'en'])->name('language.en');

Route::get('/detail/{id}/{slug}', [IndexController::class, 'detail']);

// routing get data ajax
Route::get('/product/view/modal/{id}', [IndexController::class, 'getProductModal']);

Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);

Route::get('/product/mini/cart', [CartController::class, 'addMiniCart']);

Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'removeMiniCart']);

Route::post('/add/wishlist/{id}', [CartController::class, 'addToWishlist']);

Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function(){

Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('wishlist');

Route::get('/whislist/data' , [WishlistController::class, 'getWishlist']);

Route::get('/remove/wishlist/{id}', [WishlistController::class, 'removeWishlist']);

Route::get('/my-order', [CheckoutController::class, 'myOrders' ])->name('my.order');

Route::get('/order-detail/{id}', [CheckoutController::class, 'OrderDetail' ])->name('order.detail');

Route::get('/invoice/{id}', [CheckoutController::class, 'downloadInvoice' ])->name('invoice');



});


Route::get('/mycart',[CartPageController::class, 'getMyCart'])->name('mycart');

Route::get('/mycart/data', [CartPageController::class, 'getCartData']);

Route::get('/mycart/increment/{rowId}', [CartPageController::class, 'increment']);

Route::get('/mycart/decrement/{rowId}', [CartPageController::class, 'decrement']);

Route::get('/mycart/remove/{rowId}', [CartPageController::class, 'removeCart']);






// route coupon

Route::post('/coupon-apply', [CartController::class, 'couponApply']);

Route::get('/coupon-calcuation', [CartController::class, 'couponCalculation']);

Route::get('/coupon-remove', [CartController::class, 'removeCoupon']);


// end of route coupon


// route checkout


Route::get('/checkout', [CartController::class, 'checkoutCreate'])->name('checkout');

Route::post('/checkout-detail', [CartController::class, 'checkoutDetail'])->name('checkout.detail');

Route::post('/checkout-store', [CartController::class, 'checkoutStore'])->name('checkout-store');



