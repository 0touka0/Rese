<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Models\Reservation;
use Illuminate\Support\Facades\Gate;

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

Route::get( '/'        , [ShopController::class, 'index'])->name('index');
Route::get( '/search'	 , [ShopController::class, 'search'])->name('search');
Route::post('/register', [RegisterController::class, 'store']);
Route::get( '/thanks'	 , function () {
	if (Gate::allows('isAdmin')) {
		return redirect()->back()->with('message', '店舗代表者を作成しました。');
	}
	return view('thanks');
})->name('thanks');

Route::middleware('auth')->group(function () {
	Route::get( '/detail/{shop_id}', [ShopController::class, 'detail'])->name('detail');
	Route::post('/reservation'     , [ShopController::class, 'reservation'])->name('reservation');
	Route::post('/like/{shop_id}'  , [ShopController::class, 'like'])->name('like');
	Route::get( '/mypage/{user_id}', [ShopController::class, 'mypage'])->name('mypage');
	Route::get( '/softdelete/{reservation_id}', function ($reservation_id) {
		Reservation::find($reservation_id)->delete();
		return redirect()->back();
	});
	Route::put( '/reservation/{reservation_id}',[ShopController::class, 'update'])->name('reservation.update');
	Route::post('/rating', [ShopController::class, 'rating'])->name('rating');
});

Route::middleware(['auth', 'admin'])->group(function () {
	Route::get('/admin' , [AdminController::class, 'admin'])->name('admin');
	Route::get('/owners', [AdminController::class, 'owners'])->name('owners.confirm');
	Route::get('/mail'  , [AdminController::class, 'mail'])->name('mail.send');
});

Route::middleware(['auth', 'owner'])->group(function () {
	Route::get('/newshop', [OwnerController::class, 'newshop'])->name('newshop');
	Route::post('/newshop/store', [OwnerController::class, 'store']);
	Route::get('/shopsconfirm', [OwnerController::class, 'shopsConfirm'])->name('shops.confirm');
	Route::get('/shopedit', [OwnerController::class, 'shopEdit'])->name('shop.edit');
	});