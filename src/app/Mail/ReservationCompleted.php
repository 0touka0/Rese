<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $qrCode;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservation, $qrCode)
    {
        $this->reservation = $reservation;
        $this->qrCode = $qrCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reservation_completed')
                    ->subject('予約完了のお知らせ')
                    ->attachData($this->qrCode, 'qrcode.png', [
                        'mime' => 'image/png',
                    ]);
    }
}
