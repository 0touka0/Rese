<?php

namespace App\Rules;

use App\Models\Reservation;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UniqueReservation implements Rule
{
    protected $datetime;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public  function passes($attribute, $value)
    {
        $user_id = Auth::id();
        $conflictCount = Reservation::where('user_id', $user_id)
            ->where('datetime', $this->datetime)
            ->count();

            return $conflictCount === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '既に同じ時間帯に予約が入っています。';
    }
}
