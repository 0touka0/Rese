<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function newshop()
    {
        return view('owner/shop_create');
    }

    public function store(Request $request)
    {
        $shop = $request->all();
        dd($shop);
        Shop::create($shop);
        return redirect()->back();
    }

    public function shopsConfirm()
    {
        $shops = Shop::all();

        return view('owner/shops_confirm', compact('shops'));
    }

    public function shopEdit($shop_id)
    {
        $shop = Shop::find($shop_id);

        return view('owner/shop_edit', compact('shop'));
    }

    public function shopPut(Request $request, $shop_id)
    {
        $shop = $request->all();
        Shop::find($shop_id)->update($shop);

        return redirect('/shopsconfirm');
    }
}
