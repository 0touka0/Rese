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
            // // ファイルの取得とアップロード
            $image = $request->file('image');
            $path = $image->store('images', 'public');
            $url = Storage::url($path); // /storage/images/xxx.jpg

            // Shopデータを作成
            Shop::create([
                'owner_id'    => $request->input('owner_id'),
                'name'        => $request->input('name'),
                'overview'    => $request->input('overview'),
                'category_id' => $createdCategory->id,
                'address_id'  => $createdAddress->id,
                'image'       => $url,
            ]);

            return redirect()->back()->with('success', '店舗を作成しました');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '店舗の作成に失敗しました');
        }
    }
}
