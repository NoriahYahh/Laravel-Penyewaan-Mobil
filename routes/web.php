<?php

use App\Http\Controllers\Admin\ItemController as AdminItemController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\DashboardController  as AdminDashboardController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
    Route::resource('items', AdminItemController::class);
    Route::resource('brands', AdminBrandController::class);
    Route::resource('types', AdminTypeController::class);
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('bookings', AdminBookingController::class);
});

Route::get('/admin', function () {
    //
})->middleware('admin');
