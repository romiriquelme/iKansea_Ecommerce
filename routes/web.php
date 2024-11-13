<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Frontend\IndexController;
use App\Models\User;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;

// Route::get('/', function () {
//     return view('welcome');
// });

// All Admin Routes

Route::middleware('admin:admin')->group(function(){
    Route::get('admin/login', [AdminController::class, 'loginForm']);
    Route::post('admin/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');

Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');

Route::post('/admin/profile/update', [AdminProfileController::class, 'adminProfileUpdate'])->name('admin.profile.update');


Route::get('/admin/change/password', [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');

Route::post('/admin/password/update', [AdminProfileController::class, 'adminUpdatePassword'])->name('admin.password.update');



Route::prefix('brand')->group(function(){

    Route::get('/view', [BrandController::class, 'viewBrand'])->name('all.brand');  

    Route::post('/store', [BrandController::class, 'brandStore'])->name('brand.store'); 
    
    Route::get('/edit/{id}', [BrandController::class, 'brandEdit'])->name('brand.edit'); 

    Route::post('/update', [BrandController::class, 'brandUpdate'])->name('brand.update'); 

    Route::get('/delete/{id}', [BrandController::class, 'brandDelete'])->name('brand.delete');
});


Route::prefix('category')->group(function(){

    Route::get('/view', [CategoryController::class, 'viewCategory'])->name('all.category');  

    Route::post('/store', [CategoryController::class, 'categoryStore'])->name('category.store'); 
    
    Route::get('/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('category.edit'); 

    Route::post('/update/{id}', [CategoryController::class, 'categoryUpdate'])->name('category.update'); 

    Route::get('/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('category.delete');
});





Route::middleware([
    'auth:sanctum,admin',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

// Route All Frontend

Route::middleware([
    'auth:sanctum,web', 'verified'
])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->name('dashboard');

    
Route::get('/', [IndexController::class, 'index']);
    
Route::get('/user/logout', [IndexController::class, 'userLogout'])->name('user.logout');

Route::get('/user/profile/edit', [IndexController::class, 'userProfileEdit'])->name('user.profile.edit');

Route::post('/user/profile/edit', [IndexController::class, 'userProfileUpdate'])->name('user.profile.update');

Route::get('/user/change/password', [IndexController::class, 'changePassword'])->name('change.password');

Route::post('/user/update/password', [IndexController::class, 'userUpdatePassword'])->name('user.update.password');


