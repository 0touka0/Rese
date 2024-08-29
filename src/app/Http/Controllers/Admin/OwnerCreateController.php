<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class OwnerCreateController extends Controller
{
    // 店舗代表者作成ページ
    public function ownerCreate()
    {
        return view('admin/owner_create');
    }
}
