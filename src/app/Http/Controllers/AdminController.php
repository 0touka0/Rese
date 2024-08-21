<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

    public function mailForm()
    {
        return view('admin/mail_send');
    }

    public function sendMail(Request $request)
    {
        $recipient      = $request->input('recipient');
        $subject        = $request->input('subject');
        $messageContent = $request->input('message');

        $recipients = [];
        if($recipient == 'allOwners') {
            $recipients = User::where('role', 2)->pluck('email');
        } elseif ($recipient == 'allUsers') {
            $recipients = User::where('role', 1)->pluck('email');
        }

        foreach ($recipients as $recipient) {
            Mail::raw($messageContent, function ($message) use ($recipient, $subject) {
                $message->to($recipient)
                    ->subject($subject);
            });
        }
        return redirect()->back()->with('success', 'メールが送信されました！');
    }
}
