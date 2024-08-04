<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class AdminController extends Controller
{
    public function admin()
    {
        return view('admin/owner_create');
    }

    public function owners()
    {
        $shops = shop::all();
        return view('admin/owners_confirm', compact('shops'));
    }
}
