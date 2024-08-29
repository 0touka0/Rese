<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Shop;

class ShopConfirmController extends Controller
{
    // 店舗詳細ページ
    public function shopsConfirm()
    {
        $shops = Shop::all();

        return view('owner/shops_confirm', compact('shops'));
    }
}
