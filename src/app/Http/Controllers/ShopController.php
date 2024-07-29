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
        // 表示する店舗情報取得
        $shops = Shop::all();
        $shopTags = Shop::select('address', 'category')->get();

        $user_id = Auth::id();
        //インスタンスがないので配列を作成する
        $likedShops = [];

        // お気に入り登録されているか確認
        foreach($shops as $shop) {
            $isLiked = Like::where('user_id', $user_id)->where('shop_id', $shop->id)->where('like', 1)->exists();
            $likedShops[$shop->id] = $isLiked;
        }

        return view('shop_all', compact('shops', 'shopTags', 'likedShops'));
    }

    // 検索機能
    public function search(Request $request)
    {
        $shops = Shop::AddressSearch($request->address)
                    ->CategorySearch($request->category)
                    ->KeywordSearch($request->keyword)
                    ->get();
        $shopTags = Shop::select('address', 'category')->get();

        $user_id = Auth::id();
        //インスタンスがないので配列を作成する
        $likedShops = [];

        // お気に入り登録されているか確認
        foreach ($shops as $shop) {
            $isLiked = Like::where('user_id', $user_id)->where('shop_id', $shop->id)->where('like', 1)->exists();
            $likedShops[$shop->id] = $isLiked;
        }

        return view('shop_all', compact('shops', 'shopTags', 'likedShops'));
    }

    // 予約ページ表示
    public function detail($shop_id)
    {
        $user_id = Auth::id();
        $user = User::where('id', $user_id)->first();

        // 予約する店舗のデータを取得
        $shop = Shop::find($shop_id);

        return view('shop_detail', compact('shop', 'user'));
    }

    // 予約機能
    public function reservation(ShopRequest $request)
    {
        $reservation = $request->all();
        $datetime = $request->date . " " . $request->time;

        // 登録不要カラムを取り除く
        $reservationData = Arr::except($reservation, ['date', 'time']);
        // 統合したカラムを追加
        $reservationData['datetime'] = $datetime;

        Reservation::create($reservationData);

        return view('done');
    }

    // お気に入り登録
    public function like($shop_id)
    {
        $user_id = Auth::id();

        // 既にお気に入り登録されているか確認
        $existingLike = Like::where('shop_id', $shop_id)->where('user_id', $user_id)->first();

        if ($existingLike) {
            if ($existingLike->like == 1) {
                $existingLike->like = 0;
                $existingLike->save();
                return redirect()->back();// 状態を返すために後ほど変更
            } else {
                $existingLike->like = 1;
                $existingLike->save();
                return redirect()->back();// 状態を返すために後ほど変更
            }
        } else {
            $like = new Like;
            $like->shop_id = $shop_id;
            $like->user_id = $user_id;
            $like->like = 1;
            $like->save();
            return redirect()->back();// 状態を返すために後ほど変更
        }
    }

    // マイページ表示
    public function mypage($user_id)
    {
        $user = User::find($user_id);

        // 予約情報の取得
        $reservations = $user->reservations()->whereNull('deleted_at')->orderBy('datetime', 'asc')->get();

        // 予約時間の分割
        foreach($reservations as $reservation) {
            $reservation->reservation_date = Carbon::parse($reservation->datetime)->format('Y-m-d');
            $reservation->reservation_time = Carbon::parse($reservation->datetime)->format('H:i:s');
        }

        // お気に入りの取得
        $likes = $user->likes()->where('like', 1)->orderBy('updated_at', 'asc')->get();

        return view('mypage', compact('user', 'reservations', 'likes'));
    }

    // 予約更新
    public function update(Request $request, $reservation_id)
    {
        $reservation = $request->all();
        dd($reservation);
        $datetime = $request->date . " " . $request->time;

        // 登録不要カラムを取り除く
        $reservationData = Arr::except($reservation, ['date', 'time']);
        // 統合したカラムを追加
        $reservationData['datetime'] = $datetime;

        Reservation::find($reservation_id)->update($reservationData);

        return redirect()->back()->with('message', '予約を更新しました');
    }

    public function rating(Request $request)
    {
        $rating = $request->all();
        // dd($rating);

        Rating::create($rating);

        return redirect()->back()->with('message', '店舗評価を送信しました');
    }
}
