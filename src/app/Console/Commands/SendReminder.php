<?php

namespace App\Console\Commands;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails for reservations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * This method sends reminder emails to users who have reservations scheduled for one hour later.
     *
     * @return void
     */
    public function handle()
    {
        $now = Carbon::now()->startOfMinute();
        $oneHourLater = $now->copy()->addHour();
        // 約1時間後に予約があるレコードを取得
        $reservations = Reservation::whereBetween('datetime', [
            $oneHourLater->format('Y-m-d H:i:00'),
            $oneHourLater->format('Y-m-d H:i:59')
        ])->get();

        foreach ($reservations as $reservation) {
            Mail::raw("Reminder: Your reservation is at {$reservation->datetime}", function ($message) use ($reservation) {
                $message->to($reservation->user->email);
                $message->subject('Reservation Reminder');
            });
        }

        $this->info('Reminders sent successfully!');
    }
}
