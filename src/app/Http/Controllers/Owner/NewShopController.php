<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopRequest;
use App\Models\Address;
use App\Models\Category;
use App\Models\Shop;
use Illuminate\Support\Facades\Storage;

class NewShopController extends Controller
{
    // 店舗作成ページ
    public function shopCreate()
    {
        return view('owner/shop_create');
    }

    // 店舗作成機能
    public function store(ShopRequest $request)
    {
        // Categoryを作成または取得(既に存在している場合)し、category_idを取得する
        $createdCategory = Category::firstOrCreate([
            'category' => $request->input('category')
        ]);
        $createdAddress = Address::firstOrCreate([
            'address' => $request->input('address'),
        ]);

        try {
            // ファイルの取得とアップロード
            $image = $request->file('image');
            $path = Storage::disk('s3')->put('rese-image', $image);
            $url = Storage::disk('s3')->url($path); // エディタの拡張機能側でエラー判定になる場合があるが機能に問題は無い

            // Shopの作成
            $shop = $request->only(['owner_id', 'name', 'overview']);
            $shop['category_id'] = $createdCategory->id;
            $shop['address_id'] = $createdAddress->id;
            $shop['image'] = $url;
            Shop::create($shop);

            return redirect()->back()->with('success', '店舗を作成しました');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '店舗の作成に失敗しました');
        }
    }
}
