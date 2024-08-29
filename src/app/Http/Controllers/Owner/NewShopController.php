<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopRequest;
use App\Models\Address;
use App\Models\Category;
use App\Models\Shop;

class NewShopController extends Controller
{
    // 店舗作成ページ
    public function newShop()
    {
        return view('owner/shop_create');
    }

    // 店舗作成機能
    public function store(ShopRequest $request)
    {
        // Categoryを作成または取得し、category_idを取得する
        $createdCategory = Category::firstOrCreate([
            'category' => $request->input('category')
        ]);

        // Addressを作成し、address_idを取得する
        $createdAddress = Address::firstOrCreate([
            'address' => $request->input('address'),
        ]);

        // Shopの作成
        $shop = $request->only(['owner_id', 'name', 'overview']);
        $shop['category_id'] = $createdCategory->id; // category_idを追加
        $shop['address_id'] = $createdAddress->id; // address_idを追加
        Shop::create($shop);

        return redirect()->back()->with('success', '店舗を作成しました');
    }
}
