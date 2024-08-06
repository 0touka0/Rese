<?php

namespace App\Rules;

use App\Models\Reservation;
use Illuminate\Contracts\Validation\Rule;

class UniqueReservation implements Rule
{
    protected $datetime;
    protected $userId;
    protected $reservationId;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($datetime, $userId, $reservationId = null)
    {
        $this->datetime = $datetime;
        $this->userId = $userId;
        $this->reservationId = $reservationId;
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
        $query = Reservation::where('datetime', $this->datetime)
                            ->where('user_id', $this->userId);

        if ($this->reservationId) {
            $query->where('id', '!=', $this->reservationId);
        }

        return !$query->exists();
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
