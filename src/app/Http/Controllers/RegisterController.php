<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class RegisterController extends Controller
{
    public function store(Request $request, CreatesNewUsers $creator)
    {
        $user = $creator->create($request->all());
        event(new Registered($user));

        return redirect()->route('thanks');
    }
}
