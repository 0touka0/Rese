<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopRequest;
use App\Models\Address;
use App\Models\Category;
use App\Models\Shop;

class ShopEditController extends Controller
{
    // 店舗編集ページ
    public function shopEdit($shop_id)
    {
        $shop = Shop::find($shop_id);

        return view('owner/shop_edit', compact('shop'));
    }

    // 店舗編集機能
    public function shopPut(ShopRequest $request, $shop_id)
    {
        // 対象のShopを取得
        $shop = Shop::findOrFail($shop_id);

        // Categoryの更新または取得
        $updatedCategory = Category::firstOrCreate([
            'category' => $request->input('category')
        ]);

        // Addressの更新または取得
        $updatedAddress = Address::firstOrCreate([
            'address' => $request->input('address'),
        ]);

        // Shopの情報を更新
        $shopData = $request->only(['owner_id', 'name', 'overview']);
        $shopData['category_id'] = $updatedCategory->id; // category_idを更新
        $shopData['address_id'] = $updatedAddress->id; // address_idを更新

        $shop->update($shopData);

        return redirect()->route('shops.confirm');
    }
}
