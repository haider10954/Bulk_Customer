<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// Admin Login
Route::get('/', function () {
    return view('admin.pages.login');
})->name('admin_login');

// Authentication
Route::controller(\App\Http\Controllers\admin\AuthController::class)->group(function () {
    Route::post('/bulk-login', 'login')->name('login_request');
    Route::get('/bulk-logout', 'logout')->name('auth_logout');
});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\UserController::class , 'index'])->name('index');

        //User
        Route::view('/user/create', 'admin.pages.users.create')->name('user_create');
        Route::post('/user-create', [\App\Http\Controllers\admin\UserController::class, 'add_user'])->name('user.create');
        Route::get('/user/edit/{id}', [\App\Http\Controllers\admin\UserController::class, 'edit_user_view'])->name('edit_user');
        Route::post('/user/edit', [\App\Http\Controllers\admin\UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/delete', [\App\Http\Controllers\admin\UserController::class, 'delete_user'])->name('delete.user');

        //Customer
        Route::get('/customers',[\App\Http\Controllers\admin\CustomerController::class , 'index'])->name('customer');
        Route::get('/create/customers',[\App\Http\Controllers\admin\CustomerController::class , 'create_customer_view'])->name('create.customer');
        Route::post('/customer-create', [\App\Http\Controllers\admin\CustomerController::class, 'add_customer'])->name('customer_create');
        Route::get('/customer/edit/{id}', [\App\Http\Controllers\admin\CustomerController::class, 'edit_customer_view'])->name('edit_customer');
        Route::post('/customer/edit', [\App\Http\Controllers\admin\CustomerController::class, 'edit'])->name('customer.edit');
        Route::post('/customer/delete', [\App\Http\Controllers\admin\CustomerController::class, 'delete_customer'])->name('delete.customer');

    });

});

Auth::routes();
