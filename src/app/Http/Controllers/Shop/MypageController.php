<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\Http\Requests\ShopRequest;

class MypageController extends Controller
{
    // マイページ表示
    public function mypage($user_id)
    {
        $user = User::find($user_id);

        $reservations = $user->reservations()
            ->whereNull('deleted_at')
            ->orderBy('datetime', 'asc') //datetimeを昇順にソート
            ->get();

        // 予約時間の分割
        foreach ($reservations as $reservation) {
            $reservation->reservation_date =
                Carbon::parse($reservation->datetime)->format('Y-m-d');
            $reservation->reservation_time =
                Carbon::parse($reservation->datetime)->format('H:i:s');
        }

        $likes = $user->likes()->where('like', 1)
            ->orderBy('updated_at', 'asc')
            ->get();

        return view('mypage', compact('user', 'reservations', 'likes'));
    }

    // 予約更新
    public function update(ShopRequest $request, $reservation_id)
    {
        $reservation      = $request->all();
        $combinedDateTime = $request->date . " " . $request->time;

        $reservationData = Arr::except($reservation, ['date', 'time']); // 登録不要カラムを取り除く
        $reservationData['datetime'] = $combinedDateTime;

        Reservation::find($reservation_id)->update($reservationData);

        return redirect()->back()->with('message', '予約を更新しました');
    }

    // 店舗の評価作成or更新
    public function rating(Request $request)
    {
        $userId     = $request->input('user_id');
        $shopId     = $request->input('shop_id');
        $ratingData = $request->only(['score', 'comment']);

        $existingRating = Rating::where('user_id', $userId)
        ->where('shop_id', $shopId)
        ->first();

        if ($existingRating) {
            $existingRating->update($ratingData);
            $message = '店舗評価を更新しました';
        } else {
            Rating::create(array_merge($ratingData, ['user_id' => $userId, 'shop_id' => $shopId]));
            $message = '店舗評価を送信しました';
        }

        return redirect()->back()->with('message', $message);
    }
}
