<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Reservation;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        $shopTags = Shop::select('address', 'category')->get();

        return view('shop_all', compact('shops', 'shopTags'));
    }

    public function search(Request $request)
    {
        $shops = Shop::AddressSearch($request->address)
                    ->CategorySearch($request->category)
                    ->KeywordSearch($request->keyword)
                    ->get();

        $shopTags = Shop::select('address', 'category')->get();

        return view('shop_all', compact('shops', 'shopTags'));
    }

    public function detail(Request $request)
    {
        $id = $request->id;
        $shop = Shop::find($id);

        return view('shop_detail', compact('shop'));
    }
}
