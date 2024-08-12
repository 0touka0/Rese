<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Rating;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\ShopRequest;

class ShopController extends Controller
{
    // 店舗一覧ページ表示
    public function index()
    {
        $shops      = Shop::all();
        $ratings    = Rating::all();
        $likedShops = $this->getUserLikedShops($shops);

        return view('shop_all', compact('shops', 'ratings', 'likedShops'));
    }

    // 検索機能
    public function search(Request $request)
    {
        $shops = Shop::AddressSearch($request->address)
                     ->CategorySearch($request->category)
                     ->KeywordSearch($request->keyword)
                     ->get();
        $likedShops = $this->getUserLikedShops($shops);

        return view('shop_all', compact('shops', 'likedShops'));
    }

    // ユーザーのお気に入り店舗の情報取得
    private function getUserLikedShops($shops)
    {
        $user_id    = Auth::id();
        $likedShops = [];

        foreach ($shops as $shop) {
            $isLiked = Like::where('user_id', $user_id)
                           ->where('shop_id', $shop->id)
                           ->where('like', 1)
                           ->exists();
            $likedShops[$shop->id] = $isLiked;
        }

        return $likedShops;
    }

    // お気に入り登録
    public function like($shop_id)
    {
        $user_id      = Auth::id();
        $existingLike = Like::where('shop_id', $shop_id)
                            ->where('user_id', $user_id)
                            ->first();

        // likeカラムの更新or登録
        if ($existingLike) {
            if ($existingLike->like == 1) {
                $existingLike->like = 0;
                $existingLike->save();
                return redirect()->back();
            } else {
                $existingLike->like = 1;
                $existingLike->save();
                return redirect()->back();
            }
        } else {
            $like = new Like;
            $like->shop_id = $shop_id;
            $like->user_id = $user_id;
            $like->like = 1;
            $like->save();
            return redirect()->back();
        }
    }

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
        $shopId    = $request->input('shop_id');
        $ratingData = $request->only(['score', 'comment']);
        
        $existingRating = Rating::where('user_id' , $userId)
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

    // マイページ表示
    public function mypage($user_id)
    {
        $user = User::find($user_id);

        $reservations = $user->reservations()
                             ->whereNull('deleted_at')
                             ->orderBy('datetime', 'asc') //datetimeを昇順にソート
                             ->get();

        // 予約時間の分割
        foreach($reservations as $reservation) {
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
}
