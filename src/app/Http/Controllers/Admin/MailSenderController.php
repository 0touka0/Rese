<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailSenderController extends Controller
{
    // メール作成ページ
    public function mailForm()
    {
        return view('admin/mail_send');
    }

    // メール配信機能
    public function sendMail(Request $request)
    {
        $recipient      = $request->input('recipient');
        $subject        = $request->input('subject');
        $messageContent = $request->input('message');

        $recipients = [];
        if ($recipient == 'allOwners') {
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
