<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

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
        return [
            'date' => ['required', 'date'],
            'time' => ['required', 'date_format:H:i'],
            // ここでカスタムバリデーションロジックを実装する
            function ($attribute, $value, $fail) {
                $datetime = $this->input('date') . ' ' . $this->input('time');
                $user_id = Auth::id();

                $conflictCount = Reservation::where('user_id', $user_id)
                ->where('datetime', $datetime)
                ->count();

                if ($conflictCount > 0) {
                    $fail('既に同じ時間帯に予約が入っています。');
                }
            }
        ];
    }
}
