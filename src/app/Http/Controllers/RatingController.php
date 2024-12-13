<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Models\Like;
use App\Models\Rating;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RatingController extends Controller
{
    // 店舗の評価ページ
    public function rating($shop_id)
    {
        $shop = Shop::find($shop_id);

        $user_id = Auth::id();
        $user = User::find($user_id);
        $likedShops = $this->getUserLikedShops($shop);

        $rating = Rating::where('shop_id', $shop_id)
        ->where('user_id', $user_id)
        ->first();

        return view('rating', compact('shop', 'likedShops', 'rating'));
    }

    // お気に入りチェック
    private function getUserLikedShops($shop)
    {
        $user_id    = Auth::id();
        $likedShops = [];

        $isLiked = Like::where('user_id', $user_id)
            ->where('shop_id', $shop->id)
            ->where('like', 1)
            ->exists();
        $likedShops[$shop->id] = $isLiked;

        return $likedShops;
    }

    // 店舗の評価作成
    public function ratingCreate(RatingRequest $request)
    {
        $userId     = Auth::id();
        $shopId     = $request->input('shop_id');
        $ratingData = $request->only(['score', 'comment']);

        // 画像の保存処理
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ratings', 'public'); // ratingsディレクトリに保存
            $ratingData['image'] = $imagePath; // 保存パスをデータに追加
        }

        Rating::create(array_merge($ratingData, ['user_id' => $userId, 'shop_id' => $shopId]));
        $message = '店舗評価を送信しました';

        return redirect()->back()->with('message', $message);
    }

    // 店舗の評価更新
    public function update(RatingRequest $request, $id)
    {
        $ratingData = $request->only(['score', 'comment']);

        // 画像の保存処理
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ratings', 'public'); // ratingsディレクトリに保存
            $ratingData['image'] = $imagePath; // 保存パスをデータに追加
        }

        $existingRating = Rating::findOrFail($id);
        $existingRating->update($ratingData);

        return redirect()->back()->with('message', '店舗評価を更新しました');
    }

    // 評価の削除機能
    public function remove($rating_id)
    {
        Rating::find($rating_id)->delete();

        return redirect()->back();
    }
}
