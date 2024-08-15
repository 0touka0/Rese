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

    public function shopEdit()
    {
        return view('owner/shop_edit');
    }
}
