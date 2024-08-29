<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;

class OwnersConfirmController extends Controller
{
    // 代表者一覧ページ
    public function ownersConfirm()
    {
        $shops = shop::all();
        return view('admin/owners_confirm', compact('shops'));
    }
}
