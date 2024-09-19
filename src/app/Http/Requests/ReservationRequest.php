<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueReservation;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $datetime = $this->date . " " . $this->time;
        $userId   = auth()->id();
        $reservationId = $this->reservation_id ?? null;

        return [
            'date' => ['required'],
            'time' => ['required', new UniqueReservation($datetime, $userId, $reservationId)],
        ];
    }
}
