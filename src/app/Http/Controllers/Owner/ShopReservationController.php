<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Carbon\Carbon;

class ShopReservationController extends Controller
{
    // 店舗予約一覧ページ
    public function reservations()
    {
        $date = $this->getTargetDate();
        $formattedDate = $date->format('Y-m-d');
        $reservations  = Reservation::whereDate('datetime', $formattedDate)
            ->orderBy('datetime', 'asc')
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
