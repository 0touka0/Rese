<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\OwnerCreateController;
use App\Http\Controllers\Admin\OwnersConfirmController;
use App\Http\Controllers\Admin\MailSenderController;
use App\Http\Controllers\Owner\NewShopController;
use App\Http\Controllers\Owner\ShopConfirmController;
use App\Http\Controllers\Owner\ShopEditController;
use App\Http\Controllers\Owner\ShopReservationController;
use App\Http\Controllers\RatingController;
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

Route::get( '/', [ShopController::class, 'index'])->name('index');
Route::get( '/search', [ShopController::class, 'search'])->name('search');

Route::post('/register', [RegisterController::class, 'store']);

Route::get( '/thanks', function () {
	// 管理者の場合サンクスページの表示は不要
	if (Gate::allows('isAdmin')) {
		return redirect()->back()->with('message', '店舗代表者を作成');
	}
	return view('auth.thanks')->with('message', '確認用のメールを送信しました。');
})->name('thanks');

// 利用者ルート
Route::middleware('auth', 'role.email.check')->group(function () {
	Route::post('/like/{shop_id}', [ShopController::class, 'like'])->name('like');

	Route::get('/detail/{shop_id}', [DetailController::class, 'detail'])->name('detail');
	Route::post('/reservation', [DetailController::class, 'reservation'])->name('reservation');

	Route::get('/mypage/{user_id}', [MypageController::class, 'mypage'])->name('mypage');
	Route::put('/reservation/{reservation_id}', [MypageController::class, 'update'])->name('reservation.update');

	Route::get('/rating/{shop_id}', [RatingController::class, 'rating'])->name('rating');
	Route::post('/ratingCreate', [RatingController::class, 'ratingCreate'])->name('rating.create');
	Route::put('/ratingCreate/{id}', [RatingController::class, 'update']);

	Route::delete('/delete/{rating_id}', [RatingController::class, 'remove']);

	Route::get('/softdelete/{reservation_id}', function ($reservation_id) {
		Reservation::find($reservation_id)->delete();
		return redirect()->back();
	});
});

// 管理者ルート
Route::middleware(['auth', 'admin'])->group(function () {
	Route::get('/ownerCreate', [OwnerCreateController::class, 'ownerCreate'])->name('owner.create');

	Route::get('/owners', [OwnersConfirmController::class, 'ownersConfirm'])->name('owners.confirm');

	Route::get('/mail', [MailSenderController::class, 'mailForm'])->name('mail.create');
	Route::post('/mail/send', [MailSenderController::class, 'sendMail'])->name('mail.send');
});

// 店舗代表者ルート
Route::middleware(['auth', 'owner'])->group(function () {
	Route::get('/shopCreate', [NewShopController::class, 'shopCreate'])->name('shop.create');
	Route::post('/newShop/store', [NewShopController::class, 'store'])->name('shop.store');

	Route::get('/shopsConfirm', [ShopConfirmController::class, 'shopsConfirm'])->name('shops.confirm');

	Route::get('/shopEdit/{shop_id}', [ShopEditController::class, 'shopEdit'])->name('shop.edit');
	Route::put('/shopEdit/{shop_id}/put', [ShopEditController::class, 'shopPut'])->name('shop.put');

	Route::get('/reservations', [ShopReservationController::class, 'reservations'])->name('reservations');
	});