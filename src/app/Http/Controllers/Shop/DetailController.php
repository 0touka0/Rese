<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Mail\ReservationCompleted;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ShopRequest;
use App\Models\Rating;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DetailController extends Controller
{
    // 店舗詳細、予約ページ表示
    public function detail($shop_id)
    {
        $user_id = Auth::id();
        $user    = User::where('id', $user_id)->first();
        $shop    = Shop::find($shop_id); // 予約する店舗のデータを取得
        $ratings = Rating::where('shop_id', $shop_id)->get();

        $existingRating = Rating::where('user_id', $user_id)
            ->where('shop_id', $shop_id)
            ->first();

        // 判定結果をビューに渡す
        $isRated = $existingRating == null;

        return view('shop_detail', compact('shop', 'user', 'ratings', 'isRated'));
    }

    // 予約機能
    public function reservation(ShopRequest $request)
    {
        $reservation      = $request->all();
        $combinedDateTime = $request->date . " " . $request->time;

        $reservationData = Arr::except($reservation, ['date', 'time']); // 登録不要カラムを取り除く
        $reservationData['datetime'] = $combinedDateTime;

        $newReservation = Reservation::create($reservationData);

        // QRコードの生成
        $qrCode = QrCode::format('png')
            ->size(300)
            ->generate(route('mypage', ['user_id' => $newReservation->user_id]));

        // メールの送信
        Mail::to($newReservation->user->email)->send(new ReservationCompleted($newReservation, $qrCode));

        return view('done');
    }
}
