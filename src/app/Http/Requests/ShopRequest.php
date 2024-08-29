<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueReservation;

class ShopRequest extends FormRequest
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
        $rules = [];
        $datetime      = $this->date . " " . $this->time;
        $userId        = $this->user_id;
        $reservationId = $this->route('reservation_id'); // ルートパラメータから予約IDを取得

        switch ($this->route()->getName()) {
            case 'reservation':        // 店舗予約ルート
            case 'reservation.update': // 予約更新ルート
                $rules = [
                    'date'   => ['required', 'date'],
                    'time'   => ['required', 'date_format:H:i', new UniqueReservation($datetime, $userId, $reservationId)],
                    'number' => ['required', 'integer'        , 'min:1'],
                ];
                break;

            case 'shop.store':
            case 'shop.put':
                $rules = [
                    'name'     => 'required|string|max:255',
                    'address'  => 'required|string|max:255',
                    'category' => 'required|string|max:255',
                    'overview' => 'required|string|max:1000',
                ];
                break;
        }

        return $rules;
    }
}
