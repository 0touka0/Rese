<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    // 店舗一覧ページ表示
    public function index(Request $request)
    {
        // 検索条件とソート条件を取得
        $filters = [
            'address' => $request->query('address', null),
            'category' => $request->query('category', null),
            'keyword' => $request->query('keyword', null),
        ];
        $sortType = $request->query('sort', null);

        // 検索処理
        $searchShops = $this->searchShops($filters);

        // ソート処理
        $shops = $this->sortShops($searchShops, $sortType);

        $likedShops = $this->getUserLikedShops($shops);

        return view('shop_all', compact('shops', 'likedShops', 'sortType'));
    }

    // 検索機能
    private function searchShops(array $filters)
    {
        return Shop::query()
            ->withAvg('ratings', 'score')
            ->AddressSearch($filters['address'])
            ->CategorySearch($filters['category'])
            ->KeywordSearch($filters['keyword'])
            ->get();
    }

    // ソート機能
    private function sortShops($shops, ?string $sortType)
    {
        if ($sortType === 'random') {
            return $shops->shuffle();
        }

        if ($sortType === 'high_rating') {
            return $shops->sortByDesc(function ($shop) {
                return $shop->ratings_avg_score ?? 0; // 評価が高い順
            });
        }

        if ($sortType === 'low_rating') {
            return $shops->sortBy(function ($shop) {
                return $shop->ratings_avg_score ?? PHP_INT_MAX; // 評価が低い順
            });
        }

        return $shops;
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
