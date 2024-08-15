<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    // 店舗作成ページ
    public function newshop()
    {
        return view('owner/shop_create');
    }

    // 店舗作成機能
    public function store(Request $request)
    {
        $shop = $request->all();
        Shop::create($shop);

        return redirect()->back();
    }

    // 店舗詳細ページ
    public function shopsConfirm()
    {
        $shops = Shop::all();

        return view('owner/shops_confirm', compact('shops'));
    }

    // 店舗編集機能
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

    // 店舗予約一覧ページ
    public function reservations()
    {
        $date = $this->getTargetDate();
        $formattedDate = $date->format('Y-m-d');
        $reservations  = Reservation::whereDate('datetime', $formattedDate)
                                    ->orderBy(  'datetime', 'asc')
                                    ->get();

        return view('owner/reservations', compact('date', 'formattedDate', 'reservations'));
    }

    // 日付取得機能
    public function getTargetDate()
    {
        $date = Carbon::parse(request('date', Carbon::today()));

        if (request('action') === 'previous') {
            $date->subDay();
        } elseif (request('action') === 'next') {
            $date->addDay();
        }

        return $date;
    }
}
