<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Models\Reservation;

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

Route::post('/register', [RegisterController::class, 'store']);
Route::get('/thanks', function () {
	return view('thanks');
})->name('thanks');

Route::middleware('auth')->group(function () {
	Route::get('/', [ShopController::class, 'index']);
	Route::get('/search', [ShopController::class, 'search']);
	Route::get('/detail/{shop_id}', [ShopController::class, 'detail']);
	Route::post('/reservation', [ShopController::class, 'reservation'])->name('reservation');
	Route::post('/like/{shop_id}', [ShopController::class, 'like']);
	Route::get('/mypage/{user_id}', [ShopController::class, 'mypage']);
	Route::get('/softdelete/{reservation_id}', function ($reservation_id) {
		Reservation::find($reservation_id)->delete();
		return redirect()->back();
	});
	Route::put('/reservation/{reservation_id}',[ShopController::class, 'update'])->name('reservation.update');
	Route::post('/rating', [ShopController::class, 'rating']);
});
