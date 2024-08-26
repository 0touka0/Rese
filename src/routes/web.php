<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Shop\DetailController;
use App\Http\Controllers\Shop\MypageController;
use App\Http\Controllers\Shop\ShopController;
use App\Models\Reservation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

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

Route::get( '/'        , [ShopController::class, 'index' ])->name('index');
Route::get( '/search'	 , [ShopController::class, 'search'])->name('search');

Route::post('/register', [RegisterController::class, 'store']);

Route::get( '/thanks'	 , function () {
	// 管理者の場合サンクスページの表示は不要
	if (Gate::allows('isAdmin')) {
		return redirect()->back()->with('message', '店舗代表者を作成しました。');
	}
	return view('auth.thanks')->with('message', '確認用のメールを送信しました。');
})->name('thanks');

Route::middleware('auth', 'role.email.check')->group(function () {
	Route::get( '/detail/{shop_id}', 						[DetailController::class, 'detail'			])->name('detail');
	Route::post('/reservation'     , 						[DetailController::class, 'reservation' ])->name('reservation');

	Route::post('/like/{shop_id}'  , 						[ShopController::class, 	'like'				])->name('like');

	Route::get( '/mypage/{user_id}', 						[MypageController::class, 'mypage'			])->name('mypage');
	Route::put( '/reservation/{reservation_id}',[MypageController::class, 'update'			])->name('reservation.update');
	Route::post('/rating', 											[MypageController::class, 'rating'			])->name('rating');

	Route::get( '/softdelete/{reservation_id}', function ($reservation_id) {
		Reservation::find($reservation_id)->delete();
		return redirect()->back();
	});
});

Route::middleware(['auth', 'admin'])->group(function () {
	Route::get( '/admin' 		, [AdminController::class, 'admin'	 ])->name('admin');
	Route::get( '/owners'		, [AdminController::class, 'owners'	 ])->name('owners.confirm');
	Route::get( '/mail'  		, [AdminController::class, 'mailForm'])->name('mail.create');
	Route::post('/mail/send', [AdminController::class, 'sendMail'])->name('sendMail');
});

Route::middleware(['auth', 'owner'])->group(function () {
	Route::get( '/newshop'						  , [OwnerController::class, 'newShop'		 ])->name('shop.create');
	Route::post('/newshop/store'			  , [OwnerController::class, 'store'			 ])->name('shop.store');
	Route::get( '/shopsconfirm'				  , [OwnerController::class, 'shopsConfirm'])->name('shops.confirm');
	Route::get( '/shopedit{shop_id}' 	  , [OwnerController::class, 'shopEdit'		 ])->name('shop.edit');
	Route::put( '/shopedit{shop_id}/put', [OwnerController::class, 'shopPut'		 ])->name('shop.put');
	Route::get( '/reservations'				  , [OwnerController::class, 'reservations'])->name('reservations');
	});