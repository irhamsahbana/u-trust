<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SeriesController;

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
	Route::get('master-database/series', [SeriesController::class, 'index'])->name('admin.series');
	Route::post('master-database/series', [SeriesController::class, 'store']);
	Route::put('master-database/{id}/series', [SeriesController::class, 'edit']);
	Route::delete('master-database/series/{id}', [SeriesController::class, 'destroy']);

});





// Route::group(
// 	['namespace' => 'Admin', 'prefix' => 'admin'],
// 	function(){
// 		Route::get('/dashboard', 'DashboardController@index');
// 	}
// );

// Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);