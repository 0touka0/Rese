<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Rating;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    // 店舗一覧ページ表示
    public function index(Request $request)
    {
        $sortType = $request->get('sort'); // ソートタイプを取得（指定がない場合はnull）

        $shops = Shop::query()
            ->with(['ratings', 'address', 'category']) // 必要なリレーションをロード
            ->withAvg('ratings', 'score') // 平均スコアを計算して取得
            ->when($sortType === 'random', function ($query) {
                // ランダムソート
                return $query->inRandomOrder();
            })
            ->when($sortType === 'high_rating', function ($query) {
                // 評価が高い順
                return $query->orderByRaw("CASE WHEN ratings_avg_score IS NULL THEN 1 ELSE 0 END")
                    ->orderByDesc('ratings_avg_score')
                    ->orderBy('id');;
            })
            ->when($sortType === 'low_rating', function ($query) {
                // 評価が低い順
                return $query->orderByRaw("CASE WHEN ratings_avg_score IS NULL THEN 1 ELSE 0 END")
                    ->orderBy('ratings_avg_score')
                    ->orderBy('id');;
            })
            ->when(is_null($sortType), function ($query) {
                // デフォルトの並び順
                return $query->orderBy('id');
            })
            ->get();

        $likedShops = $this->getUserLikedShops($shops);

        return view('shop_all', compact('shops', 'likedShops', 'sortType'));
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
}
