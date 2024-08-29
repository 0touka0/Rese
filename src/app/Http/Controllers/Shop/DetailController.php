<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ShopRequest;

class DetailController extends Controller
{
    // 店舗詳細、予約ページ表示
    public function detail($shop_id)
    {
        $user_id = Auth::id();
        $user    = User::where('id', $user_id)->first();
        $shop    = Shop::find($shop_id); // 予約する店舗のデータを取得

        return view('shop_detail', compact('shop', 'user'));
    }

    // 予約機能
    public function reservation(ShopRequest $request)
    {
        $reservation      = $request->all();
        $combinedDateTime = $request->date . " " . $request->time;

        $reservationData = Arr::except($reservation, ['date', 'time']); // 登録不要カラムを取り除く
        $reservationData['datetime'] = $combinedDateTime;

        Reservation::create($reservationData);

        return view('done');
    }

}
