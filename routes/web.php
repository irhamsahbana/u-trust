<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SeriesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SeriesVarietyController;

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

Route::prefix('admin')->group(function () {
	Route::get('dashboard', [DashboardController::class, 'index']);
});

Route::prefix('admin/master-database')->group(function () {
	Route::get('series', [SeriesController::class, 'index'])->name('admin.series');
	Route::post('series', [SeriesController::class, 'store']);
	Route::put('series/{id}', [SeriesController::class, 'edit']);
	Route::delete('series/{id}', [SeriesController::class, 'destroy']);

	Route::resource('series-variety', SeriesVarietyController::class)->only([
		'index', 'store', 'update', 'destroy'
	]);
	// Route::resource('series-variety', '\App\Http\Controllers\Admin\SeriesVarietyController', ['names' => 'admin.series-variety']);
	Route::resource('product', ProductController::class);
	// Route::resource('product', '\App\Http\Controllers\Admin\ProductController', ['names' => 'admin.product']);

});
	